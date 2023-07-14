<?php

namespace App2;

abstract class FileWritter
{
    abstract public function writeToFile($data): bool;

}
