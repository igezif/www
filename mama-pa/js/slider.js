function Slider(){
	
	var self = this;
	
	var items = [];
	
	this.itemInit = function(block){
		var item = Object.create(null);
		console.log(block.children);
		
		//item.body = img.parentNode.parentNode.parentNode.parentNode;
		//item.width = item.body.offsetWidth;
		
		return item;
	}
	
	this.start = function(){
		var left = 0;
		var data = document.getElementsByClassName("slider_item");
		var len = data.length;
		for (var i = 0; i < len; i++) items[i] = self.itemInit(data[i]);
		//self.init();
		//self.move(len);
		return
	}

}

var slider = new Slider();
//slider.start();
window.onload = slider.start;