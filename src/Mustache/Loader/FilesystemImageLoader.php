<?php


class Mustache_Loader_FilesystemImageLoader extends Mustache_Loader_FilesystemLoader implements Mustache_Loader
{
	
	var $map = array(
		'png' => 'png',
		'jpg' =>'jpeg',
	);

	function __construct($baseDir, array $options = array())
	{
		parent::__construct($baseDir, ($options));
	}


	public function load($name)
	{
		$type = substr($name, (strrpos($name, '-', -4)+1));

		if(!isset($this->map[$type]))
			throw new Mustache_Exception_InvalidArgumentException('Image type '.$type.' does not appear to be valid');

		$x = parent::load($name);

		return 'data:image/'.$this->map[$type].';base64,'.base64_encode($x);
	}

}
