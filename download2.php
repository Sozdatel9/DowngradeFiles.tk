<?php


include("./config.php");

$bans=file("./bans.bd");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    echo "���������� ������ � ������ ���������� ���������.";
    include("./footer.php");
    die();
  }
}

if(!isset($_GET['a']) || !isset($_GET['b']))
{
  echo "<script>window.location = '".$scripturl."';</script>";
}

$validdownload = 0;

$checkfiles=file("./files.bd");
$foundfile=0;
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$_GET['a'] && md5($thisline[2].$_SERVER['REMOTE_ADDR'])==$_GET['b'])
    $validdownload=$thisline;
}

if($validdownload==0) {
    echo "�������� ������ �� ���������� �����.";
    include("./footer.php");
    die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

$filesize = filesize("./storage/".$validdownload[0]);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize) {
$downloaders = fopen("./downloaders.bd","a+");
fputs($downloaders,"$userip|$time\n");
fclose($downloaders);
}

$validdownload[4] = time();

$fc=file("./files.bd");
$f=fopen("./files.bd","w");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]!=$_GET['a'])
    fputs($f,$line);
  else
    fputs($f,$validdownload[0]."|". $validdownload[1]."|". $validdownload[2]."|". $validdownload[3]."|". $validdownload[4]."|".($validdownload[5]+1)."|".$validdownload[6]."|".$validdownload[7]."|".$validdownload[8]."|\n");
}
fclose($f);
// ���������� ����� ������ PHP, ����� �������� ������������ ������ ���������� ��� ������
// ���� ����� �� ������� ���� ����� �������� � ������ ���������!
if (ob_get_level()) {
   ob_end_clean();
   }


header('Content-type: application/octetstream');
header('Content-Length: ' . filesize("./storage/".$validdownload[0]));
header('Content-Disposition: attachment; filename="'.$validdownload[1].'"');
header('Content-Description: File Transfer');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');

readfile("./storage/".$validdownload[0]);

?>