<?php 
/*���� "���������� ��뫪�� �� 䠩�"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR="#FCFE54"><CENTER>�������� ��뫪� �� ����� 䠩� � ᥡ� �� ᠩ�, ��㬥, �����. <BR>���� ᪮����� ᫥���騩 ���:</CENTER></FONT><BR>
<B>����⮢�� ��뫪� � ���ᠭ���:</B><BR>
<TEXTAREA name='' cols=80 rows=3>&lt;a href=&quot;<?php echo "" .$scripturl. "dos866/download.php?file=" . $filecrc . "";?>&quot; title=&quot;������ 䠩� <?php echo $imya_fayla;?>&quot; alt=&quot;������ 䠩� <?php echo $imya_fayla;?>&quot; &gt;������ 䠩� <?php echo $imya_fayla;?>&lt;/a&gt;</TEXTAREA>
<P>��� �룫廊� ��� ⠪:&nbsp;&nbsp; <A HREF=<?php echo "\"" .$scripturl. "dos866/download.php?file=" . $filecrc . "\"";?>>������ 䠩� <?php echo $imya_fayla;?></A></P>
<B>����� ��뫪� (��� ��.�⥩, ���ᥭ���஢ � �.�):</B><BR>
<TEXTAREA name='' cols=80 rows=2><?php echo "" .$scripturl. "dos866/download.php?file=" . $filecrc . "";?></TEXTAREA>
<P><B><A HREF=<?php echo "\"" .$scripturl. "dos866/showqr.php?file=" . $filecrc . "\"";?> TARGET="_blank">QR-��� (��뫪� ��஥��� � ����� ������� ��� ����� ����)</A></B></P>
<B>BB-��� ��뫪� ��� ��㬮�:</B>
<BR><TEXTAREA name='' cols=80 rows=3>[URL=<?php echo "" .$scripturl. "dos866/download.php?file=" . $filecrc . "";?>]������ 䠩� <?php echo $imya_fayla;?>[/URL]</TEXTAREA></TD></TR>