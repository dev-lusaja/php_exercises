<?php 
require 'models/employee.php';

class Employee
{
	private $employees_json;
	function __construct()
	{
		$this->employees_json = file_get_contents("db/employees.json");
	}

	public function getAll()
	{
		$result = json_decode($this->employees_json, true);
		$result_len = count($result);
		$new_result = Array();
		for ($i=0; $i < $result_len; $i++) {
			$object_len = count($result[$i]);
			$object = new EmployeeModel();
			$object = $object->getPreview($result[$i]);
			array_push($new_result, $object);
		}
		return $new_result;
	}

	public function getById($id)
	{
		$result = json_decode($this->employees_json, true);
		$index = array_search($id, array_column($result, 'id'));
	    if (is_bool($index)) {
    		return null;
    	} else {
			$object = new EmployeeModel();
			$object = $object->getDetail($result[$index]);
			return $object;
    	}
	}

	public function getByEmail($email)
	{
		$result = json_decode($this->employees_json, true);
		$index = array_search($email, array_column($result, 'email'));
	    if (is_bool($index)) {
    		return null;
    	} else {
			$object = new EmployeeModel();
			$object = $object->getPreview($result[$index]);
			return $object;
    	}
	}
}
?>