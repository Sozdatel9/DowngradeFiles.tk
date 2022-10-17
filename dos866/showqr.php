<?php
$headertitle = 'Генерировать QR-код';
include("../config.php");

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  include("./header.php");  	
  echo "<TR> <TD COLSPAN=14> Неверная ссылка для генерации QR-кода  </TD> </TR>";
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
	$headertitle = 'QR-код файла ' . $foundfile[1] ."";
	include("./header.php");
  }
}

if($foundfile==0) {
  include("./header.php");	
  echo "<TR> <TD COLSPAN=14>Неверная ссылка для генерации QR-кода </TD> </TR>";
  include("./footer.php");
  die();
}
     $imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);
     echo "<TR> <TD COLSPAN=6> <CENTER> QR-код </CENTER> </TD>  <TD COLSPAN=8> <CENTER> Ссылка </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> <CENTER><IMG SRC=\"".$scripturl. "dos866/qr.php?file=" . $filecrc . "\" HEIGHT=150px></CENTER> </TD> <TD COLSPAN=8> " .$imya_fayla. "<BR><BR>".$scripturl. "dos866/download.php?file=" . $filecrc . "</TD>";
?>
<TR> <TD COLSPAN=14 valign="top">
<CENTER>
<?php 
echo "<CENTER> <A HREF=\"" .$scripturl. "dos866/download.php?file=" . $filecrc . "\">Назад к предыдущей странице</A> </CENTER> ";
?>
</CENTER>
</TD> </TR>
<?php 
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>