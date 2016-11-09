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
    return \MyIlluminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'orld!');
});
$benchmark->add('MyStr::startsWith_3', function () {
    return \MyIlluminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});

$benchmark->add('Str::startsWith_1', function () {
    return \Illuminate\Support\Str::startsWith('Hello world!', 'Hello');
});
$benchmark->add('Str::startsWith_2', function () {
    return \Illuminate\Support\Str::startsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'orld!');
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
    return \MyIlluminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'orld!');
});
$benchmark->add('MyStr::endsWith_3', function () {
    return \MyIlluminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});

$benchmark->add('Str::endsWith_1', function () {
    return \Illuminate\Support\Str::endsWith('Hello world!', 'Hello');
});
$benchmark->add('Str::endsWith_2', function () {
    return \Illuminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'orld!');
});
$benchmark->add('Str::endsWith_3', function () {
    return \Illuminate\Support\Str::endsWith('Hello woooooooooooooooooooooooooooooooooooooo world!', 'asdfe');
});
$benchmark->run();


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$benchmark = new Benchmark;
$data = array_combine(range(1, 10000), array_fill(1, 10000, 'aaaa'));

$benchmark->add('noop', function () use ($data) {
});

$data = array_combine(range(1, 100000), array_fill(1, 100000, 'aaaa'));
$benchmark->add('unset100000', function () use ($data) {
    unset($data[9]);
    unset($data[99]);
    unset($data[999]);
});

$data = array_combine(range(1, 50000), array_fill(1, 50000, 'aaaa'));
$benchmark->add('unset50000', function () use ($data) {
    unset($data[9]);
    unset($data[99]);
    unset($data[999]);
});

$data = array_combine(range(1, 10000), array_fill(1, 10000, 'aaaa'));
$benchmark->add('unset10000', function () use ($data) {
    unset($data[9]);
    unset($data[99]);
    unset($data[999]);
});

$data = array_combine(range(1, 1000), array_fill(1, 1000, 'aaaa'));
$benchmark->add('unset1000', function () use ($data) {
    unset($data[9]);
    unset($data[99]);
    unset($data[999]);
});

$data = array_combine(range(1, 100), array_fill(1, 100, 'aaaa'));
$benchmark->add('unset100', function () use ($data) {
    unset($data[9]);
});

$data = array_combine(range(1, 10), array_fill(1, 10, 'aaaa'));
$benchmark->add('unset100', function () use ($data) {
    unset($data[9]);
});
$benchmark->run();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$benchmark = new Benchmark;
$data = array_combine(range(1, 10000), array_fill(1, 10000, 'aaaa'));

$benchmark->add('count', function () use ($data) {
});

$benchmark->add('unset_count', function () use ($data) {
    $x = 0;
    unset($data[999]);
    $x += count($data);
    return $x;
});

$benchmark->add('unset2_count', function () use ($data) {
    $x = 0;
    unset($data[1999]);
    $x += count($data);
    unset($data[2999]);
    $x += count($data);
    return $x;
});

$benchmark->add('unset100_count', function () use ($data) {
    $x = 0;
    for ($i = 99; $i < 199; $i++){
        unset($data[$i]);
        $x += count($data);
    }
    return $x;
});

$benchmark->add('unset100_x10_count', function () use ($data) {
    $x = 0;
    for ($i = 99; $i < 199; $i++){
        unset($data[$i * 10]);
        $x += count($data);
    }
    return $x;
});

$rand = array_combine(range(99, 199), array_map(function(){ return rand(0, 1000); }, range(99, 199)));
$benchmark->add('unset100_rand_count', function () use ($data,$rand) {
    $x = 0;
    for ($i = 99; $i < 199; $i++){
        unset($data[$rand[$i]]);
        $x += count($data);
    }
    return $x;
});
$benchmark->add('unset1000_count', function () use ($data) {
    $x = 0;
    for ($i = 999; $i < 1999; $i++){
        unset($data[$i]);
        $x += count($data);
    }
    return $x;
});

$benchmark->run();

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$benchmark = new Benchmark;
$data = array_combine(range(1, 10000), array_fill(1, 10000, 'aaaa'));

$benchmark->add('count', function () use ($data) {
    return count($data);
});

unset($data[999]);
$benchmark->add('unset_count', function () use ($data) {
    return count($data);
});

unset($data[1999]);
unset($data[2999]);
$benchmark->add('unset2_count', function () use ($data) {
    return count($data);
});

for ($i = 99; $i < 199; $i++){
    unset($data[$i]);
}
$benchmark->add('unset100_count', function () use ($data) {
    return count($data);
});

$benchmark->run();


