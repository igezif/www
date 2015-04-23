<?php

class ValidateDate extends Validator {
	
	protected function validate() {
		$data = $this->data;
		if (!is_null($data) && strtotime($data) === false) $this->setError(self::CODE_UNKNOWN);
	}
	
}

?>