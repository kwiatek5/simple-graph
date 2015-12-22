<?php

namespace Kwiatek5\Graph;

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
