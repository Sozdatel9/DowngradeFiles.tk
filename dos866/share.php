<?php 
/*Блок "Поделиться ссылкой на файл"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR="#FCFE54"><CENTER>Разместите ссылку на данный файл у себя на сайте, форуме, блоге. <BR>Просто скопируйте следующий код:</CENTER></FONT><BR>
<B>Текстовая ссылка с описанием:</B><BR>
<TEXTAREA name='' cols=80 rows=3>&lt;a href=&quot;<?php echo "" .$scripturl. "dos866/download.php?file=" . $filecrc . "";?>&quot; title=&quot;Скачать файл <?php echo $imya_fayla;?>&quot; alt=&quot;Скачать файл <?php echo $imya_fayla;?>&quot; &gt;Скачать файл <?php echo $imya_fayla;?>&lt;/a&gt;</TEXTAREA>
<P>Она выглядит вот так:&nbsp;&nbsp; <A HREF=<?php echo "\"" .$scripturl. "dos866/download.php?file=" . $filecrc . "\"";?>>Скачать файл <?php echo $imya_fayla;?></A></P>
<B>Простая ссылка (для соц.сетей, мессенджеров и т.д):</B><BR>
<TEXTAREA name='' cols=80 rows=2><?php echo "" .$scripturl. "dos866/download.php?file=" . $filecrc . "";?></TEXTAREA>
<P><B><A HREF=<?php echo "\"" .$scripturl. "dos866/showqr.php?file=" . $filecrc . "\"";?> TARGET="_blank">QR-код (ссылка откроется в новой вкладке или новом окне)</A></B></P>
<B>BB-код ссылки для форумов:</B>
<BR><TEXTAREA name='' cols=80 rows=3>[URL=<?php echo "" .$scripturl. "dos866/download.php?file=" . $filecrc . "";?>]Скачать файл <?php echo $imya_fayla;?>[/URL]</TEXTAREA></TD></TR>