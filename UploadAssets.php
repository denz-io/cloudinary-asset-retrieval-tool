<?php 

require_once  './Controllers/Helper.php';
require_once  './Controllers/CloudinaryUtility.php';

class UploadAssets 
{
    public function __construct()
    {
        echo("Running Program... \n \n");
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
        $counter = 0;
        $progress = 1;
        echo("Uplading assets to cloudinary: \n \n");
        echo("Going through " . count($this->assetlist) . " items. \n \n");
        forEach ($this->assetlist as $file ) {
            if ($file_source = $this->checkIfFileExist($file)) {
                $this->cloud->uploadFile($file_source, substr($file, 0, strpos($file, ".")));
		$counter++;
            }
	    $this->helper->progressBar( $progress++ , count($this->assetlist));
        }
        echo("\n \n Done. Uploaded " . $counter . " files to cloudinary");
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
