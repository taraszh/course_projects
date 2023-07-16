<?php


use App2\AdapterStuff\NewCsvFileWriter;
use App2\AdapterStuff\NewFileWriterAdapter;
use App2\RandomProcessor;

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

/*
 * Enables classes with incompatible interfaces to work together.
 * */

$newCsvFileWriter = new NewCsvFileWriter();
$fileWriter       = new NewFileWriterAdapter($newCsvFileWriter);

$processor = new RandomProcessor($fileWriter);
$processor->process(['aaa' => 'bbb']);
