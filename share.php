<?php 
/*���� "���������� ������� �� ����"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR="#FCFE54"><CENTER>���������� ������ �� ������ ���� � ���� �� �����, ������, �����. <BR>������ ���������� ��������� ���:</CENTER></FONT><BR>
<B>��������� ������ � ���������:</B><BR>
<TEXTAREA name='' cols=80 rows=3>&lt;a href=&quot;<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>&quot; title=&quot;������� ���� <?php echo $imya_fayla;?>&quot; alt=&quot;������� ���� <?php echo $imya_fayla;?>&quot; &gt;������� ���� <?php echo $imya_fayla;?>&lt;/a&gt;</TEXTAREA>
<P>��� �������� ��� ���:&nbsp;&nbsp; <A HREF=<?php echo "\"" .$scripturl. "download.php?file=" . $filecrc . "\"";?>>������� ���� <?php echo $imya_fayla;?></A></P>
<B>������� ������ (��� ���.�����, ������������ � �.�):</B><BR>
<TEXTAREA name='' cols=80 rows=2><?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?></TEXTAREA>
<P><B><A HREF=<?php echo "\"" .$scripturl. "showqr.php?file=" . $filecrc . "\"";?> TARGET="_blank">QR-��� (������ ��������� � ����� ������� ��� ����� ����)</A></B></P>
<B>BB-��� ������ ��� �������:</B>
<BR><TEXTAREA name='' cols=80 rows=3>[URL=<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>]������� ���� <?php echo $imya_fayla;?>[/URL]</TEXTAREA></TD></TR>