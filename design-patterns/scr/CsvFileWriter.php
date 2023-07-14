<?php

namespace App2;

class CsvFileWriter extends FileWritter
{
    public function writeToFile($data): bool
    {
        print PHP_EOL . 'Writing to csv file...' . PHP_EOL;

        return true;
    }
}
