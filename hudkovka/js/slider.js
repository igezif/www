function Slider(){
	
	var self = this;
	
	var items = [];
	
	var timer;
	
	this.itemInit = function(img){
		var item = Object.create(null);
		item.body = img.parentNode.parentNode.parentNode.parentNode;
		item.width = item.body.offsetWidth;
		item.getLeft = function(){
			return +item.body.style.left.slice(0, -2);
		}
		item.setLeft = function(left){
			item.body.style.left = left + "px";
			return;
		}
		return item;
	}
	
	this.move = function(len){
		var firstItem = 0;
		timer = setInterval(function() { 
			items.forEach(function(item){
				item.setLeft(item.getLeft() + 1);
			});
			if(items[firstItem].getLeft() === 0){
				if(firstItem === 0)firstItem = len - 1;
				else firstItem -= 1;
				items[firstItem].setLeft(-items[firstItem].width);
			}
		}, 40);
	}
	
	this.start = function(){
		var left = 0;
		var images = document.getElementsByClassName("slider-image");
		var len = images.length;
		for(var i = 0; i < len; i++){
			items[i] = self.itemInit(images[i]);
			if(i !== 0){
				items[i].setLeft(left);
				left += items[i].width;
			}else{
				items[i].setLeft(-items[i].width);
			}
		}
		self.move(len);
	}
}

var slider = new Slider();
window.onload = slider.start;