<?php
$headertitle = 'Панель управления';
include("./config.php");
if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
include("./header.php");
echo "<tr> <td colspan=14>";
if($act=="login"){
  if($_POST['passwordx']==$adminpass){
    $_SESSION['logged_in'] = md5(md5($adminpass));
  }
}
if($act=="logout"){
  session_unset();
  echo "<center> Вы вышли из админ-панели </center> </td> </tr>";
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==md5(md5($adminpass))) {

if(isset($_GET['download'])){

/*$checkfiles=file("./files.bd");
foreach($checkfiles as $line){
  $thisline = explode('|', $line);
  if($thisline[0]==$_GET['download'])
    $downloadfile=$thisline;
}
echo "<script>window.location='".$scripturl."download2.php?a=".$downloadfile[0]."&b=".md5($downloadfile[2].$_SERVER['REMOTE_ADDR'])."';</script>";
}*/

if(isset($_GET['delete'])) {

$fc=file("./files.bd");
$f=fopen("./files.bd","w+");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] != $_GET['delete'])
    fputs($f,$line);
}
fclose($f);
unlink("./storage/".$_GET['delete']);
}

if(isset($_GET['banreport'])) {

$fc=file("./files.bd");
$f=fopen("./files.bd","w+");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] != $_GET['banreport'])
    fputs($f,$line);
  else
    $deleted=$thisline;
}
fclose($f);
$fc=file("./reports.bd");
$f=fopen("./reports.bd","w+");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] != $_GET['banreport'])
    fputs($f,$line);
}
fclose($f);
$f=fopen("./bans.bd","a+");
fputs($f,$deleted[3]."\n".$deleted[0]."\n");
unlink("./storage/".$_GET['banreport']);
}

if(isset($_GET['ignore'])) {

$fc=file("./reports.bd");
$f=fopen("./reports.bd","w+");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] != $_GET['ignore'])
    fputs($f,$line);
}
fclose($f);
}

if(isset($_GET['act']) && $_GET['act']=="bans") {

if(isset($_GET['unban'])) {
$fc=file("./bans.bd");
$f=fopen("./bans.bd","w+");
foreach($fc as $line)
{
  if (md5($line) != $_GET['unban'])
    fputs($f,$line);
}
fclose($f);
}

if(isset($_POST['banthis'])) {
$f=fopen("./bans.bd","a+");
fputs($f,$_POST['banthis']."\n");
}


?>
<h1>Баны</h1><p> <center><form action="admin_.php?act=bans" method="post">Введите IP-адрес или хэш-файла который нужно забанить:  
<input type="text" name="banthis"> 
<input type="submit" value="ЗаБАНить!">
<br />
</form></center>
<?php

$fc=file("./bans.bd");
foreach($fc as $line)
{
  echo $line . " - <a href=\"admin_.php?act=bans&unban=".md5($line)."\">unban</a><br />";
}

include("./footer.php");
die();
}


?>
<center><a href="admin_.php?act=logout">Выйти</a> | <a href="admin_.php?act=bans">Управление БАНами</a></center><br />

<center> <font color="#FCFE54" size="+2"> <b> Отчеты о нарушениях </b> </font> </center>
<table width="100%" cellpadding="1" cellspacing="1" bordercolor="#54FEFC" border="1">
<tr><td><b>Имя файла</b></td><td><b>Кто загрузил ?</b></td><td><b>Удалить и забанить</b></td><td><b>Игнорировать данный файл</b></td></tr>
<?php

$checkreports=file("./reports.bd");
foreach($checkreports as $line)
{
  $thisreport = explode('|', $line);
  $checkfiles=file("./files.bd");
  $checkfiles11 = array_reverse($checkfiles);
  //выводим массив со списком файлов в обратном порядке
//недавно загруженные файлы - сверху
  foreach($checkfiles11 as $line)
  {
    $thisline = explode('|', $line);
    if($thisline[0]==$thisreport[0]){
	$foundfile=$thisline;
    }
  }

echo "<tr><td><a href=\".$scripturl."download2.php?a=".$downloadfile[0]."&b=".md5($downloadfile[2].$_SERVER['REMOTE_ADDR']).">".$foundfile[1]."</td>";
echo "<td>".$foundfile[3]."</td>";
echo "<td><a href=\"admin_.php?banreport=".$foundfile[0]."\">Удалить и забанить</a></td>";
echo "<td><a href=\"admin_.php?ignore=".$foundfile[0]."\">Игнорировать данный файл</a></td></tr>";

}

?>
</table>
<br />

<center> <font color="#FCFE54" size="+2"> <b> Файлы </b> </font> </center>
<table width="100%" cellpadding="1" cellspacing="1" border="1" bordercolor="#54FEFC">
<tr><td><b>Имя файла</b></td><td><b>Размер (МБ)</b></td><td><b>Кто загрузил ?</b></td><td><b>Скорость интернета(МБ)</b></td><td><b>Удалить</b></td></tr>
<?php

$checkfiles=file("./files.bd");
$checkfiles11 = array_reverse($checkfiles);
foreach($checkfiles11 as $line)
{
  $thisline = explode('|', $line);
  $filesize = filesize("./storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);
  echo "<tr><td><a href=\"admin_.php?download=".$thisline[0]."\">".$thisline[1]."</td><td>".round($filesize,2)."</td>";
  echo "<td>".$thisline[3]."</td><td>".round($filesize*$thisline[5],2)."</td><td><a href=\"admin_.php?delete=".$thisline[0]."\">Удалить</a></td></tr>";
}
echo "</table>";
} else {
?>
<tr> <td colspan="14" height="0px">
<center>
<center> <br> <font color="#FCFE54" size="+2"> <b> Панель управления </b> </font> </center> <br>
<form action="admin_.php?act=login" method="post">Пароль:  
<input type="password" name="passwordx"> 
<input type="submit" value="Войти"> 
<br />
</form></center> </td> </tr>
<?php }
include("./footer.php");
?>