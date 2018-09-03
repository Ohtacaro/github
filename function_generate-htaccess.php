<?php

function generate_htaccess()
{
	include 'mysqli.php';
	
	define('EOL', "\r\n", true);
	
	$time = explode(' ', microtime());
	define('SYSTEM_TIME', $time[1].explode('.',$time[0])[1], true);
	
	$data .= 'Options +FollowSymLinks' . EOL;
	$data .= 'RewriteEngine on' . EOL;
	$data .= 'CheckSpelling on' . EOL;
	
	$result['social'] = mysqli_query($mysqli['connect'], 
		"
			SELECT * FROM `social`
		"
	);
	while($row['social'] = mysqli_fetch_array($result['social']))
	{
		$data .= "RewriteRule ^{$row['social']['htaccess_url']}$ index.php?site_social={$row['social']['social_id']} [L,QSA]" . EOL;
		$data .= "RewriteRule ^{$row['social']['htaccess_url']}/$ index.php?site_social={$row['social']['social_id']} [L,QSA]" . EOL;
	}
	
	$result['language'] = mysqli_query($mysqli['connect'], 
		"
			SELECT * FROM `translation_language`
		"
	);
	while($row['language'] = mysqli_fetch_array($result['language']))
	{
		$data .= "RewriteRule ^{$row['language']['htaccess_url']}$ index.php?site_language={$row['language']['translation_language_id']} [L,QSA]" . EOL;
		$data .= "RewriteRule ^{$row['language']['htaccess_url']}/$ index.php?site_language={$row['language']['translation_language_id']} [L,QSA]" . EOL;
		$result['navigation'] = mysqli_query($mysqli['connect'], 
			"
				SELECT * FROM `navigation`
			"
		);
		while($row['navigation'] = mysqli_fetch_array($result['navigation']))
		{
			$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']} [L,QSA]" . EOL;
			$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']} [L,QSA]" . EOL;				
			switch($row['navigation']['htaccess_url'])
			{
				case 'merchandise' :
					// Category
					$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/category$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=category [L,QSA]" . EOL;
					$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/category/$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=category [L,QSA]" . EOL;				
					$result['category'] = mysqli_query($mysqli['connect'], 
						"
							SELECT * FROM `webshop_category`
						"
					);
					while($row['category'] = mysqli_fetch_array($result['category']))
					{
						$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/category/{$row['category']['htaccess_url']}$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=category&id={$row['category']['webshop_category_id']} [L,QSA]" . EOL;
						$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/category/{$row['category']['htaccess_url']}/$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=category&id={$row['category']['webshop_category_id']} [L,QSA]" . EOL;				
					}
					//Product
					$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/category$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=category [L,QSA]" . EOL;
					$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/category/$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=category [L,QSA]" . EOL;				
					$result['product_group'] = mysqli_query($mysqli['connect'], 
						"
							SELECT * FROM `webshop_group` WHERE `status` != '0'
						"
					);
					while($row['product_group'] = mysqli_fetch_array($result['product_group']))
					{
						$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/product/{$row['product_group']['htaccess_url']}$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=product_group&gid={$row['product_group']['webshop_group_id']} [L,QSA]" . EOL;
						$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/product/{$row['product_group']['htaccess_url']}/$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=product_group&gid={$row['product_group']['webshop_group_id']} [L,QSA]" . EOL;				
						$result['product_variant'] = mysqli_query($mysqli['connect'], 
						"
							SELECT * FROM `webshop_product`
						"
						);
						while($row['product_variant'] = mysqli_fetch_array($result['product_variant']))
						{
							$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/product/{$row['product_group']['htaccess_url']}/{$row['product_variant']['htaccess_url']}$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=product_variant&gid={$row['product_group']['webshop_group_id']}&pid={$row['product_variant']['webshop_product_id']} [L,QSA]" . EOL;
							$data .= "RewriteRule ^{$row['language']['htaccess_url']}/{$row['navigation']['htaccess_url']}/product/{$row['product_group']['htaccess_url']}/{$row['product_variant']['htaccess_url']}/$ index.php?site_language={$row['language']['translation_language_id']}&navigation={$row['navigation']['navigation_id']}&view=product_variant&gid={$row['product_group']['webshop_group_id']}&pid={$row['product_variant']['webshop_product_id']} [L,QSA]" . EOL;				
						}
					}
				break;
			}
		}
	}

	$backup_htaccess = file_get_contents('.htaccess');

	if($backup_htaccess !== $data)
	{
		// echo 'Backup in progress!' . EOL;
		if(file_put_contents('backup/' . SYSTEM_TIME . '.htaccess_backup', $backup_htaccess))
		{
			// echo 'Backup successful! Generating new .htaccess file!' . EOL;
			if(file_put_contents('.htaccess', $data))
			{
				// echo 'Successfully generated .htaccess file!' . EOL;
			}
			else
			{
				// echo 'Failed to generate .htaccess' . EOL;
			}
		}
	}
	else
	{
		// echo 'Backup not needed!' . EOL;
	}
}

?>