<?php
/**
 * This is our message-class
 */
class Message
{
	public $body;
	public $from;
	public $id;
	public $mynumber;
	public $name;
	public $number;
	public $time;
	public $type;

	function __construct($mynumber, $from, $id, $type, $time, $name, $body)
	{
		$this->body 	= $body;
		$this->from 	= $from;
		$this->id 		= $id;
		$this->mynumber = $mynumber;
		$this->name 	= $name;
		$this->number 	= explode('@', $from)[0];
		$this->time 	= $time;
		$this->type 	= $type;
	}
}

 ?>
