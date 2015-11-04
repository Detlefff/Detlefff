#!/usr/bin/php
<?php
//This will be the main-file, wich redirects the commands to the sub-system
require_once 'vendor/whatsapp/chat-api/src/whatsprot.class.php';
require_once 'config/config.php';
require_once 'classes/events.class.php';
require 'classes/matcher.class.php';

$w = new WhatsProt($username, $nickname, $debug);
$events = new MyEvents($w, new Matcher());

$events->setEventsToListenFor($events->activeEvents);

$w->connect(); // Connects to WhatsApp

$w->loginWithPassword($password); // Login
//First, we need to know, if this is our first login

//Endlessly poll the messages from WhatsApp
while(true) {
	$w->pollMessage();
}
?>
