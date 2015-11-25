<?php

class Game {

	// variabili
	public $name;
	public $link;
	public $vote_multiplayer = array("all"=>"","ps4"=>"", "xboxone"=>"", "xbox360"=>"","pc"=>"","ps3"=>"");
	public $vote_everyeye = array("all"=>"");
	public $genre = array();
	public $platform = array();
	public $data = array("ps4"=>"", "xboxone"=>"", "xbox360"=>"","pc"=>"","ps3"=>"");
	public $multiplayer;
	public $cooperative;
	public $minum_requirements;
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