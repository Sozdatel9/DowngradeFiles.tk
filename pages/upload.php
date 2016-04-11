   <tr>
   <td colspan=14 bgcolor="#0402AC" valign="top"> <br>
   <center> <font color="#FCFE54" size="+2"> <b> Файлообменник DowngradeFiles! </b> </font> </center>
   <p>DowngradeFiles - бесплатный файлообменник, предназначенный для старых компьютеров и старых версий браузеров</p>
   <center> <font color="#FCFE54"> <b> Загрузить файл  </b> </font>  </center>	
   <form enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <table width="100%" border="0">
      <tr> <td> <b> Максимальный размер файла: </b> </td> <td>  <?php echo $maxfilesize; ?> МБ    <?php echo $filetypes; ?> </td>  </tr>
	  <tr> <td width="100%" colspan="2"> <input type="file" name="upfile" size="50" />  </td> </tr> 
      <?php if($emailoption) { ?> <tr> <td> E-Mail: </td> <td> <input type="text" name="myemail" size="30" /> <font size="-2">(необязательно)</font> </td> </tr> <?php } ?>
	  <?php if($descriptionoption) { ?> <tr> <td> Описание файла: </td> <td> <input type="text" name="descr" size="30" /> <font size="-2">(необязательно)</font> </td> </tr> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <tr> <td> Пароль для скачивания: </td> <td> <input type="password" name="pprotect" size="30" /> <font size="-2">(необязательно)</font> </td> </tr> -->}*/ ?>
	  <!-- Отобразить/скрыть категории --> 
	  <tr> <?php if(isset($categorylist)) { echo $categorylist; } ?> </tr>
	  <tr> <td colspan="2" valign="top" align="center"> <br> 
	  Нажмите на кнопку <input type="submit" value="Загрузить!" id="upload" />, чтобы начать загрузку файла. 
	  </td> </tr>
	  <tr> <td colspan="2" valign="top" align="center"> Всего загружено: <b> <?php echo $fileshosted; ?> </b> <a href="../files.php">файлов</a> , общий размер которых <b>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " ГБ.";}
	  else {echo "" .$sizehosted. " МБ.";} 
	  ?>
	  </b> </td> </tr> </table>
	  </form>
	  <?php /*Подключаем файл с сообщением <?php include("vnimanie.php");?>*/ ?>