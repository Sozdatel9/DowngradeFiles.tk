<?php
$headertitle = '������������ QR-���';
include("./config.php");

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  include("./header.php");  	
  echo "<TR> <TD COLSPAN=14> �������� ������ ��� ��������� QR-����  </TD> </TR>";
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
	$headertitle = 'QR-��� ����� ' . $foundfile[1] ."";
    include("./header.php");  	
  }
}

if($foundfile==0) {
  include("./header.php");
  echo "<TR> <TD COLSPAN=14>�������� ������ ��� ��������� QR-���� </TD> </TR>";
  include("./footer.php");
  die();
}
     $imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);
     echo "<TR> <TD COLSPAN=6> <CENTER> QR-��� </CENTER> </TD>  <TD COLSPAN=8> <CENTER> ������ </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> <CENTER><IMG SRC=\"".$scripturl. "qr.php?file=" . $filecrc . "\" HEIGHT=150px></CENTER> </TD> <TD COLSPAN=8>" .$imya_fayla. "<BR><BR>".$scripturl. "download.php?file=" . $filecrc . "</TD>";
?>
<TR> <TD COLSPAN=14 valign="top">
<CENTER>
<?php 
echo "<CENTER> <A HREF=\"" .$scripturl. "download.php?file=" . $filecrc . "\">����� � ���������� ��������</A> </CENTER> ";
?>
</CENTER>
</TD> </TR>
<?php 
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>