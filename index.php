<?php

//***************************************************************************
//* Copyright (c) DowngradeFiles 2012-2013 ���. E-Mail: Sozdatel9@gmail.com *
//***************************************************************************
  $headertitle = '';
  $result = ''; // ���� ��������� ����
  $default_port = 80; // ���� ��-���������
 
  // � �� � ����������-�� �� ����������?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // � ����������! ������� ��������...
    $result .= 'https://';
    // ...� ������������ �������� ����� ��-���������
    $default_port = 443;
  } else {
    // ������� ����������, ������� ��������
    $result .= 'http://';
  }
  // ��� �������, ����. site.com ��� www.site.com
  $result .= $_SERVER['SERVER_NAME'];
 
  // � ���� � ��� ��-���������?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // ���� ���, �� ������� ���� � URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // ��������� ����� ������� (���� � GET-���������).
  $result .= $_SERVER['REQUEST_URI'];
  $currentPageNews = strripos($result, 'news');
  $currentPageFAQ = strripos($result, 'faq');
  $currentPageSource = strripos($result, 'source');
  if ($currentPageNews !== false){$headertitle = '������� �����';}
  else if ($currentPageFAQ !== false){$headertitle = 'FAQ - ����� ���������� ������� � ������ �� ���';}
  else if ($currentPageSource !== false){$headertitle = '�������� ���� ����� DowngradeFiles';}
  else {$headertitle = '������� ��������';}
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
  $filetypes = "<B>����������� ������� ������:</B> ".$types."<BR /><BR />";
} else { $filetypes = ""; }

if(isset($categories)){ //get categories
  $categorylist = "<TD> ���: </TD> <TD> <select name=\"category\"> ";
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