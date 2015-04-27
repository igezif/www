<?php
	function xss($data) {
		if (is_array($data)) {
			$escaped = array();
			foreach ($data as $key => $value) {
				$escaped[$key] = xss($value);
			}
			return $escaped;
		}
		return htmlspecialchars($data);
	}
	$data = xss($_REQUEST);
	$name = $data["name"];
	$from = "patent-nsk";
	$to = "patent-ufms@yandex.ru";
	$phone = $data["phone"];
	$message = "Сообщение от ".$name.",\n\nТелефон:".$phone;
	$subject = "=?utf-8?B?subject?=";
	$headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8\r\n";
	mail($to, $subject, $message, $headers);
	echo "Cообщение успешно отправлено";