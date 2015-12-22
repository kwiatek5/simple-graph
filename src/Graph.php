<?php

namespace Kwiatek5\Graph;

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
			$id = Utils::getGUID();

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
