<?php 

class ChangeString
{
	private $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
	private $is_upper;
	private $is_final;

	public function build($value)
	{
		$len = strlen($value);
		for ($i=0; $i < $len; $i++) {
			$alphabet_value = $this->is_alphabet_value($value[$i]);
			if ($alphabet_value) {
				$response = $alphabet_value;
			} else {
				$response = $value[$i];
			}
			echo $response;
		}
		echo PHP_EOL;
	}
	
	protected function is_upper($value)
	{
		$this->is_upper = ctype_upper($value);
		
		if ($this->is_upper) {
			$value = strtolower($value);
		}
		return $value;
	}

	protected function set_upper($value)
	{
		if ($this->is_upper) {
			$value = strtoupper($value);
		}
		return $value;
	}

	protected function is_final($value)
	{
		$this->is_final = false;

		if ($value == end($this->alphabet)) {
			$this->is_final = true;
			$value = $this->alphabet[0];
		}
		return $value;
	}

	protected function set_final($index)
	{
		$value = $this->alphabet[$index];
		if ($this->is_final) {
			$value = $this->alphabet[$index];
		} else {
			$value = $this->alphabet[$index + 1];
		}
		return $value;
	}

	protected function is_alphabet_value($value)
	{
		$value = $this->is_upper($value);
		$value = $this->is_final($value);

		$index = array_search($value, $this->alphabet);

		if (!is_bool($index)) {
			$value = $this->set_final($index);
			$response = $this->set_upper($value);
			return $response;
		} else {
			return false;
		}
	}
}

/**
# execute the example with: php ChangeString.php "string"
**/

$changeString = new ChangeString();
$changeString->build($argv[1]);
?>