

function getMessageRes (data, d) {
	if (data == "success_reservation") {
		$('form[name=reservation_form]').hide();
		$("<h3>Путёвка успешно забронирована!</h3><span class='center'>На Ваш e-mail отправлено письмо с уникальным номером.</span>").insertAfter("h2");
	}
	else if (data == "error_reservation") {
		$('form[name=reservation_form]').hide();
		$("<h3>Ошибка!</h3><span class='center'>Пользователь с таким e-mail уже забронировал путёвку.</span>").insertAfter("h2");
	}
}

function getMessageSend (data, d) {
	if (data == "success_send") {
		$('form[name=send_form]').hide();
		$("<h3>Сообщение отправлено!</h3><span class='center'>Мы обязательно его рассмотрим и пришлём Вам ответ.</span>").insertAfter("h2");
	}
}

$(document).ready(function() {
	$("#back-top").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	$("input[name=send]").bind("click", function() {
		var error_form = false;
		if (!/^[а-яА-ЯёЁa-zA-Z0-9][а-яА-ЯёЁa-zA-Z0-9_\s]{1,50}[а-яА-ЯёЁa-zA-Z0-9]$/i.test($("input[name=name_1]").val())) {
			$("#message_name_1").text("некорректное имя!");
			$("input[name=name_1]").css("background-color", "#ff8c69");
			error_form = true;
		}
		else {
			$("#message_name_1").text("");
			$("input[name=name_1]").css("background-color", "#ffffff");	
		}
		if (!/.+@.+\..+/i.test($("input[name=email_1]").val())) {
			$("#message_email_1").text("некорректный email!");
			$("input[name=email_1]").css("background-color", "#ff8c69");
			error_form = true;	
		}
		else {
			$("#message_email_1").text("");
			$("input[name=email_1]").css("background-color", "#ffffff");	
		}
		if (!/^[а-яА-ЯёЁa-zA-Z0-9\s]{1,200}$/i.test($("input[name=subject]").val())) {
			$("#message_subject").text("некорректная тема!");
			$("input[name=subject]").css("background-color", "#ff8c69");
			error_form = true;
		}
		else {
			$("#message_subject").text("");
			$("input[name=subject]").css("background-color", "#ffffff");	
		}
		if (!/.+/i.test($("textarea[name=text]").val())) {
			$("#message_text").text("введите сообщение!");
			$("textarea[name=text]").css("background-color", "#ff8c69");
			error_form = true;
		}
		else {
			$("#message_text").text("");
			$("textarea[name=text]").css("background-color", "#ffffff");	
		}
		$.post("../functions.php", {captcha: $("input[name=captcha]").val()}, function (data) {
			if (data == "error_captcha" || $("input[name=captcha]").val() == "") {
				$("#message_captcha").text("неверный текст с картинки!");
				$("input[name=captcha]").css("background-color", "#ff8c69");
			}
			else if (data == "success_captcha" && error_form) {
				$("#message_captcha").text("");
				$("input[name=captcha]").css("background-color", "#ffffff");
			}
			else if (data == "success_captcha" && !error_form) {
				$.ajax({
					url: "../functions.php",
					type: "POST",
					data: ({data_type: "send", name: $("input[name=name_1]").val(), email: $("input[name=email_1]").val(), subject: $("input[name=subject]").val(), text: $("textarea[name=text]").val()}),
					dataType: "html",
					success: getMessageSend
				});
			}
		});
	});
	
	$("#update").click(function () {
		$("#captcha").attr("src", "captcha.php?" + Math.random());
	});
	
	var surname = false;
	var name = false;
	var patronymic = false;
	var email = false;
	var phone = false;
	$("input[name=surname]").bind("blur", function() {
		if (!/^[а-яА-ЯёЁ]{1,50}$/i.test($("input[name=surname]").val())) {
			$("input[name=surname]").css("background-color", "#ff8c69");
			$("#message_surname").fadeIn(1000);
			surname = false;
		}
		else {
			$("input[name=surname]").css("background-color", "#ffffff");
			$("#message_surname").hide();
			surname = $("input[name=surname]").val();	
		}
	});
	
	$("input[name=name]").bind("blur", function() {
		if (!/^[а-яА-ЯёЁ]{1,50}$/i.test($("input[name=name]").val())) {
			$("input[name=name]").css("background-color", "#ff8c69");
			$("#message_name").fadeIn(1000);
			name = false;
		}
		else {
			$("input[name=name]").css("background-color", "#ffffff");
			$("#message_name").hide();
			name = $("input[name=name]").val();
		}
	});
			
	$("input[name=patronymic]").bind("blur", function() {
		if (!/^[а-яА-ЯёЁ]{1,50}$/i.test($("input[name=patronymic]").val())) {
			$("input[name=patronymic]").css("background-color", "#ff8c69");
			$("#message_patronymic").fadeIn(1000);
			patronymic = false;
		}
		else {
			$("input[name=patronymic]").css("background-color", "#ffffff");
			$("#message_patronymic").hide();
			patronymic = $("input[name=patronymic]").val();
		}
	});
	
	$("input[name=email]").bind("blur", function() {
		if (!/.+@.+\..+/i.test($("input[name=email]").val())) {
			$("input[name=email]").css("background-color", "#ff8c69");
			$("#message_email").fadeIn(1000);
			email = false;
		}
		else {
			$("input[name=email]").css("background-color", "#ffffff");
			$("#message_email").hide();
			email = $("input[name=email]").val();
		}
	});
	
	$("input[name=phone]").bind("blur", function() {
		if (!/^8[0-9]{10}$/.test($("input[name=phone]").val())) {
			$("input[name=phone]").css("background-color", "#ff8c69");
			$("#message_phone").fadeIn(1000);
			phone = false;
		}
		else {
			$("input[name=phone]").css("background-color", "#ffffff");
			$("#message_phone").hide();
			phone = $("input[name=phone]").val();
		}
	});
		
	$("input[name=reserv]").bind("click", function() {
		if (surname && name && patronymic && email && phone) {	
			var year_born = $("select[name='year_born']").val();
			var sezon = $("select[name='sezon']").val();
			$.ajax({
				url: "../functions.php",
				type: "POST",
				data: ({data_type: "reserv", surname: surname, name: name, patronymic: patronymic, email: email, phone: phone, year_born: year_born, sezon: sezon}),
				dataType: "html",
				success: getMessageRes
			});
		}
		else alert("Сначала заполните как следует все поля, а потом бронируйте путёвку!");
	});

	$("form[name=vote_form]").submit(function () {
		if ($("input[name=vote_item]:checked").length == 0) {
			alert("Вы не выбрали вариант! Cначала выберите вариант, а потом голосуйте.");
			return false;	
		}
		else return true;
	});

});