<?php
$filemode = " ";
if (isset($_GET['cat']) || (isset($_GET['keyword']))) {$headertitle ='�������� ���᪠ 䠩���';}else{$headertitle = '�� 䠩��'; $filemode="on";}
include("./filetypes_dos866.php");
include("../config.php");
if(isset($_GET['p'])){$pagenumb = $_GET['p']-1;}else{$pagenumb = "null";}
session_start();
$filesfound=0;
if(isset($_GET['cat'])){$filetype1 = $_GET['cat']; $filesfound=0;}else{$filetype1 = "null";}
if(isset($_GET['keyword'])){$keyword1 = $_GET['keyword']; $filesfound=0;
$keyword1 = trim($keyword1);}else{$keyword1 = "null";}

include("./header.php");

/*�८�ࠧ㥬 ��⪨� ������祭�� ⨯�� 䠩��� � ������ ���*/
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
echo "�� ��࠭�� �⪫�祭�.";
include("./footer.php");
die();
}
?>
<TR> <TD COLSPAN="14" BGCOLOR="#0402AC" VALIGN="middle"> <BR>
<?php if (isset($_GET['cat']) || (isset($_GET['keyword']))) 
{echo "<CENTER> <FONT color=\"#FCFE54\" size=\"+2\"> <B> �������� ���᪠ 䠩���"; if(($filetype1=="null") && ($keyword1 == "null")){echo "</B>";} else if ($keyword1 != "null") {echo " �� ������: </B> </FONT> <BR> <FONT color=#FFFFFF size=+2>&laquo;".$keyword1."&raquo;</FONT> </center>";} else{echo " ⨯�: </B> </FONT> <FONT color=#FFFFFF size=+2>".$filetype1_1."</FONT> </center>";}} 
else {echo"<CENTER><FONT color=\"#FCFE54\" size=\"+2\"> <B>�� 䠩��</B> </FONT></center>";}/*<!--���᮪ ����㦥���� 䠩���-->*/?>
<TABLE width="100%" cellpadding="1" cellspacing="1" BORDER="1" BGCOLOR="#0402AC" BORDERCOLOR="#54FEFC">
<TR>
<TD><CENTER><B>��� 䠩��</B></CENTER></TD>
<TD><CENTER><B>������</B></CENTER></TD>
<TD><CENTER><B>��᫥���� ࠧ ᪠砭�</B></CENTER></TD>
<TD><CENTER><B>���砭� (ࠧ)</B></CENTER></TD>
<TD><CENTER><B>���ᠭ��</B></CENTER></TD>
<TD><CENTER><B>���</B></CENTER></TD>
</TR>
<?php
$fileshosted=sizeof(file("../files.bd")); //get the # of files hosted

$sizehosted = 0; //get the storage size hosted

$sizehosted = 0; //get the storage size hosted
$handle = opendir("../storage/");
$maxpagesize=$maxfilesonpage; //������⢮ 䠩��� �� ����� ��࠭��

if ($filemode=="on") 
  {
     $totalpages = intval($fileshosted/$maxpagesize)+1;
     if($pagenumb == "null") {$pagenumb == 0;}		 		 
	 else if (($pagenumb <= 0) ) {$pagenumb = 0;}
	 else if ($pagenumb > $totalpages) { $pagenumb = $totalpages-1; }			 
  }	  
else { $maxpagesize = $fileshosted; };
	  
while($file = readdir($handle)) {
$sizehosted = $sizehosted + filesize ("../storage/".$file);
  if((is_dir("../storage/".$file.'/')) && ($file != '..')&&($file != '.'))
  {
  $sizehosted = $sizehosted + total_size("../storage/".$file.'/');
  }
}
$sizehosted = round($sizehosted/1024/1024,2);

