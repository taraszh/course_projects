<?php


use App2\CsvFileWriter;
use App2\JsonFileWriter;
use App2\RandomProcessor;

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';


$fileWriter = new CsvFileWriter();
$fileWriter = new JsonFileWriter();

$processor = new RandomProcessor($fileWriter);
$processor->process(['aaa' => 'bbb']);
