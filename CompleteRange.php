<?php 

class CompleteRange
{
	
	private $max_number;
	private $min_number;

	protected function not_positive($value)
	{
		if ($this->min_number < 0) {
			throw new Exception("Use only positive numbers");
		}
	}

	protected function not_number($value)
	{
		if (!is_int($value)) {
		 	throw new Exception("Use only numbers");
		 } 
	}

	public function build($array)
	{
		try {		
			$this->max_number = max($array);
			$this->min_number = min($array);
			$new_array = Array();

			$this->not_positive($this->min_number);

			for ($i=$this->min_number; $i <= $this->max_number; $i++) { 
				$this->not_number($i);
				array_push($new_array, $i);
			}
			echo implode(',', $new_array) . PHP_EOL;
		} catch (Exception $e) {
			echo $e->getMessage() . PHP_EOL;
		}
	}
}


/**
# Execute the script
# php CompleteRange.php
**/

/* Change the value for test */
$range_numbers= [1, 2, 4, 5];
// $range_numbers= [2, 4, 9];
//$range_numbers= [55, 58, 60];

$complete_range = new CompleteRange();
$complete_range->build($range_numbers);

?>