<?php
$headertitle = 'Generirovat QR-kod';
include("../config.php");

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  include("./header.php");  	
  echo "<TR> <TD COLSPAN=14> Nevernaya ssylka dlya generacii QR-koda </TD> </TR>";
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
	$headertitle = 'QR-kod fayla ' . $foundfile[1] ."";
    include("./header.php");  	
  }
}

if($foundfile==0) {
  include("./header.php");
  echo "<TR> <TD COLSPAN=14>Nevernaya ssylka dlya generacii QR-koda </TD> </TR>";
  include("./footer.php");
  die();
}
     $imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);
     echo "<TR> <TD COLSPAN=6> <CENTER> QR-kod </CENTER> </TD>  <TD COLSPAN=8> <CENTER> Ssylka </CENTER> </TD> </TR> <TR> <TD COLSPAN=6> <CENTER><IMG SRC=\"".$scripturl. "lat/qr.php?file=" . $filecrc . "\" HEIGHT=150px></CENTER> </TD> <TD COLSPAN=8> " .$imya_fayla. "<BR><BR>".$scripturl. "lat/download.php?file=" . $filecrc . "</TD>";
?>
<TR> <TD COLSPAN=14 valign="top">
<CENTER>
<?php 
echo "<CENTER> <A HREF=\"" .$scripturl. "lat/download.php?file=" . $filecrc . "\">Nazad k predydushei stranice</A> </CENTER> ";
?>
</CENTER>
</TD> </TR>
<?php 
include("./search.php");
//include("./mirrors.php");
include("./footer.php");
?>