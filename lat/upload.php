<?php

include("../config.php");
include("./header.php");
include("./translit.php");
$filename = $_FILES['upfile']['name'];

$filesize = $_FILES['upfile']['size'];
$filecrc = md5_file($_FILES['upfile']['tmp_name']);

$bans=file("../bans.bd");
echo "<tr> <td colspan=14>";
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo "Zagruzka dannogo fayla zaprethena. </td> </tr>";
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "Zagruzka faylov s vashego komp'yutera zaprethena. </td> </tr>";
    include("./footer.php");
    die();
  }
}

$checkfiles=file("../files.bd");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    echo "Dannyi fayl uzhe zagruzhen na server.</td> </tr> ";
    echo "<tr> <td colspan=14> Ssylka na skachivanie dannogo fayla: <a href=\"" . $scripturl . "lat/download.php?file=" . $filecrc . "\">". $scripturl . "lat/download.php?file=" . $filecrc . "</a> </td> </tr>";
    echo "<tr> <td colspan=14>Poskol'ku dannyi fayl uzhe byl kem-to zagruzhen, vy ne mozhete ego udalit' s servera. </td> </tr>";
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
   echo "Fayly etogo formata zapretheny dlya zagruzki na sayjt. </td> </tr>";
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
   echo "Vybrana nepravil'naya kategoriya ! </td> </tr>";
   include("./footer.php");
   die();
}
$cat = $_POST['categories'];
} 
else { $cat = $_POST['categories']; }


  
if($filesize==0) {
echo "Vy ne vybrali ni odin fayl dlya zagruzki. </td> </tr>";
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo "Vy pytaetes' zagruzit' slishkom bol'shoyj fayl. </td> </tr>";
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
echo "Vy slishkom toropites'. Podozhdite nemnogo i poprobuyjte ethe raz! </td> </tr>";
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
$uploadmsg = "Zagruzka vashego fayla (".$filename.") zavershena.\n Ssylka na skachivanie fayla: ". $scripturl . "lat/download.php?file=" . $filecrc . "\n Ssylka dlya udaleniya fayla: ". $scripturl . "lat/download.php?file=" . $filecrc . "&del=" . $passkey . "\n Blagodarim za ispol'zovanie nashego fayloobmennika!";
mail($_POST['myemail'],"Vash zagruzhennyi fayl",$uploadmsg,"Ot: admin@downgradefiles.tk\n");
}

if($passwordoption && isset($_POST['pprotect'])) {
  $passwerd = md5($_POST['pprotect']);
} else { $passwerd = md5(""); }

if($descriptionoption && isset($_POST['descr'])) {
  $description = strip_tags($_POST['descr']);
   
} else { $description = ""; }

$filelist = fopen("../files.bd","a+");
/*Добавляем транслитерацию имени*/
$imya_translitom = translit($_FILES['upfile']['name']);
/*Добавляем транслитерацию имени - Конец*/
fwrite($filelist, $filecrc ."|". basename($imya_translitom) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n");
/* fwrite($filelist, $filecrc ."|". basename($_FILES['upfile']['name']) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n"); */

$movefile = "../storage/" . $filecrc;
move_uploaded_file($_FILES['upfile']['tmp_name'], $movefile);

echo "Vash fayl uspeshno zagruzhen!</td> </tr>";
echo "<tr> <td colspan=14> Ssylka na skachivanie fayla: <a href=\"" . $scripturl . "lat/download.php?file=" . $filecrc . "\">". $scripturl . "lat/download.php?file=" . $filecrc . "</a> </td> </tr>";
echo "<tr> <td colspan=14> Ssylka dlya udaleniya fayla: <a href=\"" . $scripturl . "lat/download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "lat/download.php?file=" . $filecrc . "&del=" . $passkey . "</a> </td> </tr>";
echo "<tr> <td colspan=14> Pozhaluyjsta zapomnite eti ssylki ili zapishite ih gde-nibud'. </td> </tr>";
include("./footer.php");
?>