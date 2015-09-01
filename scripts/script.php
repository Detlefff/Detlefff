<?php
/**
 *
 */
class Script
{
	protected $helpMessage = '';
	protected $matches;
	protected $message;
	protected $waConnection;

	function __construct($message, $matches, $waConnection)
	{
		$this->matches = $matches;
		$this->message = $message;
		$this->waConnection = $waConnection;
	}

	function __destruct()
	{
	}

	public function help()
	{
		return $helpMessage;
	}

	public function run()
	{

	}

	public function send($content, $type = 'text', $toNumber)
	{
		if(!isset($toNumber)) {
			$toNumber = $this->message->number;
		}

		switch ($type) {
			case 'text':
				return $this->waConnection->sendMessage($toNumber, $content);
				break;
			case 'image':
				return $this->waConnection->sendMessageImage($toNumber, $content);
				break;
			case 'audio':
				return $this->waConnection->sendMessageAudio($toNumber, $content);
				break;
			case 'video':
				return $this->waConnection->sendMessageVideo($toNumber, $content);
				break;
			case 'location':
				return $this->waConnection->sendMessageLocation($toNumber, $content);
				break;
		}
	}

}

 ?>
