<?php

class ValidateIDs extends Validator {
	
	protected function validate() {
		$data = $this->data;
		if (is_null($data)) return;
		if (!preg_match("/^\d+(,\d+)*\d?$/", $data)) $this->setError(self::CODE_UNKNOWN);
	}
	
}

?>