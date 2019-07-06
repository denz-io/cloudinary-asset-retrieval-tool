<?php

require_once  ( dirname(__DIR__) . '/vendor/autoload.php' );

class Controller
{
    public function __construct() 
    {
        $this->env = Dotenv\Dotenv::create(dirname(__DIR__));
        $this->env->load();
        $this->initializeCloudinary();
    }

    public function initializeCloudinary() 
    {
        \Cloudinary::config([
            "cloud_name" => getenv('CLOUDINARY_CLOUD_NAME'),
            "api_key"    => getenv('CLOUDINARY_API_KEY'),
            "api_secret" => getenv('CLOUDINARY_API_SECRET')
        ]);
    }
		

    public function http_response($url, $status = null, $wait = 3)
    {
	$time = microtime(true);
	$expire = $time + $wait;

	$pid = pcntl_fork();
	if ($pid == -1) {
	    die('could not fork');
	} else if ($pid) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, TRUE);
	    curl_setopt($ch, CURLOPT_NOBODY, TRUE);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    $head = curl_exec($ch);
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    curl_close($ch);
	   
	    if(!$head)
	    {
		return FALSE;
	    }
	   
	    if($status === null)
	    {
		if($httpCode < 400)
		{
		    return TRUE;
		}
		else
		{
		    return FALSE;
		}
	    } elseif($status == $httpCode) {
		return TRUE;
	    }
	    return FALSE;
	    pcntl_wait($status);
	} else {
	    while(microtime(true) < $expire) {
		sleep(0.5);
	    }
	    return FALSE;
	}
    }
}
