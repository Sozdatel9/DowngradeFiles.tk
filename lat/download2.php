<?php

include("../config.php");
include("./header.php");

$bans=file("../bans.bd");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    echo "<TR> <TD COLSPAN=14> Skachivanie faylov s vashego komp'yutera zapresheno </TD> </TR>";
    include("./footer.php");
    die();
  }
}
$preview=0;
if(!isset($_GET['a']) || !isset($_GET['b']))
{
  //echo "<script>window.location = '".$scripturl."';</script>";
}

if(isset($_GET['preview']))
{
 $preview=1;
}

$validdownload = 0;

$checkfiles=file("../files.bd");
$foundfile=0;
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$_GET['a'] && md5($thisline[2].$_SERVER['REMOTE_ADDR'])==$_GET['b'])
    $validdownload=$thisline;
}

if($validdownload==0) {
    echo "<TR> <TD COLSPAN=14> Nevernaya ssylka na skachivanie fayla </TD> </TR>";
    include("./footer.php");
    die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

$filesize = filesize("../storage/".$validdownload[0]);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize) {
$downloaders = fopen("../downloaders.bd","a+");
fputs($downloaders,"$userip|$time\n");
fclose($downloaders);
}

if ($preview == 0) { 
$validdownload[4] = time();
}

else if ($preview == 1) { 
$validdownload[4] = $validdownload[4];
}

$fc=file("../files.bd");
$f=fopen("../files.bd","w");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]!=$_GET['a'])
    fputs($f,$line);
  else {
   if ($preview == 0) {
    fputs($f,$validdownload[0]."|". $validdownload[1]."|". $validdownload[2]."|". $validdownload[3]."|". $validdownload[4]."|".($validdownload[5]+1)."|".$validdownload[6]."|".$validdownload[7]."|".$validdownload[8]."|\n");   
   }   
   else if ($preview == 1)
   {
    fputs($f,$validdownload[0]."|". $validdownload[1]."|". $validdownload[2]."|". $validdownload[3]."|". $validdownload[4]."|".($validdownload[5])."|".$validdownload[6]."|".$validdownload[7]."|".$validdownload[8]."|\n"); 
   }   
  }
}
fclose($f);

// sbrasyvaem bufer vyvoda PHP, chtoby izbezhat' perepolneniya pamyati vydelennoyj pod skript
// esli etogo ne sdelat' fayl budet chitat'sya v pamyat' polnost'yu!
if (ob_get_level()) {
   ob_end_clean();
   }
//application-x-msdownload

header('Content-type: application/octet-stream');
header('Content-Length: ' . filesize("./storage/".$validdownload[0]));
header('Content-Disposition: attachment; filename="'.$validdownload[1].'"');
header('Content-Description: File Transfer');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

readfile("../storage/".$validdownload[0]);

?>