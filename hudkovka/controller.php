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
	$from = $data["email"];
	$to = "hudkovka54@yandex.ru";
	$phone = $data["phone"];
	$text = $data["message"];
	$message = "Сообщение от ".$name.",<br /><br />Текст сообщения: ".$text."<br /><br />Телефон:".$phone;
	$subject = "=?utf-8?B?subject?=";
	$headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8\r\n";
	mail($to, $subject, $message, $headers);
	echo "Cообщение успешно отправлено";