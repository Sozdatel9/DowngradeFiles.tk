<?php

include("./config.php");
include("./header.php");
include("./lat/translit.php");
$filename = $_FILES['upfile']['name'];
$filesize = $_FILES['upfile']['size'];
$filecrc = md5_file($_FILES['upfile']['tmp_name']);

$bans=file("./bans.bd");
echo "<tr> <td colspan=14>";
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo "�������� ������� ����� ���������. </td> </tr>";
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "�������� ������ � ������ ���������� ���������. </td> </tr>";
    include("./footer.php");
    die();
  }
}

$checkfiles=file("./files.bd");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    echo "������ ���� ��� �������� �� ������.</td> </tr> ";
    echo "<tr> <td colspan=14> ������ �� ���������� ������� �����: <a href=\"" . $scripturl . "download.php?file=" . $filecrc . "\">". $scripturl . "download.php?file=" . $filecrc . "</a> </td> </tr>";
    echo "<tr> <td colspan=14>��������� ������ ���� ��� ��� ���-�� ��������, �� �� ������ ��� ������� � �������. </td> </tr>";
    include("./footer.php");
    die();
  }
}


if(isset($allowedtypes)){
$allowed = 0;
foreach($allowedtypes as $ext) {
  if(substr($filename, (0 - (strlen($ext)+1) )) == ".".$ext)
    $allowed = 1;
}
if($allowed==0) {
   echo "����� ����� ������� ��������� ��� �������� �� ����. </td> </tr>";
   include("./footer.php");
   die();
}
}


if(isset($categorylist)){
$validcat = 0;
foreach($categories as $cat) {
  if($_POST['category']==$cat){ $validcat = 1; }
}
if($validcat==0) {
   echo "������� ������������ ��������� ! </td> </tr>";
   include("./footer.php");
   die();
}
$cat = $_POST['categories'];
} 
else { $cat = $_POST['categories']; }


  
if($filesize==0) {
echo "�� �� ������� �� ���� ���� ��� ��������. </td> </tr>";
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo "�� ��������� ��������� ������� ������� ����. </td> </tr>";
include("./footer.php");
die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

if($filesize > $nolimitsize) {

$uploaders = fopen("./uploaders.bd","r+");
flock($uploaders,2);
while (!feof($uploaders)) { 
$user[] = chop(fgets($uploaders,65536));
}
fseek($uploaders,0,SEEK_SET);
ftruncate($uploaders,0);
foreach ($user as $line) {
@list($savedip,$savedtime) = explode("|",$line);
if ($savedip == $userip) {
if ($time < $savedtime + ($uploadtimelimit*60)) {
echo "�� ������� ����������. ��������� ������� � ���������� ��� ���! </td> </tr>";
include("./footer.php");
die();
}
}
if ($time < $savedtime + ($uploadtimelimit*60)) {
  fputs($uploaders,"$savedip|$savedtime\n");
}
}
fputs($uploaders,"$userip|$time\n");

}

$passkey = rand(100000, 999999);

if($emailoption && isset($_POST['myemail']) && $_POST['myemail']!="") {
$uploadmsg = "�������� ������ ����� (".$filename.") ���������.\n ������ �� ���������� �����: ". $scripturl . "download.php?file=" . $filecrc . "\n ������ ��� �������� �����: ". $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "\n ���������� �� ������������� ������ ��������������!";
mail($_POST['myemail'],"��� ����������� ����",$uploadmsg,"��: admin@downgradefiles.tk\n");
}

if($passwordoption && isset($_POST['pprotect'])) {
  $passwerd = md5($_POST['pprotect']);
} else { $passwerd = md5(""); }

if($descriptionoption && isset($_POST['descr'])) {
  $description = strip_tags($_POST['descr']);
} else { $description = ""; }

$filelist = fopen("./files.bd","a+");
/*��������� �������������� �����*/
$imya_translitom = translit($_FILES['upfile']['name']);
/*��������� �������������� ����� - �����*/
fwrite($filelist, $filecrc ."|". basename($imya_translitom) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n");
/* fwrite($filelist, $filecrc ."|". basename($_FILES['upfile']['name']) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n"); */

$movefile = "./storage/" . $filecrc;
move_uploaded_file($_FILES['upfile']['tmp_name'], $movefile);

echo "��� ���� ������� ��������!</td> </tr>";
echo "<tr> <td colspan=14> ������ �� ���������� �����: <a href=\"" . $scripturl . "download.php?file=" . $filecrc . "\">". $scripturl . "download.php?file=" . $filecrc . "</a> </td> </tr>";
echo "<tr> <td colspan=14> ������ ��� �������� �����: <a href=\"" . $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "</a> </td> </tr>";
echo "<tr> <td colspan=14> ���������� ��������� ��� ������ ��� �������� �� ���-������. </td> </tr>";
include("./footer.php");
?>