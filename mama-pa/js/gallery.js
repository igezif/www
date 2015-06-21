function Gallery(){

	var self = this;

	var big_image, wrap_big_image, images, old_big_image;

	this.init = function(){
		images = document.querySelectorAll(".gallery_image");
		big_image = document.getElementById("big_image");
		wrap_big_image = document.getElementById("wrap_big_image");
		for(var i = 0; i < images.length; i++){
			images[i].addEventListener("mouseover", self.show);
			images[i].addEventListener("mouseout", self.hide);
			images[i].addEventListener("click", self.fix);
		}
	}

	this.show = function(e){
		//console.log(e.target.outerHTML);
		wrap_big_image.innerHTML = e.target.outerHTML;
	}

	this.hide = function(e){
		//console.log(e.target);
		wrap_big_image.innerHTML = big_image.outerHTML;
	}

	this.fix = function(e){
		old_big_image = big_image;
		big_image = e.target;
		var timer = setTimeout(function() {
			big_image = old_big_image;
		}, 1000);
	}

}

var gallery = new Gallery();

window.addEventListener("load", gallery.init);