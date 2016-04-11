<?php
	function GenerateCAPTCHA($length = 4)
	{
  $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars = strlen($chars);
  $string = '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
        $_SESSION['mycaptcha1_text']=$string;		// записываем в сессию хэш суммы
	}
	
?>