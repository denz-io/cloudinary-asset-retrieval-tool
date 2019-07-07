<?php 

require_once  './Controllers/Helper.php';
require_once  './Controllers/CloudinaryUtility.php';

class CreateAssetList
{
    public function __construct () 
    {
        echo("Running \n");
        $this->helper = new Helper; 
        $this->cloud = new CloudinaryUtility; 
        $this->datapacket = $this->helper->explodeJson('./datapacket.json',PHP_EOL);
        $this->createList();
    }

    private function createList()
    {
        echo("Creating asset list. This may take a while... \n");
        foreach ($this->datapacket as $user) {
            $decoded_data = json_decode($user, true);
            $this->handleProfile($decoded_data['photo']);
            $this->handleArtwork($decoded_data);
        }
        echo("Done \n");
    }

    private function handleProfile($profile)
    {
        if ($profile) {
            $this->handleValidation($profile);
        }
    }

    private function handleArtwork(Array $user)
    {
        $art_counter = 0;
        forEach($user as $res) {
            if (isset($user['artwork_' . $art_counter])) {
                $artwork = $user['artwork_' . $art_counter];
                if ($artwork) {
                    $this->handleValidation($artwork);
                }
            }
            $art_counter++;   
        }

    }

    private function handleValidation($asset)
    {
        if (!$this->cloud->validateCloudFile($asset)) {
            $this->helper->Logger($asset);
        }
    }
}

new CreateAssetList;
