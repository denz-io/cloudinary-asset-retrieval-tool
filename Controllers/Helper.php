<?php

require_once  ('Controller.php' );

class Helper extends Controller 
{

    /*
     * Recieves a file directory and returns an array of directory contents 
     * @param String 
     * @return Array 
     */
    public function Scan($path) 
    {
        $contents = scandir($path);
        var_dump($contents);
    }

    /*
     * Set json data into readable array format 
     * @param String 
     * @return Array 
     */
    public function explodeJson($address, $divider)
    {
        return  explode($divider, file_get_contents($address)); 
    }

    public function Logger($text)
    {
        $assetlist_name = getenv('ASSET_LIST_FILE_NAME') ? getenv('ASSET_LIST_FILE_NAME') : 'assetlist.txt';
        $file = fopen($assetlist_name, "a") or die ("Unable to open file!");
        fwrite($file, "\n". $text);
        fclose($file);
    }

    public function dd($data)
    {
        var_dump($data);
        die();
    }
}
