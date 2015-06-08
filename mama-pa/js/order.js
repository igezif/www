function OrderForm(){

	AbstractForm.apply(this, arguments);

	var self = this;

	var parentInit = this.init;

	var order_section, form_block;

	this.init = function() {
		parentInit.apply(this, arguments);
		order_section = document.querySelector(".order");
		form_block = document.querySelector("#form_order_block");
    }

    this.preSend = function(){
    	var html = "<img class = 'load_gif' src = '/img/main/load.gif' alt = 'Image' />";
    	order_section.innerHTML = html;
    	console.log("preSend");
    }

	this.postSend = function(response){
		var html;
		if(response !== "success") {
			html = "<div id = 'form_order_message_block'>\
						<h1 class='product_header'>Что-то пошло не так, попоробуйте пожалуйста ещё раз...</h1>\
					</div>";
		}
		else{
			html = "<div id = 'form_order_message_block'>\
						<h1 class='product_header'>Ваш заказ успешно оформлен!</h1>\
						<img src = '/img/main/pismo.jpg' alt = 'Image' />\
						<p class = 'center text'><b><i>Дождитесь звонка менеджера для подтверждения заказа.</i></b></p>\
						<p class = 'center text'>Вернуться на <a href = '/'>главную</a></p>\
					</div>";
		}
		order_section.innerHTML = html;
		basket.clear();
	}

	this.showErrors = function(items){
		for(var key in items){
			var input = self._form.querySelector(items[key]["selector"]);
			if(!items[key]["status"]) self.showErrorOnInput(input);
		}
	}

	this.setBehaviourOnInvalidInput = function(input){
		if(!input.onfocus){
			input.onfocus = function(e){
				e.target.style.backgroundColor = "#ffffff";
			}
		}
	}

	this.showErrorOnInput = function(input){
		input.style.backgroundColor = "#ff8c69";
		self.setBehaviourOnInvalidInput(input);
	}

}

var of = new OrderForm();

window.addEventListener("load", function(){
	of.init("#order_form");
});