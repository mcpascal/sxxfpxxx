document.onkeydown=function(e){ 
	var e=e||window.event; 
	if(e.keyCode==13){
		if(window.top.$("win1").style.display==""){
			window.top.win1.win1Eval();
		}
		if(window.top.$("win2").style.display==""){
			window.top.win2.win2Eval();
		}
	}
}
function changeLeftTree(id,num){
	window.top.frames[0].$('left').src="Left.php?id="+id;
	for(i=0;i<num;i++){
		$("a"+i).className="";	
	}
	$("a"+id).className="aSelect";	
}