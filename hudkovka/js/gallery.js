function Gallery(){
	
	var self = this;
	
	var left = document.querySelector(".button");
	
	var right = document.querySelectorAll(".button")[1];
	
	var block = document.querySelector(".gallery-image");

	var items, len;
	
	var index = 0;
	
	var active = 0;
	
	var buttonTop = 0;
	
	this.step = function(n){
		if(n === 'left'){
			if(index > 0) index--;
			else if(index <= 0) index = len;
		}else if(n === 'right'){
			if(index < len) index++;
			else if(index >= len) index = 0;
		}
		items[active].style.display = "none";
		self.show(items[index]);
		active = index;
	}
	
	this.setButtonHeight = function(){
		right.childNodes[1].style.borderTop = items[index].clientHeight/2 + "px solid transparent";
		right.childNodes[1].style.borderBottom = items[index].clientHeight/2 + "px solid transparent";
		left.childNodes[1].style.borderTop = items[index].clientHeight/2 + "px solid transparent";
		left.childNodes[1].style.borderBottom = items[index].clientHeight/2 + "px solid transparent";
	}
	
	this.show = function(img, init){
		img.style.display = "block";
		if(!init){
			img.style.opacity = 0;
			block.scrollIntoView(false);
			var op = 0.1;
			var timerId = setInterval(function() {
				img.style.opacity = op;
				op = op + 0.05;
				if(op >= 1){
					img.style.opacity = 1;
					clearInterval(timerId);
				}
			}, 70);
		}
		self.setButtonHeight();
	}

	this.init = function(){
		items = document.querySelectorAll(".gallery-image img");
		len = items.length - 1;
		block.addEventListener("mousedown", function() {
			self.step("right");
		});
		left.addEventListener("mouseout", function(e) {
			e.target.parentNode.style.boxShadow = "none";
		});
		right.addEventListener("mouseout", function(e) {
			e.target.parentNode.style.boxShadow = "none";
		});
		left.addEventListener("mouseover", function(e) {
			e.target.parentNode.style.boxShadow = "0 0 10px #0a0a0a";
		});
		right.addEventListener("mouseover", function(e) {
			e.target.parentNode.style.boxShadow = "0 0 10px #0a0a0a";
		});
		left.addEventListener("mouseup", function(e) {
			e.target.parentNode.style.boxShadow = "0 0 10px #0a0a0a";
			self.step("left");
		});
		right.addEventListener("mouseup", function(e) {
			e.target.parentNode.style.boxShadow = "0 0 10px #0a0a0a";
			self.step("right");
		});
		left.addEventListener("mousedown", function(e) {
			e.target.parentNode.style.boxShadow = "none";
		});		
		right.addEventListener("mousedown", function(e) {
			e.target.parentNode.style.boxShadow = "none";
		});
		self.show(items[index], true);
	}
}

var gallery = new Gallery();
var im = document.querySelector(".gallery-image img");

if (im.complete) {
	gallery.init();
}else 
	im.addEventListener('load', gallery.init);