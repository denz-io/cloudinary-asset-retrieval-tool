<?php 

require_once  './Controllers/Helper.php';
require_once  './Controllers/CloudinaryUtility.php';

class UploadAssets 
{
    public function __construct()
    {
        echo("Running... \n \n");
        $this->helper = new Helper; 
        $this->cloud = new CloudinaryUtility; 
        $this->getAssetList();
        $this->uploadToCloudinary();
    }

    private function getAssetList()
    {
        echo("Prepping asset list... \n \n");
        $assetlist_name = getenv('ASSET_LIST_FILE_NAME') ? './'.getenv('ASSET_LIST_FILE_NAME') : './assetlist.txt';
        $this->assetlist = array_filter($this->helper->explodeJson($assetlist_name , PHP_EOL), function ($data) { return $data != ""; });
    }

    private function uploadToCloudinary()
    {
        echo("Uplading assets to cloudinary... \n \n");
        forEach ($this->assetlist as $file) {
            if ($file_source = $this->checkIfFileExist($file)) {
                $this->cloud->uploadFile($file_source, $file);
            }
        }
        echo("Done");
    }

    private function checkIfFileExist($file_name)
    {
        $folder_directory = getenv('ASSET_DIRECTORY') ? './'.getenv('ASSET_DIRECTORY') : '../uploads/';
        if (file_exists ($folder_directory . $file_name )) {
            return $folder_directory . $file_name;
        }
    }
}

new UploadAssets;
