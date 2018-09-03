<?php

function encrypt($pure_string, $shared_encryption_key, $private_encryption_key)
{	
    return base64_encode(
		openssl_encrypt
		(
			mcrypt_encrypt
			(
				MCRYPT_BLOWFISH,
				$shared_encryption_key,
				utf8_encode($pure_string),
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
			),
			"AES-128-ECB",
			$private_encryption_key
		)
	);
}

?>