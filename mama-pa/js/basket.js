window.addEventListener("load", function(){
	var count_buttons = document.querySelectorAll(".count_basket_arow_wrap");
	var del_buttons = document.querySelectorAll(".del_basket");
	for(var i = 0; i < del_buttons.length; i++){
		del_buttons[i].addEventListener("click", function(e){
			var id = e.target.getAttribute("data-id");
			var postSend = function(response){
				var data = JSON.parse(response);
				document.querySelector("div[data-id='" + data["id"] + "'].del_basket").parentNode.parentNode.remove();
				if(data["summ"] === 0){
					document.getElementById("basket_text").innerHTML = "Ваша корзина пуста";
					document.getElementById("tr_basket_summ").remove();
					document.querySelector(".set_order").remove();
				}
				else{
					document.getElementById("basket_span_summ").innerHTML = data["summ"];
				}
				span_summ.innerHTML = data["summ"];
			}
			basket.del(id, postSend);
		});
	}
	for(var i = 0; i < count_buttons.length; i++) {
		count_buttons[i].addEventListener("mouseover", function(e) {
			if(e.target.classList[0] === "count_basket_arow_wrap"){
				e.target.style.boxShadow = "0 0 3px #0a0a0a";
			}
			else{
				e.target.parentNode.style.boxShadow = "0 0 3px #0a0a0a";
			}
		});
		count_buttons[i].addEventListener("mouseout", function(e) {
			if(e.target.classList[0] === "count_basket_arow_wrap"){
				e.target.style.boxShadow = "none";
			}
			else{
				e.target.parentNode.style.boxShadow = "none";
			}
		});
		count_buttons[i].addEventListener("mousedown", function(e){
			if(e.target.classList[0] === "count_basket_arow_wrap"){
				e.target.style.boxShadow = "none";
			}
			else{
				e.target.parentNode.style.boxShadow = "none";
			}
		});
		count_buttons[i].addEventListener("mouseup", function(e){
			var button;
			if(e.target.classList[0] === "count_basket_arow_wrap") button = e.target;
			else button = e.target.parentNode;
			button.style.boxShadow = "0 0 3px #0a0a0a";
			var id = button.getAttribute("data-id");
			var action = button.classList[1];
			var count = +document.querySelector("div[data-id='" + id + "'].basket_product_count").innerHTML;
			if(count === 1 && action === "count_minus") return;
			var postSend = function(response){
				console.log(response);
				var data = JSON.parse(response);
				document.querySelector("div[data-id='" + data["id"] + "'].basket_product_count").innerHTML = data["count"];
				document.querySelector("span[data-id='" + data["id"] + "'].basket_product_summ").innerHTML = data["product_summ"];
				document.querySelector("#basket_span_summ").innerHTML = data["summ"];
				span_summ.innerHTML = data["summ"];
			}
			var preSend = function(){

			}
			basket.changeCount(id, action, preSend, postSend);
		});
	}	
});