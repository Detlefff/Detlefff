<?php
class Matcher
{
	private $regExes = array();
	public $matches;
	public $pluginName;

	function __construct()
	{
		$plugins = glob(getcwd() . '/scripts/*' , GLOB_ONLYDIR);

		foreach ($plugins as $plugin) {
			$regEx = file($plugin . '/regex', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

			$name = array_pop(explode('/', $plugin));

			if(!empty($regEx)) {
				if(count($regEx) > 1) {
					$this->regExes[$name] = array();

					foreach ($regEx as $value) {
						array_push($this->regExes[$name], $value);
					}
				} else {
					$this->regExes[$name] = $regEx[0];
				}
			}
		}
	}

	public function match($messageBody)
	{
		$broken = false;

		foreach ($this->regExes as $key => $value) {
			if(is_array($value)) {
				foreach ($value as $pattern) {
					if($this->test($pattern, $messageBody)) {
						$this->pluginName = $key;
						$broken = true;
						break;
					}
				}
				if($broken) {
					break;
				}
			} else {
				if($this->test($value, $messageBody)) {
					$this->pluginName = $key;
					break;
				}
			}
		}
		unset($broken);

		if(!empty($this->pluginName) && !empty($this->matches)) {
			return true;
		} else {
			return false;
		}
	}

	private function test($pattern, $messageBody)
	{
		if(preg_match($pattern, $messageBody, $this->matches)) {
			return true;
		}
		return false;
	}
}
