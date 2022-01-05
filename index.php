<?php

//***************************************************************************
//* Copyright (c) DowngradeFiles 2012-2013 год. E-Mail: Sozdatel9@gmail.com *
//***************************************************************************
  $headertitle = '';
  $result = ''; // Пока результат пуст
  $default_port = 80; // Порт по-умолчанию
 
  // А не в защищенном-ли мы соединении?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // В защищенном! Добавим протокол...
    $result .= 'https://';
    // ...и переназначим значение порта по-умолчанию
    $default_port = 443;
  } else {
    // Обычное соединение, обычный протокол
    $result .= 'http://';
  }
  // Имя сервера, напр. site.com или www.site.com
  $result .= $_SERVER['SERVER_NAME'];
 
  // А порт у нас по-умолчанию?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // Если нет, то добавим порт в URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // Последняя часть запроса (путь и GET-параметры).
  $result .= $_SERVER['REQUEST_URI'];
  $currentPageNews = strripos($result, 'news');
  $currentPageFAQ = strripos($result, 'faq');
  $currentPageSource = strripos($result, 'source');
  if ($currentPageNews !== false){$headertitle = 'Новости сайта';}
  else if ($currentPageFAQ !== false){$headertitle = 'FAQ - Часто задаваемые вопросы и ответы на них';}
  else if ($currentPageSource !== false){$headertitle = 'Исходные коды сайта DowngradeFiles';}
  else {$headertitle = 'Главная страница';}
include("./config.php");
include("./header.php");

//delete old files
/*$deleteseconds = time() - ($deleteafter * 24 * 60 * 60);
$fc=file("../files.bd");
$f=fopen("../files.bd","w");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[4] > $deleteseconds)
    fputs($f,$line);
  else
    unlink("../storage/".$thisline[0]);
}
fclose($f);*/
//done deleting old files

$fileshosted=sizeof(file("./files.bd")); //get the # of files hosted

$sizehosted = 0; //get the storage size hosted
$handle = opendir("./storage/");
while($file = readdir($handle)) {
$sizehosted = $sizehosted + filesize ("./storage/".$file);
  if((is_dir("./storage/".$file.'/')) && ($file != '..')&&($file != '.'))
  {
  $sizehosted = $sizehosted + total_size("./storage/".$file.'/');
  }
}
$sizehosted = round($sizehosted/1024/1024,2);

if(isset($allowedtypes)){ //get allowed filetypes.
  $types = implode(", ", $allowedtypes);
  $filetypes = "<B>Разрешенные форматы файлов:</B> ".$types."<BR /><BR />";
} else { $filetypes = ""; }

if(isset($categories)){ //get categories
  $categorylist = "<TD> Тип: </TD> <TD> <select name=\"category\"> ";
  foreach($categories as $category){
    $categorylist .= "<OPTION value=\"".$category."\">".$category."</OPTION>";
  }
  $categorylist .= "</SELECT></TD>";
} else { $filetypes = ""; }

if(isset($_GET['page']))
  $p = $_GET['page'];
else
  $p = "0";

switch($p) {
case "faq": include("./pages/faq.php"); break;
case "news": include("./pages/news.php"); break;
case "source": include("./pages/source.php"); break;
default: include("./pages/upload.php"); break;
//default: include("./pages/vnimanie.php"); break;
}
//include("./pages/donate.php");
include("./filetypes_win1251.php");
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>