<?php
function request_url($lang)
{
  $result = ''; // Пока результат пуст
  $default_port = 80; // Порт по-умолчанию
 
  // А не в защищенном-ли мы соединении?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // В защищенном! Добавим протокол...
    $result .= 'https://';
    // ...и переназначим значение порта по-умолчанию
    $default_port = 443;
  } else {
    // Обычное соединение, обычный протокол
    $result .= 'http://';
  }
  // Имя сервера, напр. site.com или www.site.com
  $result .= $_SERVER['SERVER_NAME'] . $lang;
 
  // А порт у нас по-умолчанию?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // Если нет, то добавим порт в URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // Последняя часть запроса (путь и GET-параметры).
  $result .= $_SERVER['REQUEST_URI'];
  // Уфф, вроде получилось!
  return $result;
}
$url_dos866 = request_url('/dos866');
$url_lat = request_url('/lat');

$url_no_dos866 = request_url(null);
$url_no_dos866 = str_replace("/dos866", "", $url_no_dos866);
$url_no_lat = request_url(null);
$url_no_lat = str_replace("/lat", "", $url_no_lat);
$url_lat_to_dos866 = request_url(null);
$url_lat_to_dos866 = str_replace("/lat", "/dos866", $url_lat_to_dos866);
$url_dos866_to_lat = request_url(null);
$url_dos866_to_lat = str_replace("/dos866", "/lat", $url_dos866_to_lat);
?>