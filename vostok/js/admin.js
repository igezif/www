//about
function createAboutChangeForm(name){
	var html = 
	"<form class = 'modal_form about_change_form' method = 'POST' action='/ajax/about'>\
		<div class = 'close_modal_form'></div>\
		<div><textarea name = '" + name + "' data-type = 'text'></textarea></div>\
		<div><input type = 'submit' value = 'Сохранить' /></div>\
		<div class = 'modal_form_message'></div>\
	</form>";
	document.getElementById("container").insertAdjacentHTML("beforeBegin", html);
}

function removeAboutChangeForm(){
	document.querySelector(".about_change_form").remove();
}

function AdminModalForm(){

	ModalForm.apply(this, arguments);

	var self = this;

	var parentInit = this.init;

	var parentShow = this.show;

	var parentPostSend = this.postSend;

	this._p = null;

	this.init = function(selector, value, p) {
		parentInit.apply(this, arguments);
		self._p = p;
		self.show(value);
    }

    this.show = function(value) {
    	parentShow.apply(this, arguments);
    	self._form.querySelector("textarea").value = value;
    }

    this.postSend = function(response) {
    	self._bb.hide();
    	removeAboutChangeForm();
    	if(response === "error") alert("Вы ввели не корректное значение, попробуйте ещё раз!");
    	else self._p.textContent = response;
    }

	this.setButtonShow = function(){
		return;
    }

}
	
window.addEventListener("load", function(){
	var buttons = document.querySelectorAll(".admin_change");
	for(var i = 0; i < buttons.length; i++) {
		buttons[i].addEventListener("click", function(e){
			//console.log(ModalForm);
			createAboutChangeForm(e.target.classList[1]);
			var amf = new AdminModalForm();
			var p = e.target.parentNode.querySelector(".about_admin_text");
			var value = p.textContent;
			amf.init(".about_change_form", value, p);
		});
	}
});