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

function Validator(){
	
	var self = this;

	var types = {
		advisable: {
			regular: /.+/i
		},

		email: {
			regular: /.+@.+\..+/i
		},
		text: {
			regular: /.+/i
		},
		integer: {
			regular: /\d/i
		},
		phone: {
			regular: /\d/i
		}
	}

	this.validate = function(form){
		var value, name, status, selector;
		var data = {};
		data["items"] = {};
		data["status"] = true;
		data["action"] = form.action;
		data["method"] = form.method;
		var inputs = form.querySelectorAll("input");
		var textarea = form.querySelectorAll("textarea");
		for(var i = 0; i < inputs.length; i++){
			var data_type = inputs[i].getAttribute("data-type");
			if(data_type){
				value = inputs[i].value;
				name = inputs[i].name;
				status = types[data_type].regular.test(value);
				selector = "input[name='" + name + "']";
				if(!status) data["status"] = false;
				data["items"][name] = {"tag": "input", "name": name, "value": value, "data-type": data_type, "status": status, "selector": selector};
			}
		}
		for(var i = 0; i < textarea.length; i++){
			var data_type = textarea[i].getAttribute("data-type");
			if(data_type){
				value = textarea[i].value;
				name = textarea[i].name;
				status = types[data_type].regular.test(value);
				selector = "textarea[name='" + name + "']";
				if(!status) data["status"] = false;
				data["items"][name] = {"tag": "textarea", "name": name, "value": value, "type": textarea[i].type, "status": status, "selector": selector};
			}
		}

		return data;
	}

}

function BlackBackground(obj){
	
	this.obj = obj;

	var self = this;


	this.show = function(){
		var div;
		var height = document.body.scrollHeight;
		var width = document.body.scrollWidth;
		var div = document.createElement('div');
		div.id = "black_background";
		div.style.height = height + "px";
		div.style.width = width + "px";
		div.style.backgroundColor = "#000000";
		div.style.opacity = 0.5;
		div.style.position = "absolute";
		div.style.top = 0;
		div.style.left = 0;
		div.style.zIndex = 999;
		document.body.appendChild(div);
		div.addEventListener("click", self.hide);
	}

	this.hide = function(func){
		if(func !== undefined) self.obj.onHideBackground();
		var div = document.getElementById("black_background");
		div.removeEventListener("click", self.hide);
		div.remove();
	}

}

function ModalForm(){

	var self = this;

	var bb, form, top_start;

	var inputs = false;

	this.show = function(){
		bb = new BlackBackground(self);
		bb.show();
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
		document.getElementById("show_modal_form").addEventListener("click", self.show);
		document.getElementById("close_modal_form").addEventListener("click", self.hide);
		form.addEventListener("submit", function(stop){
			stop.preventDefault();
			var validator = new Validator();
			var data = validator.validate(form);
			self.setInputs(data["items"]);
			if(data["status"]){
				var arr = {};
				for(var key in data["items"]){
					arr[key] = data["items"][key]["value"];
				}
				var ajax = new Ajax();
				ajax.send(data["method"], data["action"], arr).then(self.postSend, self.postSendError);
				console.log("send");
			}
			else{
				self.showError(data["items"]);
			}
		});
	}

	this.hide = function(){
		bb.hide();
		form.style.top = top_start + "px";
		self.clearForm();
	}

	this.onHideBackground = function(){
		form.style.top = top_start + "px";
		self.clearForm();
	}

	/* --------- */
	this.postSend = function(response){
		self.clearForm();
		document.getElementById("modal_form_message").innerHTML = response;
	}

	this.postSendError = function(error){
		alert(error);
	}

	this.clearForm = function(){
		if(!inputs) return;
		form.reset();
		for(var key in inputs){
			document.querySelector(inputs[key]["selector"]).style.backgroundColor = "#ffffff";
		}
		document.getElementById("modal_form_message").innerHTML = "";
	}

	this.setInputs = function(items){
		inputs = {};
		for(var key in items){
			inputs[items[key]["name"]] = {};
			inputs[items[key]["name"]]["selector"] = items[key]["selector"];
			document.querySelector(items[key]["selector"]).addEventListener("focus", function(){
				this.style.backgroundColor = "#ffffff";
			});
		}
	}

	this.showError = function(items){
		for(var key in items){
			if(!items[key]["status"]){
				document.querySelector(items[key]["selector"]).style.backgroundColor = "#ff8c69";
			}	
		}
	}



}

var mf = new ModalForm();

window.addEventListener("load", mf.init);