var span_summ;

function Basket(){
	
	self = this;

	this.init = function(){
		span_summ = document.getElementById("span_summ");
		var add_buttons = document.querySelectorAll(".add_basket");
		if(add_buttons.length > 0){
			for(var i = 0; i < add_buttons.length; i++){
				add_buttons[i].addEventListener("click", self.add);
			}	
		}
	}

	this.showError = function(error){
		alert(error);
	}

	this.add = function(e){
		if(e.target.classList[0] === "add_basket"){
			var button = e.target;
		}
		else{
			var button = e.target.parentNode;
		}
		var data = {"action": "add", "id": button.getAttribute("data-id")};
		ajax.send("POST", "ajax/basket", data).then(self.showAddProduct, self.showError);
	}

	this.del = function(id, postSend){
		var data = {"action": "del", "id": id};
		ajax.send("POST", "ajax/basket", data).then(postSend, self.showError);	
	}

	this.showAddProduct = function(response){
		console.log(response);
		var data = JSON.parse(response);
		span_summ.innerHTML = data["summ"];
		var html = "<p class = 'basket_small_text'>Товар добавлен в корзину</p><p class = 'basket_small_title'>" + data["product"]["title"] + "</p><img src = '" + data["product"]["img"] + "' class = 'basket_small_img'><p class = 'basket_small_price'>" + data["product"]["price"] + " <span class = 'rouble'>&#8399;</span></p>";
		message.createMessage(html);
	}

	this.changeCount = function(id, action, preSend, postSend){
		ajax.send("POST", "ajax/basket", {"action": action, "id": id}).then(postSend, self.showError);
		preSend();
	}

	this.clear = function(){
		ajax.send("POST", "ajax/basket", {"action": "clear"}).then(function(){
			span_summ.innerHTML = "0";
		}, self.showError);
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

function Message(){

	var self = this;

	var mb, messages;

	var hide_interval = 3000;

	this.init = function(){
		mb = document.getElementById("for_popup_message");
		if(self.isSetMessages()){
			for(var i = 0; i < messages.length; i++){
				var block = messages[i];
				self.showMessage(block);
				messages[i].querySelector(".close_popup_message").addEventListener("click", function(){
					self.closeMessage(block);
				});
				setTimeout(function(){
					self.closeMessage(block);
				}, 180000);
			}
		}
	}

	this.showMessage = function(block){
		block.style.opacity = 1;
	}

	this.closeMessage = function(block){
		block.style.opacity = 0;
		setTimeout(function(){
			block.remove();
		}, 1000);
	}

	this.isSetMessages = function(){
		var m = document.querySelectorAll("#for_popup_message > div");
		if(m.length > 0){
			messages = m;
			return true;
		}
		else return false;
	}

	this.createMessage = function(content){
		var block = document.createElement('div');
		var button_close = document.createElement('div');
		button_close.setAttribute("class", "close_popup_message");
		button_close.addEventListener("click", function(e){
			var block = e.target.parentNode;
			self.closeMessage(block);
		});
		var content_block = document.createElement('div');
		content_block.setAttribute("class", "content_popup_message");
		content_block.innerHTML = content;
		block.appendChild(button_close);
		block.appendChild(content_block);		
		mb.appendChild(block);
		setTimeout(function(){
			self.showMessage(block);
		}, 10);
		setTimeout(function(){
			self.closeMessage(block);
		}, hide_interval);
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
				self.preSend();
				var data = self.getSendData();
				ajax.send(self._form.method, self._form.action, data).then(self.postSend, self.postSendError);
			}
			else{
				self.showErrors(resultValidate["items"]);
			}
		});
		var radioButtons = self._form.querySelectorAll("input[type='radio']");
		for(var i = 0; i < radioButtons.length; i++) radioButtons[i].addEventListener("click", self.setInputs);
	}

	this.getSendData = function(){
		var data = {};
		for(var key in self._inputs) {
			data[key] = self._inputs[key].value;
		}
		return data;
	}

	this.setInputs = function(){
		if(self._inputs.length > 0) self._inputs = {};
		var inputs = self._form.querySelectorAll("input");
		var textarea = self._form.querySelectorAll("textarea");
		for(var i = 0; i < inputs.length; i++) {
			if (inputs[i].type === "submit") continue;
			if(inputs[i].type === "text") {
				self._inputs[inputs[i].name] = inputs[i];
				if(inputs[i].getAttribute("data-type")) self._validateInputs[inputs[i].name] = inputs[i];
				if(self.setPreSendBehaviourInput) self.setPreSendBehaviourInput(inputs[i]);
			}
			else if(inputs[i].type === "radio" && inputs[i].checked) {
				self._inputs[inputs[i].name] = inputs[i];
			}
		}
		for(var i = 0; i < textarea.length; i++) {
			self._inputs[textarea[i].name] = textarea[i];
			if(textarea[i].getAttribute("data-type")) self._validateInputs[textarea[i].name] = textarea[i];
			if(self.setPreSendBehaviourInput) self.setPreSendBehaviourInput(inputs[i]);
		}
	}

	this.postSendError = function(error){
		alert(error);
		//alert("error");
	}

	this.preSend = function(){
		return
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

function BlackBackground(obj){
	
	this.obj = obj;

	var self = this;

	this.show = function(){
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
		if(div) {
			div.removeEventListener("click", self.hide);
			div.remove();
		}
	}

}

var basket = new Basket();
var message = new Message();
var ajax = new Ajax();

window.addEventListener("load", basket.init);
window.addEventListener("load", message.init);