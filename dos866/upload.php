<?php
$headertitle = 'Загрузить файл';
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
    echo "Загрузка данного файла запрещена </TD> </TR>";
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "Загрузка файлов с вашего компьютера запрещена </TD> </TR>";
    include("./footer.php");
    die();
  }
}

$checkfiles=file("../files.bd");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    echo "Данный файл уже загружен на сервер. </TD> </TR> ";
    echo "<TR> <TD COLSPAN=14> Ссылка на скачивание данного файла: <A href=\"" . $scripturl . "dos866/download.php?file=" . $filecrc . "\">". $scripturl . "dos866/download.php?file=" . $filecrc . "</A> </TD> </TR>";
    echo "<TR> <TD COLSPAN=14> Поскольку данный файл уже был кем-то загружен, вы не можете его удалить с сервера. </TD> </TR>";
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
   echo "Файлы этого формата запрещены для загрузки на сайт </TD> </TR>";
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
   echo "Выбрана неправильная категория! </TD> </TR>";
   include("./footer.php");
   die();
}
$cat = $_POST['categories'];
} 
else { $cat = NULL; }


  
if($filesize==0) {
echo "Вы не выбрали ни один файл для загрузки </TD> </TR>";
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo "Вы пытаетесь загрузить слишком большой файл </TD> </TR>";
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
echo "Вы слишком торопитесь! Подождите немного ($sekunds секунд) и попробуйте загрузить файл еще раз.  </TD> </TR>";
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
$uploadmsg = "Загрузка вашего файла (".$filename.") завершена.\n <BR> Ссылка на скачивание файла: ". $scripturl . "dos866/download.php?file=" . $filecrc . "\n <BR> Ссылка для удаления файла: ". $scripturl . "dos866/download.php?file=" . $filecrc . "&del=" . $passkey . "\n <BR> Благодарим за использование нашего файлообменника!";
mail($_POST['myemail'],"Ваш загруженный файл",$uploadmsg,"От: admin@downgradefiles.pdp-11.ru\n");
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
/*Добавляем транслитерацию имени*/
$trans_temp = iconv('cp866', 'windows-1251', $_FILES['upfile']['name']);
$imya_translitom = translit($trans_temp);
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

echo "Ваш файл успешно загружен!</TD> </TR>";
echo "<TR> <TD COLSPAN=14> Ссылка на скачивание файла: <A href=\"" . $scripturl . "dos866/download.php?file=" . $filecrc . "\">". $scripturl . "dos866/download.php?file=" . $filecrc . "</A> </TD> </TR>";
echo "<TR> <TD COLSPAN=14> Ссылка для удаления файла: <A href=\"" . $scripturl . "dos866/download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "dos866/download.php?file=" . $filecrc . "&del=" . $passkey . "</A> </TD> </TR>";
echo "<TR> <TD COLSPAN=14> Пожалуйста запомните эти ссылки или запишите их где-нибудь. </TD> </TR>";
echo "<TR> <TD COLSPAN=14> <A HREF=\"" .$scripturl. "dos866/showqr.php?file=" . $filecrc . "\" TARGET=\"_blank\">QR-код (ссылка откроется в новой вкладке или новом окне)</A> </TD> </TR>";
include("./footer.php");
?>