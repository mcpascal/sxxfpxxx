function titleMouseOver(id){
	if($$("title"+id)){
		$("title"+id).className="titleMouseOver";
	}
	if($$("titleImg"+id)){
		$("linkCon"+id).className=="linkConHidden"?$("titleImg"+id).src="images/leftDown.png":$("titleImg"+id).src="images/leftUp.png";
	}
}
function titleMouseOut(id){
	if($$("title"+id)){
		$("title"+id).className="title";
	}
	if($$("titleImg"+id)){
		$("linkCon"+id).className=="linkConHidden"?$("titleImg"+id).src="images/leftUp.png":$("titleImg"+id).src="images/leftDown.png";
	}
}
function titleClick(id){
	if($$("linkCon"+id)){
		$("linkCon"+id).className=="linkConHidden"?$("linkCon"+id).className="linkCon":$("linkCon"+id).className="linkConHidden";
	}
}
function changeAll(){
	for(i=1;i<=titleCount;i++){
		if($$("linkCon"+i)){
		$("aChangeAll").innerHTML=="全部展开"?$("linkCon"+i).className="linkCon":$("linkCon"+i).className="linkConHidden";
		$("aChangeAll").innerHTML=="全部展开"?$("titleImg"+i).src="images/leftDown.png":$("titleImg"+i).src="images/leftUp.png";
		}
	}
	$("aChangeAll").innerHTML=="全部展开"?$("aChangeAll").innerHTML="全部收起":$("aChangeAll").innerHTML="全部展开";
}