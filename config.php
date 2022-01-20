<?php

$scripturl = "http://www.downgradefiles.tk/";

//// the URL to this script with a trailing slash

$adminpass = "test1234";
//// set this password to something other than default
//// it will be used to access the admin panel

$maxfilesize = 800;
//// the maximum file size allowed to be uploaded (in megabytes)

$maxfilesonpage = 250;
//// the maximum number of files on one page in filelist

$downloadtimelimit = (1/2);
//// time users must wait before downloading another file (in minutes)

$uploadtimelimit = (1/2);
//// time users must wait before uploading another file (in minutes)

$nolimitsize = 0;
//// if a file is under this many megabytes, there is no time limit

$deleteafter = 9999999999;
//// delete files if not downloaded after this many days

$downloadtimer = 0;
//// length of the timer on the download page (in seconds)

$enable_filelist = true;
//// allows users to see a list of uploaded files. set to false to disable

//$allowedtypes = array("txt","gif","jpg","jpeg");
//// remove the //'s from the above line to enable file extention blocking
//// only file extentions that are noted in the above array will be allowed

$emailoption = true;
//// set this to true to allow users to email themselves the download links

$passwordoption = true;
//// set this to true to allow users to password protect their uploads

$descriptionoption = true;
//// set this to true to disable the description field

//$categories = array("Muzic","Text","Arhiv","Imagez","PictureZ","Appz","Bookz","Dokumentz");
//// remove the //'s from the above line to enable categories
//// Users will be able to choose from this list of categories

function request_address()
{
  $result = ''; // Пока результат пуст
  
  $result .= $_SERVER['SERVER_NAME'];
 
  return $result;
}

/*
$adres=request_address();

if ($adres == 'www.downgradefiles.tk')
{
  $mirror1 = 'dgfiles.tk';
  $mirror1_title ='www.DGFiles.TK';
  $mirror2 = 'downgradefiles.ml';
  $mirror2_title = 'www.DowngradeFiles.ML';
}

if ($adres == 'www.downgradefiles.ml')
{
  $mirror1 = 'dgfiles.tk';
  $mirror1_title ='www.DGFiles.TK';
  $mirror2 = 'downgradefiles.tk';
  $mirror2_title = 'www.DowngradeFiles.TK';
}

if ($adres == 'www.dgfiles.tk')
{
  $mirror1 = 'downgradefiles.tk';
  $mirror1_title = 'www.DowngradeFiles.TK';  
  $mirror2 = 'downgradefiles.ml';
  $mirror2_title = 'www.DowngradeFiles.ML';    
}*/
?>