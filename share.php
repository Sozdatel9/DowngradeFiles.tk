<?php 
/*���� "���������� ������� �� ����"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR=#FCFE54><CENTER>���������� ������ �� ������ ���� � ���� �� �����, ������, �����. <BR>������ ���������� ��������� ���:</CENTER></FONT><br>
<B>��������� ������:</B><BR>
<textarea name='' cols=50 rows=5>&lt;a href=&quot;<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>&quot; title=&quot;������� ���� <?php echo $imya_fayla;?>&quot; alt=&quot;������� ���� <?php echo $imya_fayla;?>&quot; &gt;������� ���� <?php echo $imya_fayla;?>&lt;/a&gt;</textarea>
<p>��� �������� ��� ���:&nbsp;&nbsp; <a href="<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>">������� ���� <?php echo $imya_fayla;?></A></P>
<B>BB-��� ������ ��� �������:</B>
<br><textarea name='' cols=50 rows=5>[URL=<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>]������� ���� <?php echo $imya_fayla;?>[/URL]</textarea></TD></TR>