<?php

class Helper 
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
        $file = fopen("assetlist.txt", "a") or die ("Unable to open file!");
        $this->writeToFile($file, $text);
    }
    
}
