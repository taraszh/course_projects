<?php

namespace App2;

abstract class FileWriter
{
    abstract public function writeToFile(array $data): bool;

}
