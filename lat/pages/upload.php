   <tr>
   <td colspan=14 bgcolor="#0402AC" valign="top"> <br>
   <center> <font color="#FCFE54" size="+2"> <b> Fayloobmennik DowngradeFiles! </b> </font> </center>
   <p>DowngradeFiles - besplatnyi fayloobmennik, prednaznachennyi dlya staryh komp'yuterov i staryh versii brauzerov</p>   
   <center> <font color="#FCFE54"> <b> Zagruzit' fayl  </b> </font>  </center>	
   <form enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <table width="100%" border="0">
      <tr> <td> <b> Maksimal'nyi razmer fayla: </b> </td> <td>  <?php echo $maxfilesize; ?> Megabayt <?php echo $filetypes; ?> </td>  </tr>
	  <tr> <td width="100%" colspan="2"> <input type="file" name="upfile" size="50" />  </td> </tr> 
      <?php if($emailoption) { ?> <tr> <td> E-Mail: </td> <td> <input type="text" name="myemail" size="30" /> <font size="-2">(neobyazatel'no)</font> </td> </tr> <?php } ?>
	  <?php if($descriptionoption) { ?> <tr> <td> Opisanie fayla: </td> <td> <input type="text" name="descr" size="30" /> <font size="-2">(neobyazatel'no)</font> </td> </tr> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <tr> <td> Parol' dlya skachivaniya: </td> <td> <input type="password" name="pprotect" size="30" /> <font size="-2">(neobyazatel'no)</font> </td> </tr> -->}*/ ?>
	  <!-- Otobrazit'/skryt' kategorii --> 
	  <tr> <?php if(isset($categorylist)) { echo $categorylist; } ?> </tr>
	  <tr> <td colspan="2" valign="top" align="center"> <br> 
	  Nazhmite na knopku <input type="submit" value="Zagruzit'!" id="upload" />, chtoby nachat' zagruzku fayla. 
	  </td> </tr>
	  <tr> <td colspan="2" valign="top" align="center"> Vsego zagruzheno: <b> <?php echo $fileshosted; ?> </b> <a href="files.php">faylov</a> , obthiyj razmer kotoryh <b>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " Gigabayt.";}
	  else {echo "" .$sizehosted. " Megabayt.";} 
	  ?>
	  </b> </td> </tr> </table>
	  </form>
	  <?php /*Podkluchaem fayl s soobsheniem <?php include("vnimanie.php");?>*/ ?>