<?php
include("../config.php");
include("./header.php");

if(isset($_GET['file'])){
$thisfile=$_GET['file'];
}else{
echo "<tr> <td colspan=14> ������� � ����襭�� </td> </tr>"; 
include("./footer.php");
die();
}

$checkfiles=file("./files.bd");
$foundfile=0;
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$thisfile){
    $foundfile=1;
  }
}
if($foundfile==0){
echo "<tr> <td colspan=14> ������� � ����襭�� </td> </tr>"; 
include("./footer.php");
die();
}

$bans=file("./bans.bd");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "<tr> <td colspan=14> � ��襣� �������� ����饭� ᮮ���� � ����襭�� </td> </tr>";
    include("./footer.php");
    die();
  }
}

$reported = 0;
$fc=file("../reports.bd");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] == $thisfile)
    $reported = 1;
}

if($reported == 1) {
echo "<tr> <td colspan=14> �� ��� 䠩� 㦥 ��ࠢ�﫨 ᮮ��襭�� � ����襭��! </td> </tr> ";
include("./footer.php");
die();
}

$filelist = fopen("../reports.bd","a+");
fwrite($filelist, $thisfile ."|". $_SERVER['REMOTE_ADDR'] ."\n");

echo "<tr> <td colspan=14> ����饭�� � ����襭�� �ᯥ譮 ��ࠢ���� </td> </tr>";
include("./footer.php");

?>