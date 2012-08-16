<?php

class UAS {

	static function slugify($text)
	{		
		if(empty($text)) return 'n-a';
		$text = preg_replace('/\W+/', '-', $text);
		$text = trim($text, '-');
		$text = strtolower($text);

		return $text;
	}
}
