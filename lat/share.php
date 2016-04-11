<?php 
/*Блок "Поделиться ссылкой на файл"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR=#FCFE54><CENTER>Razmestite ssylku na dannyi fayl u sebya na saite, forume, bloge. <BR>Prosto skopiruyte sleduyushii kod:</CENTER></FONT><br>
<B>Tekstovaya ssylka:</B><BR>
<textarea name='' cols=50 rows=5>&lt;a href=&quot;<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>&quot; title=&quot;Skachat fayl <?php echo $imya_fayla;?>&quot; alt=&quot;Skachat fayl <?php echo $imya_fayla;?>&quot; &gt;Skachat fayl <?php echo $imya_fayla;?>&lt;/a&gt;</textarea>
<p>Ona vygladit vot tak:&nbsp;&nbsp; <a href="<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>">Skachat fayl <?php echo $imya_fayla;?></A></P>
<B>BB-kod ssylki dlya forumov:</B>
<br><textarea name='' cols=50 rows=5>[URL=<?php echo "" .$scripturl. "download.php?file=" . $filecrc . "";?>]Skachat fayl <?php echo $imya_fayla;?>[/URL]</textarea></TD></TR>