<?php

namespace App2;

class JsonFileWriter extends FileWriter
{
    public function writeToFile($data): bool
    {
        print PHP_EOL . 'Writing to json file...' . PHP_EOL;

        return true;
    }
}
