<?php
require 'wapi/src/events/AllEvents.php';
require 'scripts/script.php';
require 'message.class.php';


class MyEvents extends AllEvents
{
	/**
	* This is a list of all current events. Uncomment the ones you wish to listen to.
	* Every event that is uncommented - should then have a function below.
	* @var array
	*/
	public $activeEvents = array(
		//        'onClose',
		//        'onCodeRegister',
		//        'onCodeRegisterFailed',
		//        'onCodeRequest',
		//        'onCodeRequestFailed',
		//        'onCodeRequestFailedTooRecent',
		'onConnect',
		//        'onConnectError',
		//        'onCredentialsBad',
		//        'onCredentialsGood',
		'onDisconnect',
		//        'onDissectPhone',
		//        'onDissectPhoneFailed',
		//        'onGetAudio',
		//        'onGetBroadcastLists',
		//        'onGetError',
		//        'onGetExtendAccount',
		//        'onGetGroupMessage',
		//        'onGetGroupParticipants',
		//        'onGetGroups',
		//        'onGetGroupsInfo',
		//        'onGetGroupsSubject',
		//        'onGetImage',
		//        'onGetLocation',
		'onGetMessage',
		//        'onGetNormalizedJid',
		//        'onGetPrivacyBlockedList',
		//        'onGetProfilePicture',
		//        'onGetReceipt',
		//        'onGetRequestLastSeen',
		//        'onGetServerProperties',
		//        'onGetServicePricing',
		//        'onGetStatus',
		//        'onGetSyncResult',
		//        'onGetVideo',
		//        'onGetvCard',
		//        'onGroupCreate',
		//        'onGroupisCreated',
		//        'onGroupsChatCreate',
		//        'onGroupsChatEnd',
		//        'onGroupsParticipantsAdd',
		//        'onGroupsParticipantsPromote',
		//        'onGroupsParticipantsRemove',
		//        'onLogin',
		//        'onLoginFailed',
		//        'onAccountExpired',
		//        'onMediaMessageSent',
		//        'onMediaUploadFailed',
		//        'onMessageComposing',
		//        'onMessagePaused',
		//        'onMessageReceivedClient',
		//        'onMessageReceivedServer',
		//        'onPaidAccount',
		//        'onPing',
		//        'onPresenceAvailable',
		//        'onPresenceUnavailable',
		//        'onProfilePictureChanged',
		//        'onProfilePictureDeleted',
		//        'onSendMessage',
		//        'onSendMessageReceived',
		//        'onSendPong',
		//        'onSendPresence',
		//        'onSendStatusUpdate',
		//        'onStreamError',
		//        'onUploadFile',
		//        'onUploadFileFailed',
	);

	public function onConnect($mynumber, $socket)
	{
		echo "Phone number $mynumber connected successfully!\n";
	}

	public function onDisconnect($mynumber, $socket)
	{
		echo "Phone number $mynumber is disconnected!\n";
	}

	public function onGetMessage($mynumber, $from, $id, $type, $time, $name, $body) {
		//Maybe we shouldn't include the main regEx.php here. We should loop through all
		//directories within the scripts/ dir and search for valid regexes there!
		require './config/regEx.php';

		$this->message = new Message($mynumber, $from, $id, $type, $time, $name, $body);

		echo "$name ($from) is writing: \n $body \n";

		$this->whatsProt->sendMessageComposing(split('@', $from)[0]);

		foreach ($regex as $key => $value) {
			if(is_array($value)) {
				foreach ($value as $pattern) {
					if(preg_match($pattern, $body, $matches)) {
						$this->execute($matches, $key);
						break;
					}
				}
			} else {
				if(preg_match($value, $body, $matches)) {
					$this->execute($matches, $key);
					break;
				}
			}
		}

		$this->whatsProt->sendMessagePaused($this->message->number);
	}

	private function execute($matches, $name)
	{
		$script = new Script($this->message, $matches, $this->whatsProt);

		require_once 'scripts/' . $name . '/' . $name . '.php';

		$plugin = new $name ($this->message, $matches, $this->whatsProt);

		$plugin->run();

		$plugin->__destruct();
		$script->__destruct();
	}
}
