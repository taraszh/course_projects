<?php


use App2\AdapterStuff\NewCsvFileWriter;
use App2\AdapterStuff\NewFileWriterAdapter;
use App2\FactoryMethod\Plans\PlanFactory;
use App2\NullObject\NullFileWriter;
use App2\RandomProcessor;

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

/*
 *  Factory method pattern is a creational pattern that uses factory methods to deal with the problem of creating objects
 *  without having to specify the exact class of the object that will be created.
 *
 *  Enables dynamic class creation
 *
 *  Promotes loose coupling
 *
 * */

$planFactory = new PlanFactory();

$planFactory->createPlan('pro');

