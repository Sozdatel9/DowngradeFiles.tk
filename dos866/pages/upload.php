   <tr>
   <td colspan=14 bgcolor="#0402AC" valign="top"> <br>
   <center> <font color="#FCFE54" size="+2"> <b> ������������� DowngradeFiles! </b> </font> </center>
   <p>DowngradeFiles - ��ᯫ��� 䠩����������, �।�����祭�� ��� ����� �������஢ � ����� ���ᨩ ��㧥஢</p>
   <center> <font color="#FCFE54"> <b> ����㧨�� 䠩�  </b> </font>  </center>	
   <form enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <table width="100%" border="0">
      <tr> <td> <b> ���ᨬ���� ࠧ��� 䠩��: </b> </td> <td>  <?php echo $maxfilesize; ?> ��    <?php echo $filetypes; ?> </td>  </tr>
	  <tr> <td width="100%" colspan="2"> <input type="file" name="upfile" size="50" />  </td> </tr> 
      <?php if($emailoption) { ?> <tr> <td> E-Mail: </td> <td> <input type="text" name="myemail" size="30" /> <font size="-2">(����易⥫쭮)</font> </td> </tr> <?php } ?>
	  <?php if($descriptionoption) { ?> <tr> <td> ���ᠭ�� 䠩��: </td> <td> <input type="text" name="descr" size="30" /> <font size="-2">(����易⥫쭮)</font> </td> </tr> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <tr> <td> ��஫� ��� ᪠稢����: </td> <td> <input type="password" name="pprotect" size="30" /> <font size="-2">(����易⥫쭮)</font> </td> </tr> -->}*/ ?>
	  <!-- �⮡ࠧ���/����� ��⥣�ਨ --> 
	  <tr> <?php if(isset($categorylist)) { echo $categorylist; } ?> </tr>
	  <tr> <td colspan="2" valign="top" align="center"> <br> 
	  ������ �� ������ <input type="submit" value="����㧨��!" id="upload" />, �⮡� ����� ����㧪� 䠩��. 
	  </td> </tr>
	  <tr> <td colspan="2" valign="top" align="center"> �ᥣ� ����㦥��: <b> <?php echo $fileshosted; ?> </b> <a href="files.php">䠩���</a> , ��騩 ࠧ��� ������ <b>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " ��.";}
	  else {echo "" .$sizehosted. " ��.";} 
	  ?>
	  </b> </td> </tr> </table>
	  </form>
	  <?php /*������砥� 䠩� � ᮮ�饭��� <?php include("vnimanie.php");?>*/ ?>