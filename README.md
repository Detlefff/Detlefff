## Detlefff

Detlefff is a simple Chatbot for WhatsApp.

---

I appreciate any help coming from the community here.
Feel free, to correct my bad english, my code or any bugs you'll find.

If you are plannig to develop a plugin, make sure to head over to [Detlefff-Organisation](https://github.com/Detlefff/Organisation). Open an issue there, describing, what you wanna do. Eventually, someone else is already developing what you want?

---
## Usage

To make Detlefff work, you need to register a mobile-number to the WhatsApp-Network.
(You can find a CLI-registertool inside the `example`-Directory of WhatsAPI)

Fill in you credentials in `config/config.php`.

After the registration, you need to download WhatsAPI:
```
git submodule init
```

Start the script:
```
./index.php

## With PHP
php index.php

## Or with HHVM
hhvm index.php
```
## Install plugins

If you want to install a plugin manually, you have to place the plugin-folder inside the `scripts`-directory.

Otherwise, you can clone the plugin-repository to have the script automatically in the right folder:
```sh
#Change to the scripts directory
cd scripts/

#And clone the repository
git clone REPO_URL REPONAME
```

## Developing Plugins

Plugins must have the follwing structure:
```
pluginname
├╴pluginname.php
└╴regex
```

### regex
The file holds all the regexes, that are representing the messages, which trigger the plugin.

Every regex should be noted in plaintext (Without braces or something), line for line.

### pluginname.php
The file holds the main plugin class. It HAS to be named after the plugin (by the way: the plugin-foler, the file and the class have to be named equaly).

A plugin class should inherit the `Script`-class.

You have access to the following variables:
* $helpMessage -> Description of the usage of the plugin
* $description -> Description of the plugin
* $matches -> An array containing the matches from the plugin-regex
* $message -> The message-Object (e.g. from, original message etc.)
* $waConnection -> The WhatsApp-connection

You have access to the following functions:
* usage()
	* Returns the usage of the plugin. This is the concatenation of `$description` & `$helpMessage`
* run()
	* Executes the plugin. This function is called from the core. You need to implement `run()` in your plugin.
* send($content, $type = 'text', $toNumber = '')
	* Method to send a message back into the WhatsApp-Network.
	* Parameters:
		* $content -> Content of your message (Or if you are sending media, the URL of it)
		* $type -> The type of the message, this can be:
			* text -> Default
			* image
			* audio
			* video
			* location
		* $toNumber -> Defaults to the number of the sender

The plugins needs to reimplement the `run()` function, to hold the main logic of the plugin (basically you can have other functions, but `run()` is called from the Detlefff-Core)

### LICENSE

This project is licensed under the MIT-License.
