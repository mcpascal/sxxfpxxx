window.onload=window.onresize=getWinWidthAndHeight();
document.onmousemove=function(e){
	var e=e||window.event; 
	winWidth-e.clientX<=57?window.top.right.showOrHidden(true):window.top.right.showOrHidden(false);
}