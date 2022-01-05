   <TR>
   <TD COLSPAN=14 BGCOLOR="#0402AC" VALIGN="TOP"> <BR>
   <CENTER> <FONT COLOR="#FCFE54" SIZE="+2"> <B> Файлообменник DowngradeFiles! </B> </FONT> </CENTER>
   <p>DowngradeFiles - бесплатный файлообменник, предназначенный для старых компьютеров и старых версий браузеров</p>
   <CENTER> <FONT COLOR="#FCFE54"> <B> Загрузить файл  </B> </FONT>  </CENTER>	
   <FORM enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <TABLE WIDTH="100%" BORDER="0">
      <TR> <TD> <B> Максимальный размер файла: </B> </TD> <TD>  <?php echo $maxfilesize; ?> МБ    <?php echo $filetypes; ?> </TD>  </TR>
	  <TR> <TD WIDTH="100%" COLSPAN="2"> <INPUT TYPE="file" NAME="upfile" SIZE="50" />  </TD> </TR> 
      <?php if($emailoption) { ?> <TR> <TD> E-Mail: </TD> <TD> <INPUT TYPE="text" NAME="myemail" SIZE="30" /> <FONT SIZE="-2">(необязательно)</FONT> </TD> </TR> <?php } ?>
	  <?php if($descriptionoption) { ?> <TR> <TD> Описание файла: </TD> <TD> <INPUT TYPE="text" NAME="descr" SIZE="30" /> <FONT SIZE="-2">(необязательно)</FONT> </TD> </TR> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <TR> <TD> Пароль для скачивания: </TD> <TD> <INPUT TYPE="password" NAME="pprotect" SIZE="30" /> <FONT SIZE="-2">(необязательно)</FONT> </TD> </TR> -->}*/ ?>
	  <!-- Отобразить/скрыть категории --> 
	  <TR> <?php if(isset($categorylist)) { echo $categorylist; } ?> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> <BR> 
	  Нажмите на кнопку <INPUT TYPE="submit" VALUE="Загрузить!" id="upload" />, чтобы начать загрузку файла. 
	  </TD> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> Всего загружено: <B> <?php echo $fileshosted; ?> </B> <A HREF="../files.php">файлов</A> , общий размер которых <B>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " ГБ.";}
	  else {echo "" .$sizehosted. " МБ.";} 
	  ?>
	  </B> </TD> </TR> </TABLE>
	  </FORM>
	  <?php /*Подключаем файл с сообщением <?php include("vnimanie.php");?>*/ ?>