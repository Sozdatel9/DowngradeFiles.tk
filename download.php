<?php
$headertitle = 'Скачать файл';
include("./config.php");

$bans=file("./bans.bd");

foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    include("./header.php");  		  
    echo "<TR> <TD COLSPAN=14> Скачивание файлов с вашего компьютера запрещено </TD> </TR>";
    include("./footer.php");
    die();
  }
}

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  include("./header.php");  		
  echo "<TR> <TD COLSPAN=14> Неверная ссылка на скачивание файла </TD> </TR>";
  include("./footer.php");
  die();
}

$checkfiles=file("./files.bd");
$foundfile=0;
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    $foundfile=$thisline;
	$headertitle = 'Скачать файл ' . $foundfile[1] ."";
    include("./header.php");	
  }
}


if(isset($_GET['del'])) {

$fc=file("./files.bd");
$f=fopen("./files.bd","w");
$deleted=0;
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] == $_GET['file']){
    if($thisline[2] == $_GET['del']){
	$deleted=1;
    } else {
    fputs($f,$line);
    }
  } else {
    fputs($f,$line);
  }
}
fclose($f);
if($deleted==1){
 //include("./header.php");	
unlink("./storage/".$_GET['file']);
 echo "<TR> <TD COLSPAN=14>Ваш файл был успешно удалён </TD> </TR>";
} 
else {
 include("./header.php");	
 echo "<TR> <TD COLSPAN=14>Неверная ссылка на удаление файла </TD> </TR>";
}
include("./footer.php");
die();
}

if($foundfile==0) {
  include("./header.php");	
  echo "<TR> <TD COLSPAN=14>Неверная ссылка на скачивание файла </TD> </TR>";
  include("./footer.php");
  die();
}

if(isset($foundfile[7]) && $foundfile[7]!=md5("") && (!isset($_POST['pass']) || $foundfile[7] != md5($_POST['pass']))){
echo "<TR> <TD COLSPAN=14 height=0px> <BR> <FORM action=\"download.php?file=".$foundfile[0]."\" method=\"post\">Введите пароль для скачивания данного файла: <INPUT type=\"password\" name=\"pass\"><INPUT type=\"submit\" value=\"Скачать файл\" /></FORM> </TD> </TR>";
include("./footer.php");
die();
}

$filesize = filesize("./storage/".$foundfile[0]);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize) {

$userip=$_SERVER['REMOTE_ADDR'];
$time=time();
$downloaders = fopen("./downloaders.bd","r+");
flock($downloaders,2);
while (!feof($downloaders)) { 
$user[] = chop(fgets($downloaders,65536));
}
fseek($downloaders,0,SEEK_SET);
ftruncate($downloaders,0);
foreach ($user as $line) {
list($savedip,$savedtime) = explode("|",$line);
if ($savedip == $userip) {
if ($time < $savedtime + ($downloadtimelimit*60)) {
$sekunds = ($savedtime + ($downloadtimelimit*60))-$time;
echo "<TR> <TD COLSPAN=14> Вы слишком торопитесь! Подождите немного ($sekunds секунд) и попробуйте скачать файл еще раз. </TD> </TR>";
include("./footer.php");
die();
}
}
if ($time < $savedtime + ($downloadtimelimit*60)) {
  fputs($downloaders,"$savedip|$savedtime\n");
}
}

}
  if (($filesize < 1) && ($filesize > 0.001))
    {
     echo "<TR> <TD COLSPAN=6> <CENTER> Имя </CENTER> </TD> <TD COLSPAN=2> <CENTER> Размер </CENTER> </TD> <TD COLSPAN=6> <CENTER> Описание </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2> ".round($filesize*1024,0)." КБ</TD>";
    }
  elseif (($filesize < 1) && ($filesize < 0.001))
    {
     echo "<TR> <TD COLSPAN=6> <CENTER> Имя </CENTER> </TD> <TD COLSPAN=2> <CENTER> Размер </CENTER> </TD> <TD COLSPAN=6> <CENTER> Описание </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2> ".round($filesize*1024*1024,0)." байт</TD>";
    }	
 elseif ($filesize > 1024) {
     echo "<TR> <TD COLSPAN=6> <CENTER> Имя </CENTER> </TD> <TD COLSPAN=2> <CENTER> Размер </CENTER> </TD> <TD COLSPAN=6> <CENTER> Описание </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2>".round($filesize/1024,0)." ГБ</TD>";
	} 
  else
    {
	 echo "<TR> <TD COLSPAN=6> <CENTER> Имя </CENTER> </TD> <TD COLSPAN=2> <CENTER> Размер </CENTER> </TD> <TD COLSPAN=6> <CENTER> Описание </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2>".round($filesize,2)." МБ</TD>";    
    }	

if(isset($foundfile[6])){ echo "<TD COLSPAN=6> ".$foundfile[6]."</TD> </TR>"; } 
else { echo "<TD COLSPAN=6> </TD> </TR>"; }
//$randcounter = rand(100,999);
?>
<TR> <TD COLSPAN=14 valign="top">
<?php $imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES); ?>
<CENTER>
<?php /*
if($downloadtimer == 0) {

	session_start(); 			// запускаем сессию

	include ("capcha.php"); 	// вызываем модуль с нашей CAPTCHA
	
	if (!isset($_REQUEST['capcha']))  // если пользователь не ввел ответ, формируем и выдаем ему вопрос
	{
		GenerateCAPTCHA(4);
		echo "<P>Введите следующие символы <BR> (для защиты от спама): <BR>&nbsp; &nbsp; &nbsp;<FONT color=#FCFE54>".$_SESSION['mycaptcha1_text']."&nbsp; &nbsp; &nbsp;</font> </p>";
		echo "<FORM method='POST' >";
		echo "<INPUT type='text' name='capcha'/>";
		echo "&nbsp; <INPUT type='submit' value='Отправить' />";
		echo "</FORM>"; 
	}
	else	// иначе проверяем правильность ответа пользователя и выдаем результат
	{	
		if ($_REQUEST['capcha'] == $_SESSION['mycaptcha1_text'])
			echo "<CENTER> <a title='".$imya_fayla."' alt='".$imya_fayla."' href=\"" .$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) . "\">Скачать</a> </CENTER> ";
		else {
			echo "<P>Неверно! Попробуйте еще раз.</p>";		
			GenerateCAPTCHA(4);
			echo "<P> Введите следующие символы <BR> (для защиты от спама): <BR>&nbsp; &nbsp; &nbsp;<FONT color=#FCFE54>".$_SESSION['mycaptcha1_text']."&nbsp; &nbsp; &nbsp;</font> </p>"; 
			echo "<FORM method='POST' >";
            echo "<INPUT type='text' name='capcha'/>";			
            echo "&nbsp; <INPUT type='submit' value='Отправить' />";
            echo "</FORM>"; 			
			}
	}
    
} else  {   

echo "If you're seeing this message, you need to enable JavaScript";
echo "Если вы видите данное сообщение, вам нужно включить JavaScript в настройках своего браузера";
echo "Esli vy vidite dannoe soobshenie, vam nuzhno vklyuchit JavaScript v nastroykah svoego brauzera";
 } */
  
 			echo "<CENTER> <a title='".$imya_fayla."' alt='".$imya_fayla."' href=\"" .$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) . "\">Скачать</a> </CENTER> "; 
 ?>
</CENTER>
</TD></TR>
<?php 
include("./preview.php"); /*Предварительный просмотр для изображений*/
include("./share.php"); /*Блок "Поделиться ссылкой на файл"*/ 
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>