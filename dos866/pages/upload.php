   <TR>
   <TD COLSPAN=14 BGCOLOR="#0402AC" VALIGN="TOP"> <BR>
   <CENTER> <FONT COLOR="#FCFE54" SIZE="+2"> <B> ������������� DowngradeFiles! </B> </FONT> </CENTER>
   <p>DowngradeFiles - ��ᯫ��� 䠩����������, �।�����祭�� ��� ����� �������஢ � ����� ���ᨩ ��㧥஢</p>
   <CENTER> <FONT COLOR="#FCFE54"> <B> ����㧨�� 䠩�  </B> </FONT>  </CENTER>	
   <FORM enctype="multipart/form-data" action="upload.php" id="form" method="post">
   <TABLE WIDTH="100%" BORDER="0">
      <TR> <TD> <B> ���ᨬ���� ࠧ��� 䠩��: </B> </TD> <TD>  <?php echo $maxfilesize; ?> ��    <?php echo $filetypes; ?> </TD>  </TR>
	  <TR> <TD WIDTH="100%" COLSPAN="2"> <INPUT TYPE="file" NAME="upfile" SIZE="50" />  </TD> </TR> 
      <?php if($emailoption) { ?> <TR> <TD> E-Mail: </TD> <TD> <INPUT TYPE="text" NAME="myemail" SIZE="30" /> <FONT SIZE="-2">(����易⥫쭮)</FONT> </TD> </TR> <?php } ?>
	  <?php if($descriptionoption) { ?> <TR> <TD> ���ᠭ�� 䠩��: </TD> <TD> <INPUT TYPE="text" NAME="descr" SIZE="30" /> <FONT SIZE="-2">(����易⥫쭮)</FONT> </TD> </TR> <?php } ?>
	  <?php /*if($passwordoption) {/*<!-- <TR> <TD> ��஫� ��� ᪠稢����: </TD> <TD> <INPUT TYPE="password" NAME="pprotect" SIZE="30" /> <FONT SIZE="-2">(����易⥫쭮)</FONT> </TD> </TR> -->}*/ ?>
	  <!-- �⮡ࠧ���/����� ��⥣�ਨ --> 
	  <TR> <?php if(isset($categorylist)) { echo $categorylist; } ?> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> <BR> 
	  ������ �� ������ <INPUT TYPE="submit" VALUE="����㧨��!" id="upload" />, �⮡� ����� ����㧪� 䠩��. 
	  </TD> </TR>
	  <TR> <TD COLSPAN="2" VALIGN="TOP" ALIGN="CENTER"> �ᥣ� ����㦥��: <B> <?php echo $fileshosted; ?> </B> <A HREF="files.php">䠩���</A> , ��騩 ࠧ��� ������ <B>
	  <?php 
	  if ($sizehosted > 1024) {echo "" .(round($sizehosted/1024,1)). " ��.";}
	  else {echo "" .$sizehosted. " ��.";} 
	  ?>
	  </B> </TD> </TR> </TABLE>
	  </FORM>
	  <?php /*������砥� 䠩� � ᮮ�饭��� <?php include("vnimanie.php");?>*/ ?>