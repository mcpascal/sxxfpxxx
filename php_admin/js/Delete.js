function Delete(selectAllId,url){
	var self=this;
	XmlHttpRequest.call(this);
	this.url=url;
	this.idStr="";
	this.trIdStr="";
	this.id="";
	this.trId="";
	this.selectAllId=selectAllId;
	this.selectAll=function(){
		box =document.getElementsByName('checkbox');
		for (var j = 0; j < box.length; j++) {
			box[j]&&$(self.selectAllId).innerHTML=="选择全部"?box[j].checked = true:box[j].checked = false;
		}
		if(box.length>0){
			$(self.selectAllId).innerHTML=="选择全部"?$(self.selectAllId).innerHTML="取消选择全部":$(self.selectAllId).innerHTML="选择全部";
		}else{
			try{
				window.top.win1.win1Show("提示","暂无记录可供选择","",false)	
			}catch(e){
				alert("暂无记录可供选择!");
			}
		}
	}
	
	this.deleteOne=function(id,trId){
		self.id=id;
		self.trId=trId;
		window.top.win1.win1Show("提示","您确定要删除吗？","window.frames[0].frames[4].del.deleteOneNext();",true);
	}
	this.deleteOneNext=function(){
		
		self.set("");
		self.sendPost(self.url,"id="+self.id+"&"+Math.random(),"self.deleteOneCallBackFun()");
	}
	this.deleteOneCallBackFun=function(){
		//alert(self.xml.responseText);
		switch(self.xml.responseText){
			case "need login":
				window.top.location.href="LoginOut.php";
				break;
			case "no power":
				window.top.win3.win3Show(0,"操作失败，没有权限","");
				break;
			case "0":
				window.top.win3.win3Show(0,"操作失败","");
				break;
			case "1":
				$(self.trId).style.display="none";
				window.top.win3.win3Show(1,"操作成功","");
				break;
		}
	}
	
	this.deleteSelected=function(){
		box=document.getElementsByName("checkbox");
		flag=0;
		trid="";
		id="";
		for(i=0;i<box.length;i++){
			if(box[i].checked){
				flag=1;
				if (trid==""){
					trid+=box[i].value.split("_")[1];
					id+=box[i].value.split("_")[0];
				}
				else{
					trid+=","+box[i].value.split("_")[1];
					id+=","+box[i].value.split("_")[0];
				}
			}
		}
		self.trIdStr=trid;
		self.idStr=id;
		if (flag==0){
			try{
				window.top.win1.win1Show("提示","请先选择您要删除的记录","",false)	
			}catch(e){
				alert("请先选择您要删除的记录!");
			}
			return;
		}
		window.top.win1.win1Show("提示","您确定要删除吗？","window.frames[0].frames[4].del.deleteSelectedNext();",true);
	}
	this.deleteSelectedNext=function(){
		self.set("");
		self.sendPost(self.url,"id="+self.idStr+"&"+Math.random(),"self.deleteSelectedCallBackFun()");
	}
	this.deleteSelectedCallBackFun=function(){
		switch(self.xml.responseText){
			case "need login":
				window.top.location.href="LoginOut.php";
				break;
			case "no power":
				window.top.win3.win3Show(0,"操作失败，没有权限","");
				break;
			case "0":
				window.top.win3.win3Show(0,"操作失败","");
				break;
			case "1":
				self.deleteTrs();
				window.top.win3.win3Show(1,"操作成功","");
				break;
		}	
	}
	this.deleteTrs=function(){
		tridArr=self.trIdStr.split(",");
		for(m=0;m<tridArr.length;m++){
			$("tr"+tridArr[m]).style.display="none";
		}
	}
}

try{
	document.onkeydown=function(e){ 
		var e=e||window.event; 
		if(e.keyCode==13){
			if(window.top.$("win1").style.display==""){
				window.top.win1.win1Eval();
				return false;
			}
		}
	}	
}catch(err){}
