<?php 

class Config {

	private $config = array();

	private $config_dir = __DIR__ . '/config';
	private $env;
    
	public function __construct ($options=array()) {
		$this->config_dir = $options['config_dir'] ?: $this->config_dir;
		$this->env = $options['environment'] ?: getenv('PHP_ENV');
		$this->parseConfigs();
	}

	private function parseConfigs () {
		$usable_files_order = array("default.ini");
		if ($this->env) {
			$usable_files_order[] = $this->env . ".ini";
		}
		$usable_files = array();
		$merged_config = array();
		$dir = new DirectoryIterator($this->config_dir);
		foreach ($dir as $fileInfo) {
			if (!$fileInfo->isDot() && in_array($fileInfo->getFilename(), $usable_files_order)) {
				$usable_files[$fileInfo->getFilename()] = parse_ini_file($this->config_dir . '/' . $fileInfo->getFilename());
			}
		}
		foreach ($usable_files_order as $fileName) {
			if (array_key_exists($fileName, $usable_files)) {
				$merged_config = array_merge($merged_config, $usable_files[$fileName]);
			}
		}

		$this->config = $merged_config;
	}

	public function getConfig() {
		return $this->config;
	}
    
}
