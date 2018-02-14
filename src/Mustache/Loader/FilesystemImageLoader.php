<?php


class Mustache_Loader_FilesystemImageLoader extends Mustache_Loader_FilesystemLoader implements Mustache_Loader
{

	var $map = array(
		'png' => 'png',
		'jpg' =>'jpeg',
		'ttf' =>'ttf',
	);


	public function load($name)
	{

		$type = substr($name, (strrpos($name, '-', -4)+1));

		if(!isset($this->map[$type]))
			throw new Mustache_Exception_InvalidArgumentException('Image type '.$type.' does not appear to be valid');

		$bfr = parent::load($name);

		$mime = new finfo(FILEINFO_MIME);

		return 'data:'.$mime->buffer($bfr).';base64,'.base64_encode($bfr);

	}

}
