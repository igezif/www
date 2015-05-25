window.onload = function(){
	document.getElementById("for_popup_message").style.display = "none";
	var span_img = document.querySelector("#for_file_input_adm > span");
	var for_input = document.getElementById("for_file_input_adm");
	var div_file_input = document.getElementById("div_file_input");
	var file_input_adm_wrap = document.getElementById("file_input_adm_wrap");
	var minus_adm_input = document.getElementById("minus_adm_input");
	span_img.addEventListener("click", function() {
		this.style.display = "none";
		div_file_input.innerHTML = "<input type = 'file' name = 'img' id = 'input_file' />";
		file_input_adm_wrap.style.display = "block";
	});
	minus_adm_input.addEventListener("click", function(){
		span_img.style.display = "block";
		file_input_adm_wrap.style.display = "none";
		div_file_input.innerHTML = "";
	});
}