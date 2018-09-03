<?php

function password($key, $salt = null, $method = null, $verify_hash = null)
{
	$salt = is_null($salt) ? uniqid() : $salt;
	$method = is_null($method) ? rand(1, 2) : $method;
	if(is_null($verify_hash))
	{
		switch($method)
		{
			case 2 : 
				$string = sha1($key.$salt);
			case 1 : 
			default : 
				$string = md5($key.$salt);
			break;
		}
		$encrypted = password_hash($string, PASSWORD_DEFAULT);
		$result['key'] = $encrypted;
		$result['salt'] = $salt;
		$result['method'] = $method;
	}
	else
	{
		switch($method)
		{
			case 2 : 
				$string = sha1($key.$salt);
			case 1 : 
			default : 
				$string = md5($key.$salt);
			break;
		}
		$verify = password_verify($string, $verify_hash);
		$result['verified'] = $verify;
	}
	return $result;
}

?>