#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Lavoiesl\PhpBenchmark\Benchmark;

// warm up...
\Illuminate\Support\Str::startsWith('Hello world!', 'Hello');
\MyIlluminate\Support\Str::startsWith('Hello world!', 'Hello');
\Illuminate\Support\Str::endsWith('Hello world!', 'Hello');
\MyIlluminate\Support\Str::endsWith('Hello world!', 'Hello');

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$benchmark = new Benchmark;

$benchmark->add('MyStr::startsWith_1', function () {
    return \MyIlluminate\Support\Str::startsWith('Hello world!', 'Hello');
});
$benchmark->add('MyStr::startsWith_2', function () {
    return \MyIlluminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'world!');
});
$benchmark->add('MyStr::startsWith_3', function () {
    return \MyIlluminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});

$benchmark->add('Str::startsWith_1', function () {
    return \Illuminate\Support\Str::startsWith('Hello world!', 'Hello');
});
$benchmark->add('Str::startsWith_2', function () {
    return \Illuminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'world!');
});
$benchmark->add('Str::startsWith_3', function () {
    return \Illuminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});
$benchmark->run();


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$benchmark = new Benchmark;
$benchmark->add('MyStr::endsWith_1', function () {
    return \MyIlluminate\Support\Str::endsWith('Hello world!', 'Hello');
});
$benchmark->add('MyStr::endsWith_2', function () {
    return \MyIlluminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'world!');
});
$benchmark->add('MyStr::endsWith_3', function () {
    return \MyIlluminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});

$benchmark->add('Str::endsWith_1', function () {
    return \Illuminate\Support\Str::endsWith('Hello world!', 'Hello');
});
$benchmark->add('Str::endsWith_2', function () {
    return \Illuminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'world!');
});
$benchmark->add('Str::endsWith_3', function () {
    return \Illuminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});
$benchmark->run();

