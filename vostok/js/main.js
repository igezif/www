function ModalForm(){

	var self = this;

	var black;

	var form, top_start;

	this.show = function(){
		self.showBackground();
		form.style.display = "block";
		top_start = self.getTopStart();
		var top_finish = self.getTopFinish();
		var left = self.getLeft();
		form.style.top = top_start + "px";
		form.style.left = left + "px";
		self.move(top_finish);
	}

	this.move = function(top_finish){
		var top = top_start;
		var timer = setInterval(function() {
		  	top += 50;
		  	form.style.top = top + "px";
			if (form.style.top.slice(0, -2) >= top_finish) {
				form.style.top = top_finish + "px";
				clearInterval(timer);
				return;
			}
		}, 40);
	}

	this.showBackground = function(){
		var height = document.body.scrollHeight;
		var width = document.body.scrollWidth;
		document.getElementById("container").insertAdjacentHTML("afterEnd", "<div id = 'black'></div>");
		black = document.getElementById("black");
		black.style.height = height + "px";
		black.style.width = width + "px";
		black.addEventListener("click", self.hide);
	}

	this.hideBackground = function(){
		black.removeEventListener("click", self.hide);
		black.remove();
	}

	this.getLeft = function(){
		var width = document.body.offsetWidth;
		var left = width/2 - form.offsetWidth/2;
		return left;
	}

	this.getTopStart = function(){
		var top = 0 - form.offsetHeight;
		return top;
	}

	this.getTopFinish = function(){
		var height = document.body.offsetHeight;
		var top = height/2 - form.offsetHeight/2;
		return top;
	}

	this.init = function(){
		form = document.getElementById("modal_form");
		document.getElementById("consultation").addEventListener("click", self.show);
		document.getElementById("close_modal_form").addEventListener("click", self.hide);
	}

	this.hide = function(){
		self.hideBackground();
		form.style.top = top_start + "px";
	}
}

function BlackBackground(){
	
}


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

		//console.log(f);
		/*
		var error = false;
		var form = document.forms[0];
		var name = form.name.value;
		var email = form.email.value;
		var phone = form.phone.value;
		var message = form.message.value;
		form.email.onfocus	= function(){
			form.email.style.backgroundColor = "#ffffff";
		}
		form.message.onfocus	= function(){
			form.message.style.backgroundColor = "#ffffff";
		}
		if(!email || !/.+@.+\..+/i.test(email)){
			form.email.style.backgroundColor = "#ff8c69";
			error = true;
		}
		if(!message || !/.+/i.test(message)){
			form.message.style.backgroundColor = "#ff8c69";
			error = true;
		}
		if(error)return;
		var data = "name=" + name + "&email=" + email + "&phone=" + phone + "&message=" + message;
		self.ajax("POST", "/controller.php", data).then(function(m){
			document.getElementById("result").innerHTML = m;
			form.name.value = "";
			form.email.value = "";
			form.phone.value = "";
			form.message.value = "";
		}, function(error) {
			alert("Произошла ошибка: " + error);
		});
		*/
	}
}

function Validator(){
	
	var self = this;

	var types = {
		advisable: {
			regular: /.+/i,
			message_error: "",
			message_empty: ""
		},

		email: {
			regular: /.+@.+\..+/i,
			message_error: "",
			message_empty: ""
		},
		text: {
			regular: /.+/i,
			message_error: "",
			message_empty: ""
		},
		integer: {
			regular: /\d/i,
			message_error: "",
			message_empty: ""
		},
		phone: {
			regular: /.+/i,
			message_error: "",
			message_empty: ""
		}
	}

	this.init = function(){
		var forms = document.forms;
		for(var i = 0; i < forms.length; i++){
			var form = forms[i];
			forms[i].addEventListener("submit", function(stop){
				stop.preventDefault();
				var data = self.validate(form);
				if(data){
					//var ajax = new Ajax();

				}
			});
			
		}
	}

	this.validate = function(form){
		console.log(form);
		return "sfgf";
	}

}

function Ajax(){
	
	var self = this;

	this.send = function(method, url, arr){
		var data = "";
		if(arr) data = self.getRow(arr);
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

	this.getRow = function(arr){
		var row = "";
		for (var key in arr) row += key + "=" + arr[key] + "&";
		return row.slice(0, -1);
	}
}

var validator = new Validator();
var mf = new ModalForm();

window.addEventListener("load", mf.init);
window.addEventListener("load", validator.init);