<?php
class Position
{

	public $p; //int //page, 1-based
	public $x; //double
	public $y; //double
	public $w; //double
	public $h; //double
	
	//Constructor
	function __construct($data) {
		$this->p = $data['p'];
		$this->x = $data['x'];
		$this->y = $data['y'];
		$this->w = $data['w'];
		$this->h = $data['h'];
	}
}