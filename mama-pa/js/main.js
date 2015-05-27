function Basket(){
	
	self = this;

	var summ;
	var adds = document.getElementsByClassName("add_basket");
	var dels = document.getElementsByClassName("del_basket");

	this.init = function(){
		if(adds.length > 0){
			var len = adds.length;
			for(var i = 0; i < len; i++){
				adds[i].addEventListener("click", self.add_basket);
			}	
		}
		if(dels.length > 0){
			var len = dels.length;
			for(var i = 0; i < len; i++){
				dels[i].addEventListener("click", self.del_basket);
			}	
		}
	}

	this.del_basket = function(e){
		var button = e.target;
		var ajax = new Ajax();
		var data = {"action": "del", "id": button.getAttribute("data-basket")};
		ajax.send("POST", "ajax/basket", data).then(self.del, self.showError);	
	}

	this.del = function(response){
		var data = JSON.parse(response);
		document.querySelector("div[data-basket='" + data["id"] + "']").parentNode.parentNode.remove();
		console.log(data["summ"]);
		if(data["summ"] === 0){
			document.getElementById("basket_text").innerHTML = "Ваша корзина пуста";
			document.getElementById("tr_basket_summ").remove();
			document.getElementById("tr_basket_order").remove();
		}
		else{
			document.getElementById("basket_span_summ").innerHTML = data["summ"];
		}
		document.getElementById("span_summ").innerHTML = data["summ"];
	}

	this.add_basket = function(e){
		if(e.target.classList[0] === "add_basket"){
			var button = e.target;
		}
		else{
			var button = e.target.parentNode;
		}
		var ajax = new Ajax();
		var data = {"action": "add", "id": button.getAttribute("data-basket")};
		ajax.send("POST", "ajax/basket", data).then(self.showAddProduct, self.showError);
	}

	this.showError = function(error){
		alert(error);
	}

	this.showAddProduct = function(response){
		var data = JSON.parse(response);
		document.getElementById("span_summ").innerHTML = data["summ"];
		var html = "<p class = 'basket_small_text'>Товар добавлен в корзину</p><p class = 'basket_small_title'>" + data["product"]["title"] + "</p><img src = '" + data["product"]["img"] + "' class = 'basket_small_img'>";
		message.createMessage(html);
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

var basket = new Basket();
var message = new Message();

window.addEventListener("load", basket.init);
window.addEventListener("load", message.init);
window.addEventListener("load", function(){
	document.querySelector(".set_order").onclick = function(){
		document.querySelector("form[name='order_form']").submit();
	}
});