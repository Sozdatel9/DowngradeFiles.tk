<?php 
/*Блок "Поделиться ссылкой на файл"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR=#FCFE54><CENTER>Разместите ссылку на данный файл у себя на сайте, форуме, блоге. <BR>Просто скопируйте следующий код:</CENTER></FONT><br>
<B>Текстовая ссылка:</B><BR>
<textarea name='' cols=50 rows=5>&lt;a href=&quot;<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>&quot; title=&quot;Скачать файл <?php echo $imya_fayla;?>&quot; alt=&quot;Скачать файл <?php echo $imya_fayla;?>&quot; &gt;Скачать файл <?php echo $imya_fayla;?>&lt;/a&gt;</textarea>
<p>Она выглядит вот так:&nbsp;&nbsp; <a href="<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>">Скачать файл <?php echo $imya_fayla;?></A></P>
<B>BB-код ссылки для форумов:</B>
<br><textarea name='' cols=50 rows=5>[URL=<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>]Скачать файл <?php echo $imya_fayla;?>[/URL]</textarea></TD></TR>