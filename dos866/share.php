<?php 
/*���� "���������� ��뫪�� �� 䠩�"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR=#FCFE54><CENTER>�������� ��뫪� �� ����� 䠩� � ᥡ� �� ᠩ�, ��㬥, �����. <BR>���� ᪮����� ᫥���騩 ���:</CENTER></FONT><br>
<B>����⮢�� ��뫪�:</B><BR>
<textarea name='' cols=50 rows=5>&lt;a href=&quot;<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>&quot; title=&quot;������ 䠩� <?php echo $imya_fayla;?>&quot; alt=&quot;������ 䠩� <?php echo $imya_fayla;?>&quot; &gt;������ 䠩� <?php echo $imya_fayla;?>&lt;/a&gt;</textarea>
<p>��� �룫廊� ��� ⠪:&nbsp;&nbsp; <a href="<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>">������ 䠩� <?php echo $imya_fayla;?></A></P>
<B>BB-��� ��뫪� ��� ��㬮�:</B>
<br><textarea name='' cols=50 rows=5>[URL=<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>]������ 䠩� <?php echo $imya_fayla;?>[/URL]</textarea></TD></TR>