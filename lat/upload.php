<?php
$headertitle = 'Zagruzit fayl';
include("../config.php");
include("./header.php");
include("./translit.php");
$filename = $_FILES['upfile']['name'];

$filesize = $_FILES['upfile']['size'];
$filecrc = md5_file($_FILES['upfile']['tmp_name']);

$bans=file("../bans.bd");
echo "<TR> <TD COLSPAN=14>";
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo "Zagruzka dannogo fayla zapreshena </TD> </TR>";
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "Zagruzka faylov s vashego komp'yutera zapreshena </TD> </TR>";
    include("./footer.php");
    die();
  }
}

$checkfiles=file("../files.bd");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    echo "Dannyi fayl uzhe zagruzhen na server. </TD> </TR> ";
    echo "<TR> <TD COLSPAN=14> Ssylka na skachivanie dannogo fayla: <A href=\"" . $scripturl . "lat/download.php?file=" . $filecrc . "\">". $scripturl . "lat/download.php?file=" . $filecrc . "</A> </TD> </TR>";
    echo "<TR> <TD COLSPAN=14> Poskol'ku dannyi fayl uzhe byl kem-to zagruzhen, vy ne mozhete ego udalit' s servera. </TD> </TR>";
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
   echo "Fayly etogo formata zapretheny dlya zagruzki na sayjt </TD> </TR>";
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
   echo "Vybrana nepravil'naya kategoriya! </TD> </TR>";
   include("./footer.php");
   die();
}
$cat = $_POST['categories'];
} 
else { $cat = NULL; }


  
if($filesize==0) {
echo "Vy ne vybrali ni odin fayl dlya zagruzki </TD> </TR>";
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo "Vy pytaetes' zagruzit' slishkom bol'shoyj fayl </TD> </TR>";
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
echo "Vy slishkom toropites'! Podozhdite nemnogo ($sekunds sekund) i poprobuyjte zagrizit fayl eshe raz. </TD> </TR>";
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
$uploadmsg = "Zagruzka vashego fayla (".$filename.") zavershena.\n <BR> Ssylka na skachivanie fayla: ". $scripturl . "lat/download.php?file=" . $filecrc . "\n <BR> Ssylka dlya udaleniya fayla: ". $scripturl . "lat/download.php?file=" . $filecrc . "&del=" . $passkey . "\n <BR> Blagodarim za ispol'zovanie nashego fayloobmennika!";
mail($_POST['myemail'],"Vash zagruzhennyi fayl",$uploadmsg,"Ot: admin@downgradefiles.pdp-11.ru\n");
}

if($passwordoption && isset($_POST['pprotect'])) {
  $passwerd = md5($_POST['pprotect']);
} else { $passwerd = md5(""); }

if($descriptionoption && isset($_POST['descr'])) {
  $description = strip_tags($_POST['descr']);
  $description = str_replace("|","-", $description);
   
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
/*Добавляем транслитерацию имени*/
$imya_translitom = translit($_FILES['upfile']['name']);
/*Добавляем транслитерацию имени - Конец*/

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

echo "Vash fayl uspeshno zagruzhen!</TD> </TR>";
echo "<TR> <TD COLSPAN=14> Ssylka na skachivanie fayla: <A href=\"" . $scripturl . "lat/download.php?file=" . $filecrc . "\">". $scripturl . "lat/download.php?file=" . $filecrc . "</A> </TD> </TR>";
echo "<TR> <TD COLSPAN=14> Ssylka dlya udaleniya fayla: <A href=\"" . $scripturl . "lat/download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "lat/download.php?file=" . $filecrc . "&del=" . $passkey . "</A> </TD> </TR>";
echo "<TR> <TD COLSPAN=14> Pozhaluyjsta zapomnite eti ssylki ili zapishite ih gde-nibud'. </TD> </TR>";
echo "<TR> <TD COLSPAN=14> <A HREF=\"" .$scripturl. "lat/showqr.php?file=" . $filecrc . "\" TARGET=\"_blank\">QR-kod (ssylka otkroetsya v novoj vkladke ili novom okne)</A> </TD> </TR>";
include("./footer.php");
?>