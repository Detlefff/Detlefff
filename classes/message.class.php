<?php
/**
 * This is our message-class
 */
class Message
{
	public $body;
	public $from;
	public $groupId;
	public $id;
	public $mynumber;
	public $name;
	public $number;
	public $time;
	public $type;

	function __construct($mynumber, $groupId, $from, $id, $type, $time, $name, $body)
	{
		$this->body 	= $body;
		$this->from 	= $from;
		$this->id 		= $id;
		$this->mynumber = $mynumber;
		$this->name 	= $name;
		$this->time 	= $time;
		$this->type 	= $type;

		if(isset($groupId)) {
			$this->number = explode('@', $groupId)[0];
		} else {
			$this->number = explode('@', $from)[0];
		}
	}
}

 ?>
