<?php
/**
 *
 */
class Script
{
	private $helpMessage = '';
	private $matches;
	private $message;
	private $waConnection;

	function __construct($message, $matches, $waConnection)
	{
		$this->matches = $matches;
		$this->message = $message;
		$this->waConnection = $waConnection;
	}

	public function help()
	{
		return $helpMessage;
	}

	public function run()
	{

	}

	public function send($from, $content, $type)
	{
		if(!defined($type)) {
			return $this->waConnection->sendMessage($from, $content);
		}
		switch ($type) {
			case 'text':
				return $this->waConnection->sendMessage($from, $content);
				break;
			case 'image':
				return $this->waConnection->sendMessageImage($from, $content);
				break;
			case 'audio':
				return $this->waConnection->sendMessageAudio($from, $content);
				break;
			case 'video':
				return $this->waConnection->sendMessageVideo($from, $content);
				break;
			case 'location':
				return $this->waConnection->sendMessageLocation($from, $content);
				break;
		}
	}

}

 ?>
