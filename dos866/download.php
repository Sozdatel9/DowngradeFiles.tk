<?php
$headertitle = '������ 䠩�';
include("../config.php");
include("./header.php");

$bans=file("../bans.bd");

foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    echo "<TR> <TD COLSPAN=14>���稢���� 䠩��� � ��襣� �������� ����饭� </TD> </TR>";
    include("./footer.php");
    die();
  }
}

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  echo "<TR> <TD COLSPAN=14>����ୠ� ��뫪� �� ᪠稢���� 䠩��. </TD> </TR>";
  include("./footer.php");
  die();
}

$checkfiles=file("../files.bd");
$foundfile=0;
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    $foundfile=$thisline;
  }
}

if(isset($_GET['del'])) {

$fc=file("../files.bd");
$f=fopen("../files.bd","w");
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
unlink("../storage/".$_GET['file']);
 echo "<TR> <TD COLSPAN=14>��� 䠩� �� �ᯥ譮 㤠��. </TD> </TR>";
} 
else {
 echo "<TR> <TD COLSPAN=14>����ୠ� ��뫪� �� 㤠����� 䠩��. </TD> </TR>";
}
include("./footer.php");
die();

}

if($foundfile==0) {
  echo "<TR> <TD COLSPAN=14>����ୠ� ��뫪� �� ᪠稢���� 䠩��. </TD> </TR>";
  include("./footer.php");
  die();
}

if(isset($foundfile[7]) && $foundfile[7]!=md5("") && (!isset($_POST['pass']) || $foundfile[7] != md5($_POST['pass']))){
echo "<TR> <TD COLSPAN=14 height=0px> <BR> <FORM action=\"download.php?file=".$foundfile[0]."\" method=\"post\">������ ��஫� ��� ᪠稢���� ������� 䠩��: <INPUT type=\"password\" name=\"pass\"><INPUT type=\"submit\" value=\"������ 䠩�\" /></FORM> </TD> </TR>";
include("./footer.php");
die();
}

$filesize = filesize("../storage/".$foundfile[0]);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize) {

$userip=$_SERVER['REMOTE_ADDR'];
$time=time();
$downloaders = fopen("../downloaders.bd","r+");
flock($downloaders,2);
while (!feof($downloaders)) { 
$user[] = chop(fgets($downloaders,65536));
}
fseek($downloaders,0,SEEK_SET);
ftruncate($downloaders,0);
foreach ($user as $line) {
list($savedip,$savedtime) = explode("|",$line);
$foundfile[1] = iconv('windows-1251', 'cp866//IGNORE', $foundfile[1]);
if ($savedip == $userip) {
if ($time < $savedtime + ($downloadtimelimit*60)) {
echo "<TR> <TD COLSPAN=14>�� ᫨誮� ᯥ��! �������� �� ������� � ���஡�� ᪠��� 䠩� �� ࠧ. </TD> </TR>";
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
     echo "<TR> <TD COLSPAN=6> <CENTER> ��� </CENTER> </TD> <TD COLSPAN=2> <CENTER> ������ </CENTER> </TD> <TD COLSPAN=6> <CENTER> ���ᠭ�� </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2> ".round($filesize*1024,0)." ��</TD>";
    }
  elseif (($filesize < 1) && ($filesize < 0.001))
    {
     echo "<TR> <TD COLSPAN=6> <CENTER> ��� </CENTER> </TD> <TD COLSPAN=2> <CENTER> ������ </CENTER> </TD> <TD COLSPAN=6> <CENTER> ���ᠭ�� </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2> ".round($filesize*1024*1024,0)." ����</TD>";
    }	
 elseif ($filesize > 1024) {
     echo "<TR> <TD COLSPAN=6> <CENTER> ��� </CENTER> </TD> <TD COLSPAN=2> <CENTER> ������ </CENTER> </TD> <TD COLSPAN=6> <CENTER> ���ᠭ�� </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2>".round($filesize/1024,0)." ��</TD>";
	} 
  else
    {
	 echo "<TR> <TD COLSPAN=6> <CENTER> ��� </CENTER> </TD> <TD COLSPAN=2> <CENTER> ������ </CENTER> </TD> <TD COLSPAN=6> <CENTER> ���ᠭ�� </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> ".$foundfile[1]." </TD> <TD COLSPAN=2>".round($filesize,2)." ��</TD>";    
    }	

if(isset($foundfile[6])){ 
$foundfile[6] = iconv('windows-1251', 'cp866//IGNORE', $foundfile[6]); echo "<TD COLSPAN=6> ".$foundfile[6]."</TD> </TR>"; } 
else { echo "<TD COLSPAN=6> </TD> </TR>"; }
//$randcounter = rand(100,999);
?>
<TR> <TD COLSPAN=14 valign="top">
<?php $imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES); ?>
<CENTER>
<?php 
if($downloadtimer == 0) {

	session_start(); 			// ����᪠�� ����

	include ("../capcha.php"); 	// ��뢠�� ����� � ��襩 CAPTCHA
	
	if (!isset($_REQUEST['capcha']))  // �᫨ ���짮��⥫� �� ���� �⢥�, �ନ�㥬 � �뤠�� ��� �����
	{
		GenerateCAPTCHA(4);
		echo "<P>������ ᫥���騥 ᨬ���� <BR> (��� ����� �� ᯠ��): <BR>&nbsp; &nbsp; &nbsp;<FONT color=#FCFE54>".$_SESSION['mycaptcha1_text']."&nbsp; &nbsp; &nbsp;</font> </p>";
		echo "<FORM method='POST' >";
		echo "<INPUT type='text' name='capcha'/>";	
		echo "&nbsp; <INPUT type='submit' value='��ࠢ���' />";
		echo "</FORM>"; 
	}
	else	// ���� �஢��塞 �ࠢ��쭮��� �⢥� ���짮��⥫� � �뤠�� १����
	{	
		if ($_REQUEST['capcha'] == $_SESSION['mycaptcha1_text'])
			echo "<CENTER> <a title='".$imya_fayla."' alt='".$imya_fayla."' href=\"" .$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) . "\">������</a> </CENTER> ";
		else {
			echo "<P>����୮! ���஡�� �� ࠧ.</p>";		
			GenerateCAPTCHA(4);
			echo "<P>������ ᫥���騥 ᨬ���� <BR> (��� ����� �� ᯠ��): <BR>&nbsp; &nbsp; &nbsp;<FONT color=#FCFE54>".$_SESSION['mycaptcha1_text']."&nbsp; &nbsp; &nbsp;</font> </p>"; 
			echo "<FORM method='POST' >";
            echo "<INPUT type='text' name='capcha'/>";
            echo "&nbsp; <INPUT type='submit' value='��ࠢ���' />";
            echo "</FORM>"; 			
			}
	}
    
} else  {   

echo "If you're seeing this message, you need to enable JavaScript";
echo "�᫨ �� ����� ������ ᮮ�饭��, ��� �㦭� ������� JavaScript � ����ன��� ᢮��� ��㧥�";
echo "Esli vy vidite dannoe soobshenie, vam nuzhno vklyuchit JavaScript v nastroykah svoego brauzera";
 } ?>
</CENTER>
</TD> </TR>
<?php 
include("./preview.php"); /*�।���⥫�� ��ᬮ�� ��� ����ࠦ����*/
include("./share.php"); /*���� "���������� ��뫪�� �� 䠩�"*/ 
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>