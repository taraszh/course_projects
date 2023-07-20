<?php


use App2\AdapterStuff\NewCsvFileWriter;
use App2\AdapterStuff\NewFileWriterAdapter;
use App2\FactoryMethod\Plans\PlanFactory;
use App2\NullObject\NullFileWriter;
use App2\RandomProcessor;

require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

/*
 *  Factory Method is a creational design pattern that provides an interface for creating objects
 *  in a superclass, but allows subclasses to alter the type of objects that will be created.
 *
 *  Enables dynamic class creation
 *
 *  Promotes loose coupling
 *
 * */

$planFactory = new PlanFactory();

$planFactory->createPlan('pro');

