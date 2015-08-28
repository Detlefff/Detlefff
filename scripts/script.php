<?php
/**
 *
 */
class Scripts
{
	private $waConnection;
	private $matches;
	private $helpMessage = '';

	function __construct($from, $matches, $waConnection)
	{
		$this->matches = $matches;
		$this->waConnection = $waConnection;
	}

	public function help()
	{
		return $helpMessage;
	}

	public function run()
	{

	}

	public function send($type, $from, $content)
	{
		switch ($type) {
			case 'text':
				return $this->waConnection->sendMessage($from, $content);
				break;
			case 'image';
				return $this->waConnection->sendImage($from, $content);
				break;
		}
	}

}

 ?>
