<?php 

require_once  './Controllers/Helper.php';
require_once  './Controllers/CloudinaryUtility.php';

class CreateAssetList
{
    public function __construct () 
    {
        $this->helper = new Helper; 
        $this->cloud = new CloudinaryUtility; 
        $this->datapacket = $this->helper->explodeJson('./datapacket.json',PHP_EOL);
        $this->createList();
    }

    private function createList()
    {
        foreach ($this->datapacket as $user) {
            $decoded_data = json_decode($user, true);
            $this->handleProfile($decoded_data['photo']);
        }
    }

    private function handleProfile($profile)
    {
        if ($this->cloud->validateCloudFile($profile)) {
            echo('found' . $profile . "\n");
        } else {
            echo('not found' . $profile . "\n");
        }
    }

    private function handleArtwork()
    {

    }
}

new CreateAssetList;
