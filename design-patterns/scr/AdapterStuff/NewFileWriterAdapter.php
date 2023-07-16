<?php

namespace App2\AdapterStuff;

use App2\FileWriter;

class NewFileWriterAdapter extends FileWriter
{

    public function __construct(protected NewFileWriter $fileWriter)
    {
    }

    public function writeToFile($data): bool
    {
        $this->fileWriter->write($data);

        return true;
    }
}
