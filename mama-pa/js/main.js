function Basket(){
	
	self = this;

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
		console.log(response);
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
		ajax.send("POST", "ajax/basket", data).then(self.show, self.showError);	
	}

	this.show = function(response){
		console.log(response);
	}

	this.showError = function(error){
		alert(error);
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

var basket = new Basket();
window.addEventListener("load", basket.init);