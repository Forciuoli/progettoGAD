<?php

class Game {

	// variabili
	public $name;
	public $link;
	public $vote_multiplayer = array("all"=>"","PlayStation 4"=>"", "Xbox One"=>"", "Xbox 360"=>"","PC Windows"=>"","PlayStation 3"=>"");
	public $vote_everyeye = array("all"=>"");
	public $genre = array();
	public $platform = array();
	public $data = array("Ps3"=>"", "Xbox One"=>"", "Xbox 360"=>"","Pc"=>"","PS4"=>"");
	public $multiplayer;
	public $cooperative;
	public $minimum_requirements;
	public $hw_suggested;
	public $publisher;
	public $img_link;
	
	// costruttore
	public function __construct($name, $link, $publisher, $img_link) {
		$this->name = $name;
		$this->link = $link;
		$this->publisher = $publisher; 
		$this->img_link = $img_link;
	}
	
	 
	

} 