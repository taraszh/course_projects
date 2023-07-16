<?php

namespace App2\AdapterStuff;

class NewCsvFileWriter extends NewFileWriter
{
    public function write($data): void
    {
        print PHP_EOL . 'Writing to csv file...' . PHP_EOL;
    }
}
