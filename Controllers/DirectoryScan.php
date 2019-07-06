<?php

class DirectoryScan 
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
}
