<?php
$filemode = " ";
if (isset($_GET['cat']) || (isset($_GET['keyword']))) {$headertitle ='Rezultaty poiska faylov';}else{$headertitle = 'Vse fayly'; $filemode="on";}
include("./filetypes_lat.php");
include("./translit.php");
include("../config.php");
if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
$filesfound=0;
if(isset($_GET['cat'])){$filetype1 = $_GET['cat']; $filesfound=0;}else{$filetype1 = "null";}
if(isset($_GET['keyword'])){$keyword1 = $_GET['keyword']; $filesfound=0;
$keyword1 = trim($keyword1);
$keyword1_temp = translit($keyword1);}else{$keyword1 = "null";}

include("./header.php");

/*Преобразуем краткие обозначения типов файлов в понятный вид*/
if ($filetype1 == 'arc') {$filetype1_1 = $filetypes2[2];}
elseif ($filetype1 == 'docs') {$filetype1_1 = $filetypes2[9];}
elseif ($filetype1 == 'drv') {$filetype1_1 = $filetypes2[8];}
elseif ($filetype1 == 'books') {$filetype1_1 = $filetypes2[6];}
elseif ($filetype1 == 'mus') {$filetype1_1 = $filetypes2[0];}
elseif ($filetype1 == 'img') {$filetype1_1 = $filetypes2[4];}
elseif ($filetype1 == 'prg') {$filetype1_1 = $filetypes2[5];}
elseif ($filetype1 == 'pic') {$filetype1_1 = $filetypes2[3];}
elseif ($filetype1 == 'txt') {$filetype1_1 = $filetypes2[1];}
elseif ($filetype1 == 'web') {$filetype1_1 = $filetypes2[10];}
else {$filetype1_1 = $filetypes2[7];}
$filetype_footer = $filetype1_1;

if($enable_filelist==false){
echo "Eta stranica otklyuchena.";
include("./footer.php");
die();
}
?>
<TR> <TD COLSPAN="14" BGCOLOR="#0402AC" VALIGN="middle"> <BR>
<?php if (isset($_GET['cat']) || (isset($_GET['keyword']))) 
{echo "<center> <font color=\"#FCFE54\" size=\"+2\"> <b> Rezultaty poiska faylov"; if(($filetype1=="null") && ($keyword1 == "null")){echo "</b>";} else if ($keyword1 != "null") {echo " po zaprosu: </b> </font> <br> <font color=#FFFFFF size=+2>&laquo;".$keyword1_temp."&raquo;</font> </center>";} else{echo " tipa: </b> </font> <font color=#FFFFFF size=+2>".$filetype1_1."</font> </center>";}} 
else {echo"<center><font color=\"#FCFE54\" size=\"+2\"> <b>Vse Fayly</b> </font></center>";}/*<!--Список загруженных файлов-->*/?>
<table width="100%" cellpadding="1" cellspacing="1" border="1" bgcolor="#0402AC" bordercolor="#54FEFC">
<TR>
<td><center><b>Imya fayla</b></center></td>
<td><center><b>Razmer</b></center></td>
<td><center><b>Poslednii raz skachano</b></center></td>
<td><center><b>Skachano (raz)</b></center></td>
<td><center><b>Opisanie</b></center></td>
<td><center><b>Tip</b></center></td>
</TR>
<?php
$fileshosted=sizeof(file("../files.bd")); //get the # of files hosted

$sizehosted = 0; //get the storage size hosted

$sizehosted = 0; //get the storage size hosted
$handle = opendir("../storage/");
$pageSize=999999999; //количество файлов на одной странице

while($file = readdir($handle)) {
$sizehosted = $sizehosted + filesize ("../storage/".$file);
  if((is_dir("../storage/".$file.'/')) && ($file != '..')&&($file != '.'))
  {
  $sizehosted = $sizehosted + total_size("../storage/".$file.'/');
  }
}
$sizehosted = round($sizehosted/1024/1024,2);

