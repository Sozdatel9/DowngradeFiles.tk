<?php
$headertitle = '������� ����';
include("./config.php");
include("./header.php");

$bans=file("./bans.bd");

foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    echo "<tr> <td colspan=14> ���������� ������ � ������ ���������� ��������� </td> </tr>";
    include("./footer.php");
    die();
  }
}

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  echo "<tr> <td colspan=14> �������� ������ �� ���������� �����. </td> </tr>";
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
unlink("./storage/".$_GET['file']);
echo "<tr> <td colspan=14> ��� ���� ��� ������� �����. </td> </tr>";
} else {
echo "<tr> <td colspan=14> �������� ������ �� �������� �����. </td> </tr>";
}
include("./footer.php");
die();

}

if($foundfile==0) {
  echo "<tr> <td colspan=14> �������� ������ �� ���������� �����. </td> </tr>";
  include("./footer.php");
  die();
}

if(isset($foundfile[7]) && $foundfile[7]!=md5("") && (!isset($_POST['pass']) || $foundfile[7] != md5($_POST['pass']))){
echo "<tr> <td colspan=14 height=0px> <br> <form action=\"download.php?file=".$foundfile[0]."\" method=\"post\">������� ������ ��� ���������� ������� �����: <input type=\"password\" name=\"pass\"><input type=\"submit\" value=\"������� ����\" /></form> </td> </tr>";
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
echo "<tr> <td colspan=14> �� ������� �������! ��������� ��� ������� � ���������� ������� ���� ��� ���. </td> </tr>";
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
     echo "<tr> <td colspan=6> <center> ��� </center> </td> <td colspan=2> <center> ������ </center> </td> <td colspan=6> <center> �������� </center> </td> </tr> <tr> <td colspan=6> ".$foundfile[1]." </td> <td colspan=2> ".round($filesize*1024,0)." ��</td>";
    }
  elseif (($filesize < 1) && ($filesize < 0.001))
    {
     echo "<tr> <td colspan=6> <center> ��� </center> </td> <td colspan=2> <center> ������ </center> </td> <td colspan=6> <center> �������� </center> </td> </tr> <tr> <td colspan=6> ".$foundfile[1]." </td> <td colspan=2> ".round($filesize*1024*1024,0)." ����</td>";
    }	
 elseif ($filesize > 1024) {
     echo "<tr> <td colspan=6> <center> ��� </center> </td> <td colspan=2> <center> ������ </center> </td> <td colspan=6> <center> �������� </center> </td> </tr> <tr> <td colspan=6> ".$foundfile[1]." </td> <td colspan=2>".round($filesize/1024,0)." ��</td>";
	} 
  else
    {
	 echo "<tr> <td colspan=6> <center> ��� </center> </td> <td colspan=2> <center> ������ </center> </td> <td colspan=6> <center> �������� </center> </td> </tr> <tr> <td colspan=6> ".$foundfile[1]." </td> <td colspan=2>".round($filesize,2)." ��</td>";    
    }	

if(isset($foundfile[6])){ echo "<td colspan=6> ".$foundfile[6]."</td> </tr>"; } 
else { echo "<td colspan=6> </td> </tr>"; }
$randcounter = rand(100,999);
?>
<tr> <td colspan=14 valign="top">
<?php $imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES); ?>
<center>
<?php 
if($downloadtimer == 0) {

	session_start(); 			// ��������� ������

	include ("capcha.php"); 	// �������� ������ � ����� CAPTCHA
	
	if (!isset($_REQUEST['capcha']))		// ���� ������������ �� ���� �����, ��������� � ������ ��� ������
	{
		GenerateCAPTCHA(4);
		echo "<p>������� ��������� ������� <br> (��� ������ �� �����): <br>&nbsp; &nbsp; &nbsp;<font color=#FCFE54>".$_SESSION['mycaptcha1_text']."&nbsp; &nbsp; &nbsp;</font> </p>";
		echo "<form method='POST' >";
		echo "<input type='text' name='capcha'/>";
		echo "&nbsp; <input type='submit' value='���������' />";
		echo "</form>"; 
	}
	else	// ����� ��������� ������������ ������ ������������ � ������ ���������
	{	
		if ($_REQUEST['capcha'] == $_SESSION['mycaptcha1_text'])
			echo "<center> <a title='".$imya_fayla."' alt='".$imya_fayla."' href=\"" .$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) . "\">�������</a> </center> ";
		else {
			echo "<p>�������! ���������� ��� ���.</p>";		
			GenerateCAPTCHA(4);
			echo "<p> ������� ��������� ������� <br> (��� ������ �� �����): <br>&nbsp; &nbsp; &nbsp;<font color=#FCFE54>".$_SESSION['mycaptcha1_text']."&nbsp; &nbsp; &nbsp;</font> </p>"; 
			echo "<form method='POST' >";
            echo "<input type='text' name='capcha'/>";			
            echo "&nbsp; <input type='submit' value='���������' />";
            echo "</form>"; 			
			}
	}
    
} else  {   ?>

If you're seeing this message, you need to enable JavaScript
���� �� ������ ������ ���������, ��� ����� �������� JavaScript � ���������� ������ ��������
Esli vy vidite dannoe soobshenie, vam nuzhno vklyuchit JavaScript v nastroykah svoego brauzera
<?php } ?>
</center>
<script language="Javascript">
x<?php echo $randcounter; ?>=<?php echo $downloadtimer; ?>;
function countdown() 
{
 if ((0 <= 100) || (0 > 0))
 {
  x<?php echo $randcounter; ?>--;
  if(x<?php echo $randcounter; ?> == 0)
  {
   document.getElementById("dl").innerHTML = ' <a href="<?php echo $scripturl . "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) ?>">�������</a> </td> </tr>';
  }
  if(x<?php echo $randcounter; ?> > 0)
  {
   document.getElementById("dl").innerHTML = '�������� ����� <b>'+x<?php echo $randcounter; ?>+'</b> ������.. </td> </tr>';
   setTimeout('countdown()',1000);
  }
 }
}
countdown();
</script>
</td> </tr>
<?php 
include("./preview.php"); /*��������������� �������� ��� �����������*/
include("./share.php"); /*���� "���������� ������� �� ����"*/ 
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>