<?php 

class ChangeString
{
	private $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

	public function build($value)
	{
		$len = strlen($value);
		for ($i=0; $i < $len; $i++) {
			$alphabet_value = $this->is_alphabet_value($value[$i]);
			if ($alphabet_value) {
				echo $alphabet_value;
			} else {
				echo $value[$i];
			}
		}
	}
	
	protected function is_alphabet_value($value)
	{
		$is_upper = ctype_upper($value);
		
		if ($is_upper) {
			$value = strtolower($value);
		}

		$index = array_search($value, $this->alphabet);
		if (!is_bool($index)) {
			$response = $this->alphabet[$index + 1];
			if ($is_upper) {
				$response = strtoupper($this->alphabet[$index + 1]);
			}
			return $response;
		} else {
			return false;
		}
	}
}

$changeString = new ChangeString();
$changeString->build($argv[1]);
?>