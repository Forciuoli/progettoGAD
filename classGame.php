<?php

class Game {

	// variabili
	public $name;
	public $link;
	public $vote_multiplayer = array("all"=>"0","PlayStation 4"=>"0", "Xbox One"=>"0", "Xbox 360"=>"0","PC Windows"=>"0","PlayStation 3"=>"0");
	public $vote_everyeye = array("all"=>"0");
	public $genre = array();
	public $platform = array();
	public $data;
	public $multiplayer;
	public $cooperative;
	public $minimum_requirements;
	public $hw_suggested;
	public $publisher;
	public $img_link;
	public $review_everyeye;
	public $review_multiplayer;
	public $price_amazon;
	public $price_ebay;
	public $link_amazon;
	public $link_ebay;
	
	// costruttore
	public function __construct($name, $link, $publisher, $img_link) {
		$this->name = $name;
		$this->link = $link;
		$this->publisher = $publisher; 
		$this->img_link = $img_link;
	}
	
	 
	

} 