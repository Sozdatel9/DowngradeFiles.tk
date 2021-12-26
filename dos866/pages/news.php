   <TR> <TD COLSPAN=14 BGCOLOR="#04AAAC"> <CENTER> 
   <FONT COLOR="#FFFFFF" SIZE="+1"> <B>Новости сайта</B> </FONT> </CENTER> </TD> </TR>
<?php 
//Подключаем функцию для вывода возраста

function declension($number, array $data)
{
$rest = array($number % 10, $number % 100);
 
if($rest[1] > 10 && $rest[1] < 20) {
return $data[2];
} elseif ($rest[0] > 1 && $rest[0] < 5) {
return $data[1];
} else if ($rest[0] == 1) {
return $data[0];
}
 
return $data[2];
}
//echo $number, ' ', declension($number, array('год', 'года', 'лет'));
  
$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/year.dat", 'r') or die("Не удалось открыть файл");
$newYearDate;
$anniversaryDate;
$i = 0;
while(!feof($fd) && ($i < 2))
{
    $str = htmlentities(fgets($fd));
	if ($i == 0) {$newYearDate = $str;}
	if ($i == 1) {$anniversaryDate = $str;}
	$i++;
}
fclose($fd);
unset($str);
//Проверяем, нужно ли вставить сообщение с поздравлением с новым годом

// Меняем часовой пояс на Europe/Moscow
date_default_timezone_set('Europe/Moscow');
$currentDate = date('m/d/Y');


//Если дата 1 января, то добавляем подзравление с новым годом
if (strtotime($currentDate)==(strtotime($newYearDate))) { 
	$a1=$_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm";
	$a2=fopen($a1,"r"); // открываем для чтения
	$text=fread($a2,filesize($a1)); //читаем
	fclose($a2);	 
	$currYear = date("Y");
	$f=fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm","w"); // открываем для записи
	// пишем нашу строку и к ней добавляем раннее содержимое файла
	$what1="<TR>"."\n"; // строка
	$what2="<TD VALIGN=TOP COLSPAN=2><FONT COLOR=#FCFE54>01.01.".$currYear." </FONT></TD>"."\n"; // строка
	$what3="<TD VALIGN=TOP COLSPAN=12>- Администрация файлообменника DowngradeFiles поздравляет "."\n"; // строка
	$what4="всех посетителей сайта с Новым ".$currYear. " годом !<BR>"."\n"; // строка
	$what5="Пусть в этом году сбудутся все ваши мечты и надежды ! Успехов в делах и удачи во "."\n"; // строка
	$what6="всех начинаниях !<BR></TD>"."\n"; // строка
	$what7="</TR>"."\n"; // строка
	fwrite($f,$what1.$what2.$what3.$what4.$what5.$what6.$what7.$text);
	fclose($f);	
	unset($what1);
    unset($what2);
    unset($what3);
    unset($what4);
    unset($what5);
    unset($what6);
    unset($what7);
	$currYear++;
	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/year.dat", 'w') or die("Не удалось создать файл");
	$str = date('01/01/'.$currYear);
	fwrite($fd, $str."\n");
	$str = $anniversaryDate;
	fwrite($fd, $str);
	fclose($fd);
	$currYear=0;
}

//Если дата 20 января, то добавляем подзравление с годовщиной
else if (strtotime($currentDate)==(strtotime($anniversaryDate))) { 
	$a1=$_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm";
	$a2=fopen($a1,"r"); // открываем для чтения
	$text=fread($a2,filesize($a1)); //читаем
	fclose($a2);	   
	$currYear = date("Y");    
	$annvYear = $currYear - 2014;
	$annvYearStr = declension($annvYear, array('год', 'года', 'лет'));
	$f=fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm","w"); // открываем для записи
	// пишем нашу строку и к ней добавляем раннее содержимое файла
	$what1="<TR>"."\n"; // строка
	$what2="<TD VALIGN=TOP COLSPAN=2><FONT COLOR=#FCFE54>20.01.".$currYear." </FONT></TD>"."\n"; // строка
	$what3="<TD VALIGN=TOP COLSPAN=12>- Файлообменнику DowngradeFiles исполнилось ровно ".$annvYear. " ".$annvYearStr." </TD>"."\n"; // строка
	$what4="</TR>"."\n"; // строка
	fwrite($f,$what1.$what2.$what3.$what4.$text);
	fclose($f);
    unset($what1);
    unset($what2);
    unset($what3);
    unset($what4);	    
	$currYear++;
	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/year.dat", 'w') or die("Не удалось создать файл");
	$str = $newYearDate;
	fwrite($fd, $str);
	$str = date('01/20/'.$currYear);
	fwrite($fd, $str);
	fclose($fd);
	$currYear=0;
}




include ($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm"); 

?>