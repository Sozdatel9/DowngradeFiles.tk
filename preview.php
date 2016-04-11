<?php 
/*Предварительный просмотр изображений*/
/*E-Mail: Sozdatel9@gmail.com*/

//Ищем расширение файла
$pos =(strrpos($foundfile[1], '.', -1)); 
$rasshirenie = substr($foundfile[1],$pos);

//Обрабатываем имя файла
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);
//Если файл является изображением, то выводим его на экран
if ((strcasecmp($rasshirenie, ".jpg") == 0) || (strcasecmp($rasshirenie, ".jpeg") == 0) || (strcasecmp($rasshirenie, ".jpe") == 0) || (strcasecmp($rasshirenie, ".pcx") == 0) || (strcasecmp($rasshirenie, ".dib") == 0) || (strcasecmp($rasshirenie, ".bmp") == 0) || (strcasecmp($rasshirenie, ".pic") == 0) || (strcasecmp($rasshirenie, ".gif") == 0) || (strcasecmp($rasshirenie, ".lbm") == 0) || (strcasecmp($rasshirenie, ".png") == 0) || (strcasecmp($rasshirenie, ".svg") == 0) || (strcasecmp($rasshirenie, ".tiff") == 0) || (strcasecmp($rasshirenie, ".tif") == 0))
{
if ($filesize > 1) {
        echo "<tr><td valign=top colspan=14><center><font size='+1' color=#FCFE54>Предварительный просмотр</font></center><br><center>Предварительный просмотр недоступен, поскольку картинка слишком большая</center></td></tr>";
	}
else {
        echo "<tr><td valign=top colspan=14><center><font size='+1' color=#FCFE54>Предварительный просмотр</font></center><br><center><img title='".$imya_fayla."' alt='".$imya_fayla."' src=\"" .$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) . "\" width=\"400px\"></center></td></tr>";
	 }
}
else {/*Иначе - ничего не делаем !*/}
?>