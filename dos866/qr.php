<?php
include("../config.php");
//include("./header.php");
include("../qrcode/qrlib.php");

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];

/* Генерация QR-кода во временный файл */
QRcode::png("".$scripturl. "dos866/download.php?file=" . $filecrc ."", "../qrcode/tmpQRdos866.png", "H", 6, 2);

$im = imagecreatefrompng('../qrcode/tmpQRdos866.png');
$width = imagesx($im);
$height = imagesy($im);

/* Цвет фона в RGB */

//$bg_color = imageColorAllocate($im, 4, 2, 172);
$bg_color = imageColorAllocate($im, 84, 254, 252);
for ($x = 0; $x < $width; $x++) {
	for ($y = 0; $y < $height; $y++) {
		$color = imagecolorat($im, $x, $y);
		if ($color == 0) {
			imageSetPixel($im, $x, $y, $bg_color);
		}
	}
}

//$fg_color = imageColorAllocate($im, 84, 254, 252);
$fg_color = imageColorAllocate($im, 4, 2, 172);
for ($x = 0; $x < $width; $x++) {
	for ($y = 0; $y < $height; $y++) {
		$color = imagecolorat($im, $x, $y);
		if ($color == 1) {
			imageSetPixel($im, $x, $y, $fg_color);
		}
	}
}

/* Вывод в браузер */
//echo "<img src='./qrcode/tmpQR.png'>";
imagepng($im);
header('Content-Type: image/x-png');
} 

else {
	//echo "Неверный QR-код";
    die();
}

?>