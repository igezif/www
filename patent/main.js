function Myform(){
	
	var self = this;

	this.getXmlHttp = function(){
		var xmlhttp;
		try {
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				xmlhttp = false;
			}
		}
		if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
			xmlhttp = new XMLHttpRequest();
		}
		return xmlhttp;
	}

	this.ajax = function(method, url, data){
		return new Promise(function(succeed, fail) {
			var req = self.getXmlHttp();
			req.open(method, url, true);
			req.addEventListener("load", function() {
				if (req.status < 400){
					succeed(req.responseText);
				}else fail(new Error("Request failed: " + req.statusText));
			});
			req.addEventListener("error", function() {
				fail(new Error("Network error"));
			});
			req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			req.send(data);
		});
	}
	
	this.send = function(){
		var error = false;
		var form = document.forms[0];
		var name = form.name.value;
		
		var phone = form.phone.value;
		
		/*
		form.phone.onfocus	= function(){
			form.phone.style.backgroundColor = "#ffffff";
		}
		//form.message.onfocus	= function(){
		//	form.message.style.backgroundColor = "#ffffff";
		//}
		
		if(!email || !/.+@.+\..+/i.test(email)){
			form.email.style.backgroundColor = "#ff8c69";
			error = true;
		}
		if(!message || !/.+/i.test(message)){
			form.message.style.backgroundColor = "#ff8c69";
			error = true;
		}
		*/
		if(error)return;
		var data = "name=" + name + "&phone=" + phone;
		self.ajax("POST", "/controller.php", data).then(function(m){
			alert(m);
		}, function(error) {
			alert("Произошла ошибка: " + error);
		});
	}
}

var myform = new Myform();