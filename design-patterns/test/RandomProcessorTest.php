<?php

namespace App2\Test;

use App2\JsonFileWriter;
use App2\RandomProcessor;
use PHPUnit\Framework\TestCase;

class RandomProcessorTest extends TestCase
{
    public function testProcessSuccess()
    {
        $fileWriter = new JsonFileWriter();

        $processor = new RandomProcessor($fileWriter);
        $result = $processor->process(['a' => 'b']);

        self::assertTrue($result);
    }


}
