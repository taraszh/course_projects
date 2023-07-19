<?php


use App2\AdapterStuff\NewCsvFileWriter;
use App2\AdapterStuff\NewFileWriterAdapter;
use App2\NullObject\NullFileWriter;
use App2\RandomProcessor;

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

/*
 *  Null object is an object with no referenced value or with defined neutral (null) behavior.
 *
 *  Simplified code
 *  Reduce null exception
 *  Fewer condition
 *  Less Testing
 * */

$fileWriter = new NullFileWriter();

$processor = new RandomProcessor($fileWriter);
$processor->process(['a' => 1]);

