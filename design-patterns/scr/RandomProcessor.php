<?php

namespace App2;

class RandomProcessor
{

    public function __construct(protected FileWriter $fileWritter)
    {
    }

    public function process(array $data): bool
    {
        // try to write a file

        $result = $this->fileWritter ->writeToFile($data);

        if (!$result) {
            throw new \Exception('Error writing to file.');
        }

        return true;
    }

}
