var head_timer_interval = 1000;

function Slider() {
	
	var self = this;
	
	var items = [];
	
	var indexes = [];
	
	var data = document.getElementsByClassName("slider_item");
	
	var last_index, first_index;
	
	var carousel, big_img, big_img_a, button_a, first_img_a, second_img_active_a, third_img_a, description_block, name_block, first_img, second_active_img, third_img;
	
	this.itemInit = function(block){
		var item = Object.create(null);
		item.src = block.children[0].src;
		item.name = block.children[1].innerText;;
		item.description = block.children[2].innerText;
		item.link = block.children[3].innerText;
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
		var html = '<div id = "slider_image"><a href = "' + link_2_act + '"><img src = "' + img_2_act + '" alt = "Изображение" /></a></div><div id = "slider_content"><div id = "slider_description">' + description + '</div><div id = "slider_name"><b>' + name + '</b></div><a href = "' + link_2_act + '"><div id = "slider_button">Посмотреть</div></a></div><div id = "slider_carousel"><a href = "' + link_1 + '"><div class = "slider_product" id = "first_image"><img src = "' + img_1 + '" alt = "Изображение" /></div></a><a href = "' + link_2_act + '"><div class = "slider_product" id = "active_slide"><div id = "slider_arow"></div><img src = "' + img_2_act + '" alt = "Изображение" /></div></a><a href = "' + link_3 + '"><div class = "slider_product" id = "third_image"><img src = "' + img_3 + '" alt = "" /></div></a></div>';
		first_index = 0;
		last_index = data.length - 1;
		slider_data.insertAdjacentHTML("afterEnd", html);
		carousel = document.getElementsByClassName("slider_product");
		big_img = document.querySelector("#slider_image a img");
		big_img_a = document.querySelector("#slider_image a");
		button_a = document.querySelector("#slider_content a");
		first_img_a = document.querySelectorAll("#slider_carousel a")[0];
		second_img_active_a = document.querySelectorAll("#slider_carousel a")[1];
		third_img_a = document.querySelectorAll("#slider_carousel a")[2];
		description_block = document.getElementById("slider_description");
		name_block = document.querySelector("#slider_name b");
		first_img = document.querySelector("#first_image img");
		second_active_img = document.querySelector("#active_slide img");
		third_img = document.querySelector("#third_image img");
		for (var i = 0; i < data.length; i++) items[i] = self.itemInit(data[i]);
		return;
	}
	
	this.setFirst = function(item){
		first_img.src = item.src;
		first_img_a.href = item.link;
		return;
	}
	
	this.setActive = function(item){
		big_img.src = item.src;
		description_block.innerText = item.description;
		name_block.innerText = item.name;
		second_active_img.src = item.src;
		big_img_a.href = item.link;
		button_a.href = item.link;
		second_img_active_a.href = item.link;
		return;
	}
	
	this.setThird = function(item){
		third_img.src = item.src;
		third_img_a.href = item.link;
		return;
	}
	
	this.setIndexes = function(){
		if (first_index === last_index) {
			first_index = 0;
			indexes[0] = first_index;
			indexes[1] = first_index + 1;
			indexes[2] = first_index + 2;
		}
		else if (first_index + 1 === last_index) {
			first_index++;
			indexes[0] = last_index;
			indexes[1] = 0;
			indexes[2] = 1;
		}
		else if (first_index + 2 === last_index) {
			first_index++;
			indexes[0] = first_index;
			indexes[1] = first_index + 1;
			indexes[2] = 0;
		}
		else {
			first_index++;
			indexes[0] = first_index;
			indexes[1] = first_index + 1;
			indexes[2] = first_index + 2;
		}
		return;
	}
	
	this.opacityOff = function(){
		var timer = setInterval(function() {
			img.style.opacity = op;
			op = op + 0.05;
			if(op >= 1){
				img.style.opacity = 1;
				clearInterval(timer);
			}
		}, 70);
		return;
	}
	
	this.opacityOn = function(){
		
		return;
	}
	
	this.go = function(){
		var timer = setInterval(function() {
			self.setIndexes();
			self.opacityOff();
			self.setFirst(items[indexes[0]]);
			self.setActive(items[indexes[1]]);
			self.setThird(items[indexes[2]]);
			self.opacityOn();
		}, head_timer_interval);
		return;
	}
	
	this.start = function(){
		self.ready();
		self.go();
		return;
	}

}

var slider = new Slider();
window.onload = slider.start;