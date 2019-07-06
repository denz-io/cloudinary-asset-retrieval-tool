 <?php

class Logger 
{
    public function SetToList($text)
    {
        $file = fopen("assetlist.txt", "a") or die ("Unable to open file!");
        $this->writeToFile($file, $text);
    }
}
