<?php 

require_once  './Controllers/Helper.php';
require_once  './Controllers/CloudinaryUtility.php';

class CreateAssetList extends Controller
{
    public function __construct () 
    {
        echo("Running... \n \n");
        $this->helper = new Helper; 
        $this->cloud = new CloudinaryUtility; 
        $this->setUpDataPacket();
        $this->createList();
    }

    private function setUpDataPacket()
    {
        echo("Prepping data packet... \n \n");
        $datapacket = getenv('DATA_PACKET_NAME') ? './'.getenv('DATA_PACKET_NAME') : './datapacket.json';
        $this->datapacket = $this->helper->explodeJson($datapacket , PHP_EOL);
    }

    private function createList()
    {
        echo("Creating asset list. This may take a while... \n \n");
        foreach ($this->datapacket as $user) {
            $decoded_data = json_decode($user, true);
            $this->handleProfile($decoded_data);
            $this->handleArtwork($decoded_data);
        }
        echo("Done.");
    }

    private function handleProfile($user)
    {
        if (isset($user['photo'])) {
            $this->handleValidation($user['photo']);
        }
    }

    private function handleArtwork($user)
    {
        if ($user) {
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
    }

    private function handleValidation($asset)
    {
        if (!$this->cloud->validateCloudFile($asset)) {
            $this->helper->Logger($asset);
        }
    }
}

new CreateAssetList;
