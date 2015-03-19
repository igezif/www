function Slider() {
	
	var self = this;
	
	var items = [];
	
	var data = document.getElementsByClassName("slider_item");
	
	var carousel = document.getElementsByClassName("slider_product");
	
	this.itemInit = function(block){
		var item = Object.create(null);
		
		return item;
	}
	
	this.ready = function(){
		var img_1 = data[0].children[0].src;
		var img_2_act = data[1].children[0].src;
		var img_3 = data[2].children[0].src;
		var link_1 = data[0].children[3].innerText;
		var link_2_act = data[1].children[3].innerText;
		var link_3 = data[2].children[3].innerText;
		var name = data[1].children[1].innerText;
		var description = data[1].children[2].innerText;
		var slider_data = document.getElementById("slider_data");
		var html = '<div id = "slider_image"><a href = "' + link_2_act + '"><img src = "' + img_2_act + '" alt = "Изображение" /></a></div><div id = "slider_content"><div id = "slider_description">' + description + '</div><div id = "slider_name"><b>' + name + '</b></div><a href = "' + link_2_act + '"><div id = "slider_button">Посмотреть</div></a></div><div id = "slider_carousel"><a href = "' + link_1 + '"><div class = "slider_product"><img src = "' + img_1 + '" alt = "Изображение" /></div></a><a href = "' + link_2_act + '"><div class = "slider_product" id = "active_slide"><div id = "slider_arow"></div><img src = "' + img_2_act + '" alt = "Изображение" /></div></a><a href = "' + link_3 + '"><div class = "slider_product"><img src = "' + img_3 + '" alt = "" /></div></a></div>';
		slider_data.insertAdjacentHTML("afterEnd", html);
		return;
	}
	
	this.move = function(){
		
	}
	
	this.start = function(){
		self.ready();
		for (var i = 0; i < data.length; i++) items[i] = self.itemInit(data[i]);
		//self.move(len);
		return;
	}

}

var slider = new Slider();
window.onload = slider.start;