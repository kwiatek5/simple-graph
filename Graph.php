<?php


// http://guid.us/GUID/PHP
function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12)
            .chr(125);// "}"
        return $uuid;
    }
}

class Vertex {
	private $name;
	
	public function __construct($name) {
		$this->setName($name);
	}

	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
		return $this;
	}

}

class Edge {
	private $startVertex;
	private $endVertex;
	private $weight;

	public function __construct(Vertex $startVertex, Vertex $endVertex, $weight = 1) {
		if ($startVertex === $endVertex) {
			throw new Exception('Graph can not have loops!');
		}

		$this->startVertex = $startVertex;
		$this->endVertex = $endVertex;
		$this->weight = $weight;
	}

	public function getStartVertex() {
		return $this->startVertex;
	}

	public function getEndVertex() {
		return $this->endVertex;
	}

	public function getWeight() {
		return $this->weight;
	}

	public function setStartVertex(Vertex $startVertex) {
		$this->startVertex = $startVertex;
		return $this;
	}

	public function setEndVertex(Vertex $endVertex) {
		$this->endVertex = $endVertex;
		return $this;
	}

	public function setWeight($weight) {
		$this->weight = $weight;
		return $this;
	}
}

class Graph {
	private $edgeCollection = array();

	public function addEdge(Edge $edge) {
		$v1 = $edge->getStartVertex();
		$v2 = $edge->getEndVertex();
		foreach ($this->edgeCollection as $e) {
			if ($v1 === $e->getStartVertex() && $v2 === $e->getEndVertex() || $v2 === $e->getStartVertex() && $v1 === $e->getEndVertex()) {
				throw new Exception('Graph can not have multiple edges!');
			}
		}

		do {
			$id = getGUID();

		} while (isset($this->edgeCollection[$id]));

		$this->edgeCollection[$id] = $edge;

		return $id;
	}

	public function getEdgeById($id) {
		return ($this->edgeCollection[$id]) ? $this->edgeCollection[$id] : null;
	}

	public function deleteEdgeById($id) {
		unset($this->edgeCollection[$id]);

		return $this;
	}

	public function getGraph() {
		$graph = array();
		foreach ($this->edgeCollection as $id => $e) {
			$graph[$id] = array(
				'v1' => $e->getStartVertex()->getName(),
				'v2' => $e->getEndVertex()->getName(),
				'weight' => $e->getWeight(),
			);
		}

		return $graph;
	}

}

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