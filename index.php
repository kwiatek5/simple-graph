<?php

require __DIR__ . '/vendor/autoload.php';

use Kwiatek5\Graph\Vertex;
use Kwiatek5\Graph\Edge;
use Kwiatek5\Graph\Graph;

// Example

$v1 = new Vertex('v1');
$v2 = new Vertex('v2');
$v3 = new Vertex('v3');
$v4 = new Vertex('v4');
$v5 = new Vertex('v5');

$e12 = new Edge($v1, $v2);
$e13 = new Edge($v1, $v3);
$e14 = new Edge($v1, $v4);
$e15 = new Edge($v1, $v5);

$e23 = new Edge($v2, $v3);
$e24 = new Edge($v2, $v4);
$e25 = new Edge($v2, $v5);

$e34 = new Edge($v3, $v4);
$e35 = new Edge($v3, $v5);

$e45 = new Edge($v4, $v5);

unset($v1);
unset($v2);
unset($v3);
unset($v4);
unset($v5);

$g = new Graph();

echo $g->addEdge($e12) . "\n";
echo $g->addEdge($e13) . "\n";
echo $g->addEdge($e14) . "\n";
echo $g->addEdge($e15) . "\n";
echo $g->addEdge($e23) . "\n";
echo $g->addEdge($e24) . "\n";
echo $g->addEdge($e25) . "\n";
echo $g->addEdge($e34) . "\n";
echo $g->addEdge($e35) . "\n";
echo $g->addEdge($e45) . "\n";

unset($e12);
unset($e13);
unset($e14);
unset($e15);
unset($e23);
unset($e24);
unset($e25);
unset($e34);
unset($e35);
unset($e45);

var_dump($g->getGraph());
