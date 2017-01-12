<?php 

class ClearPar
{
	private $firstChar = '(';
	private $partner = ')';
	private $result;

	protected function is_firtsChart($value)
	{
		if ($value === $this->firstChar) {
			return true;
		} else {
			return false;
		}
	}

	protected function clean_no_fristChart($is_firtsChart, $value)
	{
		if ($is_firtsChart) {
			return $value;
		} else {
			return null;
		}
	}

	protected function has_partner($value, $next_value)
	{
		$is_firtsChart = $this->is_firtsChart($value);
		if ($is_firtsChart) {
			if ($next_value === $this->partner) {
				return $value . $next_value;
			} else {
				return null;
			}
		} else {
			return $this->clean_no_fristChart($is_firtsChart, $value);
		}
	}

	public function build($value)
	{
		$len = strlen($value);
		for ($i=0; $i <= $len; $i++) {
			$this->result .= $this->has_partner($value[$i], $value[$i + 1]);
		}
		echo $this->result . PHP_EOL;
	}
}

/**
# Execute test: php ClearPar.php "(()()()()(()))))())((())"
**/

$cleanPar = new ClearPar();
$cleanPar->build($argv[1]);
?>
