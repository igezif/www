function Basket(){
	
	self = this;

	var section_buy = document.getElementsByClassName("add_basket");

	this.init = function(){
		for(var i = 0; i < section_buy.length; i++){
			section_buy[i].addEventListener("click", self.add_basket);
		}
	}

	this.add_basket = function(e){
		var button, id, ajax;
		var data = [];
		var ajax = new Ajax();
		if(e.target.classList[0] === "add_basket"){
			button = e.target;
		}
		else{
			button = e.target.parentNode;
		}
		id = button.getAttribute("data-basket");
		data["id"] = id;
		ajax.send("POST", "/basket", data).then(function(response){
			console.log(response);
		}, function(error) {
			console.log(error);
		});	
	}

}

function Ajax(){
	
	var self = this;

	this.send = function(method, url, arr){
		var data = self.getRow(arr);
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