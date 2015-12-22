<?php

namespace Kwiatek5\Graph;

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
