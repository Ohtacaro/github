<?php

function decrypt($encrypted_string, $shared_encryption_key, $private_encryption_key)
{	
	include 'mysqli.php';
    $decrypted_string = mcrypt_decrypt
	(
		MCRYPT_BLOWFISH,
		$shared_encryption_key,
		openssl_decrypt
		(
			base64_decode
			(
				$encrypted_string
			),
			"AES-128-ECB",
			$private_encryption_key
		),
		MCRYPT_MODE_ECB,
		mcrypt_create_iv
		(
			mcrypt_get_iv_size
			(
				MCRYPT_BLOWFISH,
				MCRYPT_MODE_ECB
			),
			MCRYPT_RAND
		)
	);
	
	// To remove occasional mysterious trailing character from string, this solution should be considered to be temporary
	return stripslashes(str_replace('\0', '', mysqli_real_escape_string($mysqli['connect'],$decrypted_string)));
}

?>