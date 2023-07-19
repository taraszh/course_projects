<?php

namespace App2\NullObject;

use App2\FileWriter;

class NullFileWriter extends FileWriter
{

    public function writeToFile(array $data): bool
    {
        print PHP_EOL . 'null file writer not writing to file' . PHP_EOL;

        return true;
    }
}
