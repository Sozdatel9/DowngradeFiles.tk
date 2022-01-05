   <TR>
   <TD COLSPAN=14 BGCOLOR="#0402AC" VALIGN="TOP"> <BR>
   <CENTER> <FONT COLOR="#FCFE54" SIZE="+2"> <B> Fayloobmennik DowngradeFiles! </B> </FONT> </CENTER>
   <p>DowngradeFiles - besplatnyi fayloobmennik, prednaznachennyi dlya staryh komp'yuterov i staryh versii brauzerov</p>   
   <CENTER> <FONT COLOR="#FCFE54"> <B> Zagruzit' fayl  </B> </FONT>  </CENTER>	
   <FORM enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <TABLE WIDTH="100%" BORDER="0">
      <TR> <TD> <B> Maksimal'nyi razmer fayla: </B> </TD> <TD>  <?php echo $maxfilesize; ?> Megabayt <?php echo $filetypes; ?> </TD>  </TR>
	  <TR> <TD WIDTH="100%" COLSPAN="2"> <INPUT TYPE="file" NAME="upfile" SIZE="50" />  </TD> </TR> 
      <?php if($emailoption) { ?> <TR> <TD> E-Mail: </TD> <TD> <INPUT TYPE="text" NAME="myemail" SIZE="30" /> <FONT SIZE="-2">(neobyazatel'no)</FONT> </TD> </TR> <?php } ?>
	  <?php if($descriptionoption) { ?> <TR> <TD> Opisanie fayla: </TD> <TD> <INPUT TYPE="text" NAME="descr" SIZE="30" /> <FONT SIZE="-2">(neobyazatel'no)</FONT> </TD> </TR> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <TR> <TD> Parol' dlya skachivaniya: </TD> <TD> <INPUT TYPE="password" NAME="pprotect" SIZE="30" /> <FONT SIZE="-2">(neobyazatel'no)</FONT> </TD> </TR> -->}*/ ?>
	  <!-- Otobrazit'/skryt' kategorii --> 
	  <TR> <?php if(isset($categorylist)) { echo $categorylist; } ?> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> <BR> 
	  Nazhmite na knopku <INPUT TYPE="submit" VALUE="Zagruzit'!" id="upload" />, chtoby nachat' zagruzku fayla. 
	  </TD> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> Vsego zagruzheno: <B> <?php echo $fileshosted; ?> </B> <A HREF="files.php">faylov</A> , obthiyj razmer kotoryh <B>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " Gigabayt.";}
	  else {echo "" .$sizehosted. " Megabayt.";} 
	  ?>
	  </B> </TD> </TR> </TABLE>
	  </FORM>
	  <?php /*Podkluchaem fayl s soobsheniem <?php include("vnimanie.php");?>*/ ?>