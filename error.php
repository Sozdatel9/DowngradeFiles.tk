<?php 
if(isset($_GET['ID']))  $e = $_GET['ID']; else  $e = "404"; switch($e) {
case "500": $err_title_rus = "Ошибка 500 - Ошибка в работе сервера";
			$err_title_eng = "500 Error - Internal Server Error"; 
			$err_source_rus = "<P>Просим извинения за возникшие технические неполадки.<BR> Пожалуйста, зайдите на сайт позже.</P>";
			$err_source_eng = "<P>We apologize for the occured technical issues.<BR>Please try to visit this site later.</P>";break;
case "401": $err_title_rus = "Ошибка 401 - Требуется авторизация";
			$err_title_eng = "401 Error - Unauthorized - Authorization Required"; 
			$err_source_rus = "<P>Для доступа к запрашиваемому материалу требуется авторизация пользователя.<BR>Советуем Вам перейти на <A HREF='..'>главную страницу</A> и поискать то, что Вам нужно.</P>";
			$err_source_eng = "<P>For the access to requested content authorization is required.<BR>We advise you to go to the <A HREF='..'>home page</a> and find what you need.</P>";break;
case "403": $err_title_rus = "Ошибка 403 - Доступ запрещён";
			$err_title_eng = "403 Error - Access Forbidden"; 
			$err_source_rus = "<P>Доступ к запрашиваемому вами материалу запрещен.<BR>Советуем Вам перейти на <A HREF='..'>главную страницу</A> и поискать то, что Вам нужно.</P>";
			$err_source_eng = "<P>Access to the requested content is forbidden.<BR>We advise you to go to the <A HREF='..'>home page</a> and find what you need.</P>";break;
default: $err_title_rus = "Ошибка 404";
			$err_title_eng = "404 Error"; 
			$err_source_rus = "<P>Запрашиваемая Вами страница не найдена. Возможно, Вы перешли по неверной или старой ссылке.<BR>Советуем Вам перейти на <A HREF='..'>главную страницу</A> и поискать то, что Вам нужно.</P>";
			$err_source_eng = "<P>The page you had requested was not found. Perhaps, you have visited wrong or outdated link.<BR>We advise you to go to the <A HREF='..'>home page</a> and find what you need.</P>";}?><HTML><HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=windows-1251">
<META NAME="description" CONTENT="DowngradeFiles - бесплатный файлообменник, предназначенный для старых компьютеров и старых версий браузеров">
<META NAME="viewport" CONTENT="width=device-width, initial-scale=1, maximum-scale=9" /><LINK REL="shortcut icon" HREF="/pages/icon.ico" TYPE="image/x-icon">
<TITLE><?php echo $err_title_rus;?> :: <?php echo $err_title_eng;?></TITLE>
<STYLE TYPE="text/css">body{font-family: "MS Sans Serif", Geneva, sans-serif; max-width:1280px; margin: 0 auto;} textarea{font-family: "MS Sans Serif", Geneva, sans-serif;} input{font-family: "MS Sans Serif", Geneva, sans-serif;} form{font-family: "MS Sans Serif", Geneva, sans-serif} a{text-decoration: none;}table {table-layout: fixed;width:100%;}td {word-wrap:break-word;}select{font-family: "MS Sans Serif", Geneva, sans-serif;} input{max-width:100%;}</STYLE></HEAD>
<BODY TOPMARGIN="0" LEFTMARGIN="0" RIGHTMARGIN="0" TEXT="#54FEFC" BGCOLOR=#0402AC LINK="#FCFE54" VLINK="#FFFFFF" ALINK="#FF9900"><CENTER>
<TABLE WIDTH=100% BORDER=1 BGCOLOR=#0402AC BORDERCOLOR=#54FEFC><TR><TD COLSPAN=14><CENTER>
<A HREF="index.php" ALT="Главная страница DowngradeFiles" TITLE="Главная страница DowngradeFiles"><FONT COLOR=#FCFE54 SIZE="+2"><B>DowngradeFiles</B></FONT></A>
</CENTER><CENTER><FONT SIZE="-2"><B>easy file sharing service </B></FONT></CENTER></TD></TR><TR><TD COLSPAN=14><BR>
		<FONT COLOR=#FCFE54 SIZE="+2"><B><CENTER><?php echo $err_title_rus;?></CENTER>
		</B></FONT><?php echo $err_source_rus;?> <BR>
		<FONT COLOR=#FCFE54 SIZE="+2"><B><CENTER><?php echo $err_title_eng;?></CENTER>
		</B></FONT><?php echo $err_source_eng;?> <BR></TD></TR><TR><TD COLSPAN=14>
<TABLE WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="0" BGCOLOR=#0402AC BORDERCOLOR=#54FEFC>  <TR VALIGN="bottom">
  <!--Меню выбора кодировки-->
	<TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>1</B> </FONT> </TD>
    <TD WIDTH="6%" BGCOLOR="#04AAAC"> <A HREF="/index.php"><FONT COLOR=BLACK SIZE="-1"><B>WIN-1251</B> </FONT> </A> </TD>
	<TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>2</B> </FONT> </TD>
    <TD WIDTH="6%" BGCOLOR="#04AAAC"> <A HREF="/dos866/index.php"><FONT COLOR=BLACK SIZE="-1"><B>DOS-866</B> </FONT> </A> </TD>
	<TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>3</B> </FONT> </TD>   
    <TD WIDTH="6%" BGCOLOR="#04AAAC"> <A HREF="/lat/index.php"><FONT COLOR=BLACK SIZE="-1"><B>LAT</B> </FONT> </A> </TD>
  <!--/Меню выбора кодировки-->	
  <!--Меню сайта-->
	<TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>4</B> </FONT> </TD>
    <TD WIDTH="6%" BGCOLOR="#04AAAC"><A HREF="/index.php"><FONT COLOR=BLACK SIZE="-1"><B>Главная</B></FONT> </A></TD>
    <TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>5</B> </FONT> </TD>
	<TD WIDTH="6%" BGCOLOR="#04AAAC"><A HREF="/index.php?page=faq"><FONT COLOR=BLACK SIZE="-1"><B>FAQ</B></FONT>  </A> </TD>
    <TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>6</B> </FONT> </TD>
	<TD WIDTH="6%" BGCOLOR="#04AAAC"><A HREF="/index.php?page=news"><FONT COLOR=BLACK SIZE="-1"><B>Новости</B></FONT></A> </TD>
    <TD WIDTH="1%" BGCOLOR=BLACK> <FONT SIZE="-1" COLOR="#C0C0C0"><B>7</B> </FONT> </TD>
	<TD WIDTH="6%" BGCOLOR="#04AAAC"><A HREF="/files.php"><FONT COLOR=BLACK SIZE="-1"><B>Файлы</B></FONT> </A> </TD>	
  <!--/Меню сайта-->
  </TR><TR><TD><BR></TD></TR><TR><TD COLSPAN=7 ALIGN=CENTER>&copy; 2014 - <?php echo date("Y"); ?> DowngradeFiles.TK</TD>
<TD COLSPAN=7 ALIGN=CENTER>При поддержке сайта <A HREF="http://phantom.sannata.ru/">Железные призраки прошлого</A></TD></TR></TABLE></TD></TR></TABLE></CENTER></BODY></HTML>