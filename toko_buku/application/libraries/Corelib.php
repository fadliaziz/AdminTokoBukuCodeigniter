<?php defined("BASEPATH") or exit(); 

class Corelib {
	private $c = null;

	public function __construct() {
		$this->c =& get_instance();
	}

	public function escape($string = []) {
		$string = $this->c->security->xss_clean($string);
		foreach($string as $key => $val) {
			if(is_array($string[$key])) {
				foreach($string[$key] as $key2 => $val) {
					$string[$key][$key2] = htmlentities($val);
					$string[$key][$key2] = strip_tags($val);
					$string[$key][$key2] = trim($val);
				}
			}
			else {
				$string[$key] = htmlentities($val);
				$string[$key] = strip_tags($val);
				$string[$key] = trim($val);
			}
		}

		return $string;
	}

	public static function rand_text_generator() {
		$string = 'A1B2C3D4E5F6';
		$output = '';

		for ($i=0; $i < strlen($string) - 2; $i++) { 
			$output .= $string[rand(0, $i)];
		}

		return $output;
	}
}

?>