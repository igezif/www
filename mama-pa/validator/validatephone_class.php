<?php

class ValidatePhone extends Validator {
	
	const MAX_LEN = 20;
	const CODE_EMPTY = "ERROR_PRICE_EMPTY";
	const CODE_INVALID = "ERROR_PRICE_INVALID";
	
	protected function validate() {
		$data = $this->data;
		if (mb_strlen($data) > self::MAX_LEN) $this->setError(self::CODE_UNKNOWN);
		else {
			$pattern = "/^[0-9]*$/";
			if (!preg_match($pattern, $data)) $this->setError(self::CODE_INVALID);
		}
	}
	
}

?>