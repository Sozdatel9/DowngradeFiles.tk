   <TR> <TD COLSPAN=14 BGCOLOR="#04AAAC"> <CENTER> 
   <FONT COLOR="#FFFFFF" SIZE="+1"> <B>������ ᠩ�</B> </FONT> </CENTER> </TD> </TR>
<?php 
//������砥� �㭪�� ��� �뢮�� ������

function declension($number, array $data)
{
$rest = array($number % 10, $number % 100);
 
if($rest[1] > 10 && $rest[1] < 20) {
return $data[2];
} elseif ($rest[0] > 1 && $rest[0] < 5) {
return $data[1];
} else if ($rest[0] == 1) {
return $data[0];
}
 
return $data[2];
}
//echo $number, ' ', declension($number, array('���', '����', '���'));
  
$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/year.dat", 'r') or die("�� 㤠���� ������ 䠩�");
$newYearDate;
$anniversaryDate;
$i = 0;
while(!feof($fd) && ($i < 2))
{
    $str = htmlentities(fgets($fd));
	if ($i == 0) {$newYearDate = $str;}
	if ($i == 1) {$anniversaryDate = $str;}
	$i++;
}
fclose($fd);
unset($str);
//�஢��塞, �㦭� �� ��⠢��� ᮮ�饭�� � ����ࠢ������ � ���� �����

// ���塞 �ᮢ�� ���� �� Europe/Moscow
date_default_timezone_set('Europe/Moscow');
$currentDate = date('m/d/Y');


//�᫨ ��� 1 ﭢ���, � ������塞 ����ࠢ����� � ���� �����
if (strtotime($currentDate)==(strtotime($newYearDate))) { 
	$a1=$_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm";
	$a2=fopen($a1,"r"); // ���뢠�� ��� �⥭��
	$text=fread($a2,filesize($a1)); //�⠥�
	fclose($a2);	 
	$currYear = date("Y");
	$f=fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm","w"); // ���뢠�� ��� �����
	// ��襬 ���� ��ப� � � ��� ������塞 ࠭��� ᮤ�ন��� 䠩��
	$what1="<TR>"."\n"; // ��ப�
	$what2="<TD VALIGN=TOP COLSPAN=2><FONT COLOR=#FCFE54>01.01.".$currYear." </FONT></TD>"."\n"; // ��ப�
	$what3="<TD VALIGN=TOP COLSPAN=12>- ����������� 䠩����������� DowngradeFiles ����ࠢ��� "."\n"; // ��ப�
	$what4="��� ����⥫�� ᠩ� � ���� ".$currYear. " ����� !<BR>"."\n"; // ��ப�
	$what5="����� � �⮬ ���� ������ �� ��� ����� � ������� ! �ᯥ客 � ����� � 㤠� �� "."\n"; // ��ப�
	$what6="��� ��稭����� !<BR></TD>"."\n"; // ��ப�
	$what7="</TR>"."\n"; // ��ப�
	fwrite($f,$what1.$what2.$what3.$what4.$what5.$what6.$what7.$text);
	fclose($f);	
	unset($what1);
    unset($what2);
    unset($what3);
    unset($what4);
    unset($what5);
    unset($what6);
    unset($what7);
	$currYear++;
	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/year.dat", 'w') or die("�� 㤠���� ᮧ���� 䠩�");
	$str = date('01/01/'.$currYear);
	fwrite($fd, $str."\n");
	$str = $anniversaryDate;
	fwrite($fd, $str);
	fclose($fd);
	$currYear=0;
}

//�᫨ ��� 20 ﭢ���, � ������塞 ����ࠢ����� � �����騭��
else if (strtotime($currentDate)==(strtotime($anniversaryDate))) { 
	$a1=$_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm";
	$a2=fopen($a1,"r"); // ���뢠�� ��� �⥭��
	$text=fread($a2,filesize($a1)); //�⠥�
	fclose($a2);	   
	$currYear = date("Y");    
	$annvYear = $currYear - 2014;
	$annvYearStr = declension($annvYear, array('���', '����', '���'));
	$f=fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm","w"); // ���뢠�� ��� �����
	// ��襬 ���� ��ப� � � ��� ������塞 ࠭��� ᮤ�ন��� 䠩��
	$what1="<TR>"."\n"; // ��ப�
	$what2="<TD VALIGN=TOP COLSPAN=2><FONT COLOR=#FCFE54>20.01.".$currYear." </FONT></TD>"."\n"; // ��ப�
	$what3="<TD VALIGN=TOP COLSPAN=12>- �������������� DowngradeFiles �ᯮ������� ஢�� ".$annvYear. " ".$annvYearStr." </TD>"."\n"; // ��ப�
	$what4="</TR>"."\n"; // ��ப�
	fwrite($f,$what1.$what2.$what3.$what4.$text);
	fclose($f);
    unset($what1);
    unset($what2);
    unset($what3);
    unset($what4);	    
	$currYear++;
	$fd = fopen($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/year.dat", 'w') or die("�� 㤠���� ᮧ���� 䠩�");
	$str = $newYearDate;
	fwrite($fd, $str);
	$str = date('01/20/'.$currYear);
	fwrite($fd, $str);
	fclose($fd);
	$currYear=0;
}




include ($_SERVER["DOCUMENT_ROOT"]."/dos866/pages/news.htm"); 

?>