<?php

require_once  ('Controller.php' );

class CloudinaryUtility extends Controller 
{
    public function __construct() 
    {
        parent::__construct();
    }

    /*
     * Recieves a cloudinary public_id and checks if resource is valid based on response. 
     * @param String 
     * @return Boolean 
     */
    public function validateCloudFile($public_id) 
    {
        $url = "https://res.cloudinary.com/" . getenv('CLOUDINARY_CLOUD_NAME') . "/" . $public_id;
        return  parent::http_response($url,'200');
    }

    /*
     * Recieves a file path and uploads path. 
     * You can also pass a base64 version of the file. 
     * @param String
     * @return Boolean 
     */
    public function uploadFile($file, $file_name = null)
    {
        $cloudinaryRes = \Cloudinary\Uploader::upload($file, [
            "public_id" => $file_name
        ]);
        return $cloudinaryRes;
    }
}
