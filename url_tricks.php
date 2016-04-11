<?php
function request_url($lang)
{
  $result = ''; // ���� ��������� ����
  $default_port = 80; // ���� ��-���������
 
  // � �� � ����������-�� �� ����������?
  if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
    // � ����������! ������� ��������...
    $result .= 'https://';
    // ...� ������������ �������� ����� ��-���������
    $default_port = 443;
  } else {
    // ������� ����������, ������� ��������
    $result .= 'http://';
  }
  // ��� �������, ����. site.com ��� www.site.com
  $result .= $_SERVER['SERVER_NAME'] . $lang;
 
  // � ���� � ��� ��-���������?
  if ($_SERVER['SERVER_PORT'] != $default_port) {
    // ���� ���, �� ������� ���� � URL
    $result .= ':'.$_SERVER['SERVER_PORT'];
  }
  // ��������� ����� ������� (���� � GET-���������).
  $result .= $_SERVER['REQUEST_URI'];
  // ���, ����� ����������!
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