function changetop(){
	if($("all").rows=="91,6,*,30"){
		$("all").rows="0,6,*,30";
		window.frames[1].document.getElementById("imgTop").src="images/down.gif";
	}
	else{
		$("all").rows="91,6,*,30";
		window.frames[1].document.getElementById("imgTop").src="images/up.gif";
	}
}
function changeleft(){
	if($("down").cols=="226,7,*"){
		$("down").cols="0,7,*";
		window.frames[3].document.getElementById("imgLeft").src="images/left.gif";
	}
	else{
		$("down").cols="226,7,*";
		window.frames[3].document.getElementById("imgLeft").src="images/right.gif";
	}
}
window.onload = function() {
	window.parent.winLoadAndResize();
}