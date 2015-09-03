<?php
class Script
{
	protected $helpMessage = "No description provided\n";
	protected $description = "No help-message provided :(";
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

	public function usage()
	{
		$message = $this->description . "\n";
		$message .= "---\n";
		$message .= $this->helpMessage;

		return $message;
	}

	public function run()
	{

	}

	public function send($content, $type = 'text', $toNumber = '')
	{
		if(empty($toNumber)) {
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