$checkfiles=file("../files.bd");
//�뢮��� ���ᨢ � ᯨ᪮� 䠩��� � ���⭮� ���浪�
//������� ����㦥��� 䠩�� - ᢥ���
$checkfiles1 = array_reverse($checkfiles);
$filesononepage=0;
//foreach($checkfiles1 as $line)
foreach (array_slice($checkfiles1, $pagenumb*$maxpagesize, $maxpagesize) as $line)
{
  $thisline = explode('|', $line);
  $thisline[1] = iconv('windows-1251', 'cp866//IGNORE', $thisline[1]);  
//�饬 ���७�� 䠩��
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

elseif ((strcasecmp($rasshirenie, ".jpg") == 0) || (strcasecmp($rasshirenie, ".jpeg") == 0) || (strcasecmp($rasshirenie, ".jpe") == 0) || (strcasecmp($rasshirenie, ".pcx") == 0) || (strcasecmp($rasshirenie, ".dib") == 0) || (strcasecmp($rasshirenie, ".bmp") == 0) || (strcasecmp($rasshirenie, ".pic") == 0) || (strcasecmp($rasshirenie, ".gif") == 0) || (strcasecmp($rasshirenie, ".lbm") == 0) || (strcasecmp($rasshirenie, ".png") == 0) || (strcasecmp($rasshirenie, ".svg") == 0) || (strcasecmp($rasshirenie, ".tiff") == 0) || (strcasecmp($rasshirenie, ".tif") == 0) || (strcasecmp($rasshirenie, ".webp") == 0) || (strcasecmp($rasshirenie, ".heic") == 0))
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

else 
{ //*������塞 ��।������ �����⮬��� ��娢�� 7-zip, winrar � �.�
  $filetype = $filetypes[7]; $filetype1_1 = $filetypes2[7]; 
  $a1 = strrpos($rasshirenie, ".", -1);
  $tmpext = substr($rasshirenie,($a1+1));    
  if ((($tmpext > 0) && ($tmpext <= 999)) || ($tmpext == "000"))
  {
	$filetype = $filetypes[2];
    $filetype1_1 = $filetypes2[2];	 
  }
  unset($a1);
  unset($tmpext);  
} 
/*���ࠥ� ��譨� ᨬ���� �� ����� 䠩��*/
$imya_fayla=htmlspecialchars($thisline[1], ENT_QUOTES);

if(($filetype1 ==  $filetype) && ($keyword1 = "null")){
  $filesfound = $filesfound + 1;
  $thisline[1] = iconv('windows-1251', 'cp866//IGNORE', $thisline[1]); 
  echo "<TR><TD><A TITLE='������ 䠩� ".$thisline[1]."' ALT='������ 䠩� ".$thisline[1]."' HREF=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</A> </TD>";
  
  $filesize = filesize("../storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if (($filesize < 1) && ($filesize > 0.001))
  {
     $filesize = round($filesize*1024,0);
     echo "<TD>".$filesize." ��</TD>";

  }
  
    elseif (($filesize < 1) && ($filesize < 0.001))
  {
     $filesize = round($filesize*1024*1024,0);
     echo "<TD>".$filesize." ����</TD>";

  }
  
 elseif ($filesize > 1024) {
     $filesize = round($filesize/1024,0);
     echo "<TD>".$filesize." ��</TD>";
} 
  else
    {
     $filesize = round($filesize,2);
     echo "<TD>".$filesize." ��</TD>";
     
    }

$thisline[6] = iconv('windows-1251', 'cp866//IGNORE', $thisline[6]); 	
echo "<TD>".date('Y-m-d G:i', $thisline[4])."</TD>
	  <TD>".$thisline[5]."</TD>
	  <TD>".$thisline[6]."</TD>
	  <TD>".$filetype1_1."</TD>
	  </TR>
	  ";}
else if($keyword1 !=  "null"){

  $thisline[1] = iconv('windows-1251', 'cp866//IGNORE', $thisline[1]);
  $thisline[6] = iconv('windows-1251', 'cp866//IGNORE', $thisline[6]);
  $tempstring1 = strtr( $thisline[1], '���������������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ', '��㪥�������뢠�஫�����ᬨ����abcdefghijklmnopqrstuvwxyz' );

  $tempstring2 = strtr( $thisline[6], '���������������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ', '��㪥�������뢠�஫�����ᬨ����abcdefghijklmnopqrstuvwxyz' );

  $tempstring3 = strtr( $keyword1, '���������������������������������ABCDEFGHIJKLMNOPQRSTUVWXYZ', '��㪥�������뢠�஫�����ᬨ����abcdefghijklmnopqrstuvwxyz' );
  $pos1 = strrpos($tempstring1, $tempstring3);
  $pos3 = strrpos($thisline[4], $keyword1);
  $pos4 = strrpos($thisline[5], $keyword1);
  $pos5 = strrpos($tempstring2, $tempstring3); 
 if (($pos1 !== false) || ($pos3 !== false) || ($pos4 !== false) || ($pos5 !== false)) {
  $filesfound = $filesfound + 1;
  echo "<TR>
<TD><A TITLE='������ 䠩� ".$thisline[1]."' ALT='������ 䠩� ".$thisline[1]."' HREF=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</A> </TD>";
  
  $filesize = filesize("../storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if (($filesize < 1) && ($filesize > 0.001))
  {
     $filesize = round($filesize*1024,0);
     echo "<TD>".$filesize." ��</TD>";

  }
  
    elseif (($filesize < 1) && ($filesize < 0.001))
  {
     $filesize = round($filesize*1024*1024,0);
     echo "<TD>".$filesize." ����</TD>";

  }
  
 elseif ($filesize > 1024) {
     $filesize = round($filesize/1024,0);
     echo "<TD>".$filesize." ��</TD>";
} 
  else
    {
     $filesize = round($filesize,2);
     echo "<TD>".$filesize." ��</TD>";
     
    }		
echo "<TD>".date('Y-m-d G:i', $thisline[4])."</TD>
	  <TD>".$thisline[5]."</TD>
	  <TD>".$thisline[6]."</TD>
	  <TD>".$filetype1_1."</TD>
	  </TR>
	  ";}
/*else{echo "";}*/} 
else if ($filemode == "on"){
/*�᫨ ����祭 ०�� �⮡ࠦ���� 䠩���, �...*/
//*********************************
 $filesononepage++;
 $imya_fayla=htmlspecialchars($thisline[1], ENT_QUOTES);
 echo "<TR><TD><A TITLE='������ 䠩� ".$imya_fayla."' ALT='������ 䠩� ".$imya_fayla."' HREF=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</A> </TD>";
  
  $filesize = filesize("../storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if (($filesize < 1) && ($filesize > 0.001))
  {
     $filesize = round($filesize*1024,0);
     echo "<TD>".$filesize." ��</TD>";

  }
  
  elseif (($filesize < 1) && ($filesize < 0.001))
    {
     $filesize = round($filesize*1024*1024,0);
     echo "<TD>".$filesize." ����</TD>";

    }
	
 elseif ($filesize > 1024) {
     $filesize = round($filesize/1024,0);
     echo "<TD>".$filesize." ��</TD>";
} 
  else
    {
     $filesize = round($filesize,2);
     echo "<TD>".$filesize." ��</TD>";
     
    }  	
$thisline[6] = iconv('windows-1251', 'cp866//IGNORE', $thisline[6]);
echo "<TD>".date('Y-m-d G:i', $thisline[4])."</TD>
	  <TD>".$thisline[5]."</TD>
	  <TD>".$thisline[6]."</TD>
	  <TD>".$filetype1_1."</TD>
	  </TR>
	  ";}
//*********************************
else {echo "";}
}
echo "</TABLE>";
echo "</TD> 
      </TR>	  
	  <TR>"; 
if(($filesfound > 0) && ($keyword1 == "null"))
{echo "<TD COLSPAN=14> <BR /> <CENTER> ������� <FONT color=#FCFE54> <B>".$filesfound." </B> </FONT> 䠩��� ⨯�: <FONT color=#FFFFFF>".$filetype_footer."</FONT>";
}elseif(($filesfound > 0) && ($filetype1 == "null")){
echo "<TD COLSPAN=14> <BR /> <CENTER> ������� <FONT color=#FCFE54> <B>".$filesfound." </B> </FONT> 䠩��� �� ������: <FONT color=#FFFFFF>&laquo;".$keyword1."&raquo;</FONT>";}
else if ($filemode == "on"){echo "<TD COLSPAN=14> <BR /> <CENTER> �ᥣ� ����㦥�� <FONT color=#FCFE54><B> $fileshosted </B></FONT> 䠩���, ��騩 ࠧ��� ������"; if ($sizehosted > 1024) {echo " " .(round($sizehosted/1024,1)). " ��.";}
else {echo "" .$sizehosted. " ��.";} echo "</CENTER>";

echo "<TABLE WIDTH=\"100%\" BORDER=\"0\" cellspacing=\"0\" cellpadding=\"0\" BGCOLOR=\"#0402AC\" BORDERCOLOR=\"#54FEFC\">";
echo "<TR>";
echo "<TD COLSPAN=\"2\" VALIGN=CENTER><BR> <CENTER> �������� <FONT COLOR=#FCFE54> <B>$filesononepage </B> </FONT> 䠩��� �� <FONT COLOR=#FFFFFF>".($pagenumb+1)."</FONT> ��࠭�� �� <FONT COLOR=#FFFFFF>".$totalpages."</FONT> </CENTER></TD>";
echo "</TR>";
echo "<TR>";
echo "<TD VALIGN=\"TOP\">";
echo "�롥�� �㦭�� ��࠭��� �� ᯨ᪠:";
echo "</TD>";
echo "<TD VALIGN=\"TOP\" ALIGN=\"right\">";
echo "<FORM ACTION=\"files.php\" METHOD=\"GET\">";
echo "<SELECT NAME=\"p\">";
for ($i=0; $i<$totalpages; $i++) {
    $pg11 = $i+1;
    if ($i == $pagenumb) {echo "<OPTION VALUE=\"$pg11\" selected=\"selected\">���. $pg11";}  
    else {echo "<OPTION VALUE=\"$pg11\">���. $pg11";}
}
echo "</SELECT>";
echo "<INPUT TYPE=\"submit\" value=\"��\">";
echo "</FORM>";
echo "</TD>";
echo "</TR>";
echo "<TR>";
echo "<TD VALIGN=\"TOP\">";
echo "��� ��३��� �� ��뫪� � ����஬ ��࠭���:";
echo "</TD>";
echo "<TD VALIGN=\"TOP\" ALIGN=\"right\">";
for ($i=0; $i<$totalpages; $i++) {
  $pg1 = $i+1;
  if ($i == $pagenumb) { echo "	<FONT COLOR=#54FEFC>".($pg1)."</FONT>&nbsp;&nbsp;"; }
  else { echo "	<A HREF=\"files.php?p=".$pg1."\" ALT=\"��३� �� ".$pg1." ��࠭���\" TITLE=\"��३� �� ".$pg1." ��࠭���\" >".($pg1)."</A>&nbsp;&nbsp;"; }
}
echo "</TD></TR><TR><TD COLSPAN=2 ALIGN=CENTER>&nbsp;&nbsp;</TD></TR></TABLE>";
}
else{echo "<TD COLSPAN=14> <BR /> <CENTER> ��祣� �� �������! </CENTER>";}
echo "</TD> </TR>";  
/*���� ����࠭�筮� ������樨*/
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>