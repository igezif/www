<?php

class ValidateBoolean extends Validator {

	protected function validate() {
		$data = $this->data;
		if (($data != 0) && ($data != 1)) $this->setError(self::CODE_UNKNOWN);
	}

}

?>