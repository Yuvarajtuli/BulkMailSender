<?php
// encrypt
function encrypt($string)
{
	$ciphering = "AES-128-CTR";
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	$encryption_iv = '1234567891011121';
	$encryption_key = "WorkmanTechnologies";
	$encryption = openssl_encrypt($string, $ciphering,
				$encryption_key, $options, $encryption_iv);
	return $encryption;
}
// decrypt
function decrypt($string)
{
	$options = 0;
	$ciphering = "AES-128-CTR";
	$decryption_iv = '1234567891011121';
	$decryption_key = "WorkmanTechnologies";
	$decryption=openssl_decrypt ($string, $ciphering,
			$decryption_key, $options, $decryption_iv);
	return $decryption;
}
?>
