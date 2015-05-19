function AbstractForm(){

	var self = this;

	this._form = undefined;

	this._validateInputs = {};

	this._inputs = {};

	this._countSend = 0;

	this.init = function(selector){
		self._form = document.querySelector(selector);
		self.setInputs();
		self._form.addEventListener("submit", function(stop){
			stop.preventDefault();
			self._countSend++;
			var validator = new Validator();
			var resultValidate = validator.validate(self._validateInputs);
			if(resultValidate["status"]){
				var data = self.getSendData();
				var ajax = new Ajax();
				ajax.send(self._form.method, self._form.action, data).then(self.postSend, self.postSendError);
			}
			else{
				self.showErrors(resultValidate["items"]);
			}
		});
	}

	this.getSendData = function(){
		var data = {};
		for(var key in self._inputs) {
			data[key] = self._inputs[key].value;
		}
		return data;
	}

	this.setInputs = function(){
		var inputs = self._form.querySelectorAll("input");
		var textarea = self._form.querySelectorAll("textarea");
		for(var i = 0; i < inputs.length; i++) {
			if (inputs[i].type === "submit") continue;
			self._inputs[inputs[i].name] = inputs[i];
			if(inputs[i].getAttribute("data-type")) self._validateInputs[inputs[i].name] = inputs[i];
			if(self.setPreSendBehaviourInput) self.setPreSendBehaviourInput(inputs[i]);
		}
		for(var i = 0; i < textarea.length; i++) {
			self._inputs[textarea[i].name] = textarea[i];
			if(textarea[i].getAttribute("data-type")) self._validateInputs[textarea[i].name] = textarea[i];
			if(self.setPreSendBehaviourInput) self.setPreSendBehaviourInput(inputs[i]);
		}
		return;
	}

	this.postSendError = function(error){
		alert(error);
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

	this.validate = function(inputs){
		var name, status, selector, data_type, value;
		var data = {};
		data["items"] = {};
		data["status"] = true;
		for(var key in inputs) {
			name = inputs[key].name;
			selector = inputs[key].tagName + "[name='" + name + "']";
			data_type = inputs[key].getAttribute("data-type");
			value = inputs[key].value;
			status = types[data_type].regular.test(value);
			if(!status) data["status"] = false;
			data["items"][name] = {"tag": "input", "name": name, "value": value, "data-type": data_type, "status": status, "selector": selector};
		}
		return data;
	}

}


function ModalForm(){

	AbstractForm.apply(this, arguments);

	var self = this;

	var parentInit = this.init;

	var bb, top_start;

	this.init = function() {
		parentInit.apply(this, arguments);
		document.getElementById("show_modal_form").addEventListener("click", self.show);
		document.getElementById("close_modal_form").addEventListener("click", self.hide);
    }

	this.postSend = function(response){
		self.clearForm();
		document.getElementById("modal_form_message").innerHTML = response;
		return;
	}

	this.showErrors = function(items){
		for(var key in items){
			var input = document.querySelector(items[key]["selector"]);
			if(!items[key]["status"]) self.showErrorOnInput(input);
		}
		document.getElementById("modal_form_message").innerHTML = "";
		return;
	}

	this.clearForm = function(){
		for(var key in self._inputs){
			self.setStyleInputPostSend(self._inputs[key]);
		}
		document.getElementById("modal_form_message").innerHTML = "";
		return;
	}

	this.setStyleInputPostSend = function(input){
		input.style.backgroundColor = "#ffffff";
		input.value = "";
		return;
	}

	this.setBehaviourOnInvalidInput = function(input){
		if(!input.onfocus){
			input.onfocus = function(e){
				e.target.style.backgroundColor = "#ffffff";
			}
		}
		return;
	}

	this.showErrorOnInput = function(input){
		input.style.backgroundColor = "#ff8c69";
		self.setBehaviourOnInvalidInput(input);
		return;
	}

	this.show = function(){
		bb = new BlackBackground(self);
		bb.show();
		self._form.style.display = "block";
		top_start = self.getTopStart();
		var top_finish = self.getTopFinish();
		var left = self.getLeft();
		self._form.style.top = top_start + "px";
		self._form.style.left = left + "px";
		self.move(top_finish);
	}

	this.move = function(top_finish){
		var top = top_start;
		var timer = setInterval(function() {
		  	top += 50;
		  	self._form.style.top = top + "px";
			if (self._form.style.top.slice(0, -2) >= top_finish) {
				self._form.style.top = top_finish + "px";
				clearInterval(timer);
				return;
			}
		}, 40);
	}

	this.getLeft = function(){
		var width = document.body.offsetWidth;
		var left = width/2 - self._form.offsetWidth/2;
		return left;
	}

	this.getTopStart = function(){
		var top = 0 - self._form.offsetHeight;
		return top;
	}

	this.getTopFinish = function(){
		var height = document.body.offsetHeight;
		var top = height/2 - self._form.offsetHeight/2;
		return top;
	}

	this.hide = function(){
		bb.hide();
		self._form.style.top = top_start + "px";
		self.clearForm();
	}

	this.onHideBackground = function(){
		self._form.style.top = top_start + "px";
		self.clearForm();
	}

}

var mf = new ModalForm();

window.addEventListener("load", function(){
	mf.init(".modal_form");
});


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