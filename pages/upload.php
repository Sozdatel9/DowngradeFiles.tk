   <TR>
   <TD COLSPAN=14 BGCOLOR="#0402AC" VALIGN="TOP"> <BR>
   <CENTER> <FONT COLOR="#FCFE54" SIZE="+2"> <B> ������������� DowngradeFiles! </B> </FONT> </CENTER>
   <p>DowngradeFiles - ���������� �������������, ��������������� ��� ������ ����������� � ������ ������ ���������</p>
   <CENTER> <FONT COLOR="#FCFE54"> <B> ��������� ����  </B> </FONT>  </CENTER>	
   <FORM enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <TABLE WIDTH="100%" BORDER="0">
      <TR> <TD> <B> ������������ ������ �����: </B> </TD> <TD>  <?php echo $maxfilesize; ?> ��    <?php echo $filetypes; ?> </TD>  </TR>
	  <TR> <TD WIDTH="100%" COLSPAN="2"> <INPUT TYPE="file" NAME="upfile" SIZE="50" />  </TD> </TR> 
      <?php if($emailoption) { ?> <TR> <TD> E-Mail: </TD> <TD> <INPUT TYPE="text" NAME="myemail" SIZE="30" /> <FONT SIZE="-2">(�������������)</FONT> </TD> </TR> <?php } ?>
	  <?php if($descriptionoption) { ?> <TR> <TD> �������� �����: </TD> <TD> <INPUT TYPE="text" NAME="descr" SIZE="30" /> <FONT SIZE="-2">(�������������)</FONT> </TD> </TR> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <TR> <TD> ������ ��� ����������: </TD> <TD> <INPUT TYPE="password" NAME="pprotect" SIZE="30" /> <FONT SIZE="-2">(�������������)</FONT> </TD> </TR> -->}*/ ?>
	  <!-- ����������/������ ��������� --> 
	  <TR> <?php if(isset($categorylist)) { echo $categorylist; } ?> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> <BR> 
	  ������� �� ������ <INPUT TYPE="submit" VALUE="���������!" id="upload" />, ����� ������ �������� �����. 
	  </TD> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> ����� ���������: <B> <?php echo $fileshosted; ?> </B> <A HREF="../files.php">������</A> , ����� ������ ������� <B>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " ��.";}
	  else {echo "" .$sizehosted. " ��.";} 
	  ?>
	  </B> </TD> </TR> </TABLE>
	  </FORM>
	  <?php /*���������� ���� � ���������� <?php include("vnimanie.php");?>*/ ?>