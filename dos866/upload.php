<?php
$headertitle = '����㧨�� 䠩�';
include("../config.php");
include("./header.php");
include("../lat/translit.php");
$filename = $_FILES['upfile']['name'];
$filename = iconv('cp866', 'windows-1251', $filename);
$filesize = $_FILES['upfile']['size'];
$filecrc = md5_file($_FILES['upfile']['tmp_name']);

$bans=file("../bans.bd");
echo "<TR> <TD COLSPAN=14>";
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo "����㧪� ������� 䠩�� ����饭� </TD> </TR>";
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "����㧪� 䠩��� � ��襣� �������� ����饭� </TD> </TR>";
    include("./footer.php");
    die();
  }
}

$checkfiles=file("../files.bd");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    echo "����� 䠩� 㦥 ����㦥� �� �ࢥ�. </TD> </TR> ";
    echo "<TR> <TD COLSPAN=14> ��뫪� �� ᪠稢���� ������� 䠩��: <A href=\"" . $scripturl . "dos866/download.php?file=" . $filecrc . "\">". $scripturl . "dos866/download.php?file=" . $filecrc . "</A> </TD> </TR>";
    echo "<TR> <TD COLSPAN=14> ��᪮��� ����� 䠩� 㦥 �� ���-� ����㦥�, �� �� ����� ��� 㤠���� � �ࢥ�. </TD> </TR>";
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
   echo "����� �⮣� �ଠ� ����饭� ��� ����㧪� �� ᠩ� </TD> </TR>";
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
   echo "��࠭� ���ࠢ��쭠� ��⥣���! </TD> </TR>";
   include("./footer.php");
   die();
}
$cat = $_POST['categories'];
} 
else { $cat = NULL; }


  
if($filesize==0) {
echo "�� �� ��ࠫ� �� ���� 䠩� ��� ����㧪� </TD> </TR>";
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo "�� ��⠥��� ����㧨�� ᫨誮� ����让 䠩� </TD> </TR>";
include("./footer.php");
die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

if($filesize > $nolimitsize) {

$uploaders = fopen("../uploaders.bd","r+");
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
$sekunds = ($savedtime + ($uploadtimelimit*60))-$time;
echo "�� ᫨誮� �ய����! �������� ������� ($sekunds ᥪ㭤) � ���஡�� ����㧨�� 䠩� �� ࠧ.  </TD> </TR>";
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
$uploadmsg = "����㧪� ��襣� 䠩�� (".$filename.") �����襭�.\n <BR> ��뫪� �� ᪠稢���� 䠩��: ". $scripturl . "dos866/download.php?file=" . $filecrc . "\n <BR> ��뫪� ��� 㤠����� 䠩��: ". $scripturl . "dos866/download.php?file=" . $filecrc . "&del=" . $passkey . "\n <BR> �������ਬ �� �ᯮ�짮����� ��襣� 䠩�����������!";
mail($_POST['myemail'],"��� ����㦥��� 䠩�",$uploadmsg,"��: admin@downgradefiles.pdp-11.ru\n");
}

if($passwordoption && isset($_POST['pprotect'])) {
  $passwerd = md5($_POST['pprotect']);
} else { $passwerd = md5(""); }

if($descriptionoption && isset($_POST['descr'])) {
  $description = strip_tags($_POST['descr']);
  $description = str_replace("|","-", $description);  
  $description = iconv('cp866', 'windows-1251', $description);
} else { $description = ""; }

$filelist = fopen("../files.bd","a+");
$lastline = null;
 $cursor = 0 ;
        do  {
            fseek($filelist, $cursor--, SEEK_END);
            $char = fgetc($filelist);
            $lastline = $char.$lastline;
        } while (
                $cursor > -1 || (
                 ord($char) !== 10 &&
                 ord($char) !== 13
                )
        );
/*������塞 �࠭᫨���� �����*/
$trans_temp = iconv('cp866', 'windows-1251', $_FILES['upfile']['name']);
$imya_translitom = translit($trans_temp);
/*������塞 �࠭᫨���� ����� - �����*/

if (($lastline === null) || (trim($lastline) === '')) {
fwrite($filelist, $filecrc ."|". basename($imya_translitom) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."||\n");
}
else {
     fwrite($filelist, "\n".$filecrc ."|". basename($imya_translitom) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."||\n");	
}

//fwrite($filelist, $filecrc ."|". basename($imya_translitom) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n");
/* fwrite($filelist, $filecrc ."|". basename($_FILES['upfile']['name']) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n"); */

$movefile = "../storage/" . $filecrc;
move_uploaded_file($_FILES['upfile']['tmp_name'], $movefile);

echo "��� 䠩� �ᯥ譮 ����㦥�!</TD> </TR>";
echo "<TR> <TD COLSPAN=14> ��뫪� �� ᪠稢���� 䠩��: <A href=\"" . $scripturl . "dos866/download.php?file=" . $filecrc . "\">". $scripturl . "dos866/download.php?file=" . $filecrc . "</A> </TD> </TR>";
echo "<TR> <TD COLSPAN=14> ��뫪� ��� 㤠����� 䠩��: <A href=\"" . $scripturl . "dos866/download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "dos866/download.php?file=" . $filecrc . "&del=" . $passkey . "</A> </TD> </TR>";
echo "<TR> <TD COLSPAN=14> �������� �������� �� ��뫪� ��� ������ �� ���-�����. </TD> </TR>";
echo "<TR> <TD COLSPAN=14> <A HREF=\"" .$scripturl. "dos866/showqr.php?file=" . $filecrc . "\" TARGET=\"_blank\">QR-��� (��뫪� ��஥��� � ����� ������� ��� ����� ����)</A> </TD> </TR>";
include("./footer.php");
?>