$checkfiles=file("../files.bd");
//выводим массив со списком файлов в обратном порядке
//недавно загруженные файлы - сверху
$checkfiles1 = array_reverse($checkfiles);

foreach($checkfiles1 as $line)
{
  $thisline = explode('|', $line);
  $thisline[1]=translit($thisline[1]); 
//Ищем расширение файла
$pos =(strrpos($thisline[1], '.', -1)); 
$rasshirenie = substr($thisline[1],$pos);
if ((strcasecmp($rasshirenie, ".mp3") == 0) || (strcasecmp($rasshirenie, ".wav") == 0) || (strcasecmp($rasshirenie, ".mid") == 0) || (strcasecmp($rasshirenie, ".wma") == 0) || (strcasecmp($rasshirenie, ".aac") == 0) || (strcasecmp($rasshirenie, ".mod") == 0) || (strcasecmp($rasshirenie, ".kar") == 0) || (strcasecmp($rasshirenie, ".s3m") == 0) || (strcasecmp($rasshirenie, ".stm") == 0) || (strcasecmp($rasshirenie, ".amr") == 0))
{
        $filetype = $filetypes[0];
        $filetype1_1 = $filetypes2[0];
}

elseif ((strcasecmp($rasshirenie, ".txt") == 0) || (strcasecmp($rasshirenie, ".log") == 0)) 
{
        $filetype = $filetypes[1];
        $filetype1_1 = $filetypes2[1];
}

elseif ((strcasecmp($rasshirenie, ".zip") == 0) || (strcasecmp($rasshirenie, ".rar") == 0) || (strcasecmp($rasshirenie, ".7z") == 0) || (strcasecmp($rasshirenie, ".arj") == 0) || (strcasecmp($rasshirenie, ".lzh") == 0) || (strcasecmp($rasshirenie, ".lha") == 0) || (strcasecmp($rasshirenie, ".pak") == 0) || (strcasecmp($rasshirenie, ".sfx") == 0) || (strcasecmp($rasshirenie, ".gz") == 0) || (strcasecmp($rasshirenie, ".tar") == 0) || (strcasecmp($rasshirenie, ".bz") == 0) || (strcasecmp($rasshirenie, ".bzip") == 0) || (strcasecmp($rasshirenie, ".cab") == 0) || (strcasecmp($rasshirenie, ".ace") == 0) || (strcasecmp($rasshirenie, ".bz2") == 0))
{
        $filetype = $filetypes[2];
        $filetype1_1 = $filetypes2[2];
}

elseif ((strcasecmp($rasshirenie, ".jpg") == 0) || (strcasecmp($rasshirenie, ".jpeg") == 0) || (strcasecmp($rasshirenie, ".jpe") == 0) || (strcasecmp($rasshirenie, ".pcx") == 0) || (strcasecmp($rasshirenie, ".dib") == 0) || (strcasecmp($rasshirenie, ".bmp") == 0) || (strcasecmp($rasshirenie, ".pic") == 0) || (strcasecmp($rasshirenie, ".gif") == 0) || (strcasecmp($rasshirenie, ".lbm") == 0) || (strcasecmp($rasshirenie, ".png") == 0) || (strcasecmp($rasshirenie, ".svg") == 0) || (strcasecmp($rasshirenie, ".tiff") == 0) || (strcasecmp($rasshirenie, ".tif") == 0))
{
        $filetype = $filetypes[3];
        $filetype1_1 = $filetypes2[3];
}

elseif ((strcasecmp($rasshirenie, ".exe") == 0) || (strcasecmp($rasshirenie, ".bat") == 0) || (strcasecmp($rasshirenie, ".com") == 0) || (strcasecmp($rasshirenie, ".elf") == 0) || (strcasecmp($rasshirenie, ".ipa") == 0) || (strcasecmp($rasshirenie, ".apk") == 0) || (strcasecmp($rasshirenie, ".sis") == 0) || (strcasecmp($rasshirenie, ".msi") == 0) || (strcasecmp($rasshirenie, ".jar") == 0) || (strcasecmp($rasshirenie, ".jad") == 0) || (strcasecmp($rasshirenie, ".scr") == 0)) 
{
        $filetype = $filetypes[5];
        $filetype1_1 = $filetypes2[5];
}

elseif ((strcasecmp($rasshirenie, ".iso") == 0) || (strcasecmp($rasshirenie, ".cue") == 0) || (strcasecmp($rasshirenie, ".mds") == 0) || (strcasecmp($rasshirenie, ".mdf") == 0) || (strcasecmp($rasshirenie, ".ccd") == 0) || (strcasecmp($rasshirenie, ".nrg") == 0) || (strcasecmp($rasshirenie, ".img") == 0) || (strcasecmp($rasshirenie, ".cdr") == 0) || (strcasecmp($rasshirenie, ".isz") == 0) || (strcasecmp($rasshirenie, ".ima") == 0) ||
(strcasecmp($rasshirenie, ".ddi") == 0) || (strcasecmp($rasshirenie, ".vfd") == 0) || (strcasecmp($rasshirenie, ".2mg") == 0) || (strcasecmp($rasshirenie, ".dmg") == 0) || (strcasecmp($rasshirenie, ".vhd") == 0))  
{
        $filetype = $filetypes[4];
        $filetype1_1 = $filetypes2[4];
}

elseif ((strcasecmp($rasshirenie, ".fb2") == 0) || (strcasecmp($rasshirenie, ".fb3") == 0) || (strcasecmp($rasshirenie, ".prc") == 0) || (strcasecmp($rasshirenie, ".opf") == 0) || (strcasecmp($rasshirenie, ".epub") == 0))
{
        $filetype = $filetypes[6];
        $filetype1_1 = $filetypes2[6];
}

elseif ((strcasecmp($rasshirenie, ".cpi") == 0) || (strcasecmp($rasshirenie, ".sys") == 0) || (strcasecmp($rasshirenie, ".dll") == 0) || (strcasecmp($rasshirenie, ".inf") == 0) || (strcasecmp($rasshirenie, ".ini") == 0) || (strcasecmp($rasshirenie, ".bin") == 0) || (strcasecmp($rasshirenie, ".drv") == 0))
{
        $filetype = $filetypes[8];
        $filetype1_1 = $filetypes2[8];
}

elseif ((strcasecmp($rasshirenie, ".me") == 0) || (strcasecmp($rasshirenie, ".lex") == 0) || (strcasecmp($rasshirenie, ".tex") == 0) || (strcasecmp($rasshirenie, ".doc") == 0) || (strcasecmp($rasshirenie, ".docx") == 0) || (strcasecmp($rasshirenie, ".xls") == 0) || (strcasecmp($rasshirenie, ".xlsx") == 0) || (strcasecmp($rasshirenie, ".ppt") == 0) || (strcasecmp($rasshirenie, ".pptx") == 0) || (strcasecmp($rasshirenie, ".mdb") == 0) || (strcasecmp($rasshirenie, ".accdb") == 0) || (strcasecmp($rasshirenie, ".dbf") == 0) || (strcasecmp($rasshirenie, ".djvu") == 0) || (strcasecmp($rasshirenie, ".pdf") == 0) || (strcasecmp($rasshirenie, ".chm") == 0) || (strcasecmp($rasshirenie, ".hlp") == 0) || (strcasecmp($rasshirenie, ".djv") == 0))
{
        $filetype = $filetypes[9];
        $filetype1_1 = $filetypes2[9];
}

elseif ((strcasecmp($rasshirenie, ".htm") == 0) || (strcasecmp($rasshirenie, ".html") == 0) || (strcasecmp($rasshirenie, ".mht") == 0) || (strcasecmp($rasshirenie, ".mhtml") == 0) || (strcasecmp($rasshirenie, ".mhtm") == 0) || (strcasecmp($rasshirenie, ".css") == 0) || (strcasecmp($rasshirenie, ".shtm") == 0) || (strcasecmp($rasshirenie, ".shtml") == 0) || (strcasecmp($rasshirenie, ".vbs") == 0) || (strcasecmp($rasshirenie, ".js") == 0) || (strcasecmp($rasshirenie, ".php") == 0) || (strcasecmp($rasshirenie, ".phtml") == 0) || (strcasecmp($rasshirenie, ".php3") == 0) || (strcasecmp($rasshirenie, ".php4") == 0) || (strcasecmp($rasshirenie, ".php5") == 0) || (strcasecmp($rasshirenie, ".php6") == 0) || (strcasecmp($rasshirenie, ".sql") == 0) || (strcasecmp($rasshirenie, ".htaccess") == 0) || (strcasecmp($rasshirenie, ".hta") == 0) || (strcasecmp($rasshirenie, ".asp") == 0) || (strcasecmp($rasshirenie, ".aspx") == 0) || (strcasecmp($rasshirenie, ".ashx") == 0))
{
        $filetype = $filetypes[10];
        $filetype1_1 = $filetypes2[10];
}

else {$filetype = $filetypes[7]; $filetype1_1 = $filetypes2[7];} 
/*Убираем лишние символы из имени файла*/
$imya_fayla=htmlspecialchars($thisline[1], ENT_QUOTES);

if(($filetype1 ==  $filetype) && ($keyword1 = "null")){
  $filesfound = $filesfound + 1;
  $thisline[1] = translit($thisline[1]); 
  echo "<TR>
<td><a title='Skachat fayl ".$thisline[1]."' alt='Skachat fayl ".$thisline[1]."' href=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</a> </td>";
  
  $filesize = filesize("../storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if (($filesize < 1) && ($filesize > 0.001))
  {
     $filesize = round($filesize*1024,0);
     echo "<td>".$filesize." KB</td>";

  }
  
    elseif (($filesize < 1) && ($filesize < 0.001))
  {
     $filesize = round($filesize*1024*1024,0);
     echo "<td>".$filesize." bayt</td>";

  }
  
 elseif ($filesize > 1024) {
     $filesize = round($filesize/1024,0);
     echo "<td>".$filesize." GB</td>";
} 
  else
    {
     $filesize = round($filesize,2);
     echo "<td>".$filesize." MB</td>";
     
    }
$thisline[6]=translit($thisline[6]);	
echo "<td>".date('Y-m-d G:i', $thisline[4])."</td>
	  <td>".$thisline[5]."</td>
	  <td>".$thisline[6]."</td>
	  <td>".$filetype1_1."</td>
	  </tr>
	  ";}
else if($keyword1 !=  "null"){

  /*$pos1 = strripos($thisline[1], $keyword1);
  $pos1_1 = strripos(translit($thisline[1]), $keyword1);
  $pos3 = strripos($thisline[4], $keyword1);
  $pos3_1 = strripos(translit($thisline[4]), $keyword1);
  $pos4 = strripos($thisline[5], $keyword1);
  $pos4_1 = strripos(translit($thisline[5]), $keyword1);
  $pos5 = strripos($thisline[6], $keyword1); 
  $pos5_1 = strripos(translit($thisline[6]), $keyword1); */
  
  $tempstring1 = strtr( $thisline[1], 'ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁABCDEFGHIJKLMNOPQRSTUVWXYZ', 'йцукенгшщзхъфывапролджэячсмитьбюёabcdefghijklmnopqrstuvwxyz' );

  $tempstring2 = strtr( $thisline[6], 'ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁABCDEFGHIJKLMNOPQRSTUVWXYZ', 'йцукенгшщзхъфывапролджэячсмитьбюёabcdefghijklmnopqrstuvwxyz' );

  $tempstring3 = strtr( $keyword1, 'ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮЁABCDEFGHIJKLMNOPQRSTUVWXYZ', 'йцукенгшщзхъфывапролджэячсмитьбюёabcdefghijklmnopqrstuvwxyz' );
  $pos1 = strrpos($tempstring1, $tempstring3);
  $pos3 = strrpos($thisline[4], $keyword1);
  $pos4 = strrpos($thisline[5], $keyword1);
  $pos5 = strrpos($tempstring2, $tempstring3); 
 if (($pos1 !== false) || ($pos3 !== false) || ($pos4 !== false) || ($pos5 !== false)) {
  $filesfound = $filesfound + 1;
  echo "<TR>
<td><a title='Skachat fayl ".$thisline[1]."' alt='Skachat fayl ".$thisline[1]."' href=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</a> </td>";
  
  $filesize = filesize("../storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if (($filesize < 1) && ($filesize > 0.001))
  {
     $filesize = round($filesize*1024,0);
     echo "<td>".$filesize." KB</td>";

  }
  
    elseif (($filesize < 1) && ($filesize < 0.001))
  {
     $filesize = round($filesize*1024*1024,0);
     echo "<td>".$filesize." bayt</td>";

  }
  
 elseif ($filesize > 1024) {
     $filesize = round($filesize/1024,0);
     echo "<td>".$filesize." GB</td>";
} 
  else
    {
     $filesize = round($filesize,2);
     echo "<td>".$filesize." MB</td>";
     
    }
$thisline[6]=translit($thisline[6]);	
echo "<td>".date('Y-m-d G:i', $thisline[4])."</td>
	  <td>".$thisline[5]."</td>
	  <td>".$thisline[6]."</td>
	  <td>".$filetype1_1."</td>
	  </tr>
	  ";}
/*else{echo "";}*/} 
else if ($filemode == "on"){
/*Если включен режим отображения файлов, то...*/
//*********************************
$imya_fayla=htmlspecialchars($thisline[1], ENT_QUOTES);
 echo "<TR><td><a title='Skachat fayl ".$imya_fayla."' alt='Skachat fayl ".$imya_fayla."' href=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</a> </td>";
  
  $filesize = filesize("../storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if (($filesize < 1) && ($filesize > 0.001))
  {
     $filesize = round($filesize*1024,0);
     echo "<td>".$filesize." KB</td>";

  }
  
  elseif (($filesize < 1) && ($filesize < 0.001))
    {
     $filesize = round($filesize*1024*1024,0);
     echo "<td>".$filesize." bayt</td>";

    }
	
 elseif ($filesize > 1024) {
     $filesize = round($filesize/1024,0);
     echo "<td>".$filesize." GB</td>";
} 
  else
    {
     $filesize = round($filesize,2);
     echo "<td>".$filesize." MB</td>";
     
    }  	
$thisline[6]=translit($thisline[6]);
echo "<td>".date('Y-m-d G:i', $thisline[4])."</td>
	  <td>".$thisline[5]."</td>
	  <td>".$thisline[6]."</td>
	  <td>".$filetype1_1."</td>
	  </tr>
	  ";}
//*********************************
else {echo "";}
}
echo "</table>";
echo "</td> 
      </tr>	  
	  <TR>"; 
if(($filesfound > 0) && ($keyword1 == "null"))
{echo "<td colspan=14> <br /> <center> Naydeno <font color=#FCFE54> <b>".$filesfound." </b> </font> faylov tipa: <font color=#FFFFFF>".$filetype_footer."</font>";
}elseif(($filesfound > 0) && ($filetype1 == "null")){
echo "<td colspan=14> <br /> <center> Naydeno <font color=#FCFE54> <b>".$filesfound." </b> </font> faylov po zaprosu: <font color=#FFFFFF>&laquo;".$keyword1_temp."&raquo;</font>";}
else if ($filemode == "on"){echo "<td colspan=14> <br /> <center> Vsego zagruzheno <font color=#FCFE54><b> $fileshosted </b></font> faylov, obshii razmer kotoryh"; if ($sizehosted > 1024) {echo " " .(round($sizehosted/1024,1)). " Gigabayt.";}
else {echo "" .$sizehosted. " Megabayt.";}} 
else{echo "<td colspan=14> <br /> <center> Nichego ne naydeno!";}
echo "</center> </td> </tr>";  
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>