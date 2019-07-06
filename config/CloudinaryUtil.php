<?php

require_once  ('Controller.php' );

class CloudinaryUtil extends Controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    public function validateCloudFile($public_id) 
    {
        $url = "https://res.cloudinary.com/" . getenv('CLOUDINARY_CLOUD_NAME') . "/" . $public_id;
        return  parent::http_response($url,'200');
    }

    public function uploadFile($file)
    {
        $fileBase64 = "data:image/". $file->getClientOriginalExtension() . ";base64," . base64_encode(file_get_contents($file));
        $cloudinaryRes = \Cloudinary\Uploader::upload($fileBase64, [ 'public_id' =>  $file_name ]);
        return $cloudinaryRes;
    }
}
