<?php 
/*Блок "Поделиться ссылкой на файл"*/
/*E-Mail: Sozdatel9@gmail.com*/
$imya_fayla=htmlspecialchars($foundfile[1], ENT_QUOTES);?>
<TR><TD VALIGN=top COLSPAN=14><FONT COLOR="#FCFE54"><CENTER>Razmestite ssylku na dannyi fayl u sebya na saite, forume, bloge. <BR>Prosto skopiruyte sleduyushii kod:</CENTER></FONT><BR>
<B>Tekstovaya ssylka s opisaniem:</B><BR>
<TEXTAREA name='' cols=80 rows=3>&lt;a href=&quot;<?php echo "" .$scripturl. "lat/download.php?file=" . $filecrc . "";?>&quot; title=&quot;Skachat fayl <?php echo $imya_fayla;?>&quot; alt=&quot;Skachat fayl <?php echo $imya_fayla;?>&quot; &gt;Skachat fayl <?php echo $imya_fayla;?>&lt;/a&gt;</TEXTAREA>
<P>Ona vygladit vot tak:&nbsp;&nbsp; <A HREF=<?php echo "\"" .$scripturl. "lat/download.php?file=" . $filecrc . "\"";?>>Skachat fayl <?php echo $imya_fayla;?></A></P>
<B>Prostaya ssylka (dlya soc.setei, messendzherov i t.d):</B><BR>
<TEXTAREA name='' cols=80 rows=2><?php echo "" .$scripturl. "lat/download.php?file=" . $filecrc . "";?></TEXTAREA>
<P><B><A HREF=<?php echo "\"" .$scripturl. "lat/showqr.php?file=" . $filecrc . "\"";?> TARGET="_blank">QR-kod (ssylka otkroetsya v novoj vkladke ili novom okne)</A></B></P>
<B>BB-kod ssylki dlya forumov:</B>
<BR><TEXTAREA name='' cols=80 rows=3>[URL=<?php echo "" .$scripturl. "lat/download.php?file=" . $filecrc . "";?>]Skachat fayl <?php echo $imya_fayla;?>[/URL]</TEXTAREA></TD></TR>