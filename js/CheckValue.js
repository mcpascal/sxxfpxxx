function CheckValue(){
	this.checkNull=function (val,message){
		if(trim(String(val))==""){
			alert(message);
			return true;	
		}else{
			return false;	
		}
	}
	this.checkLen=function (val,len,message){
		if(trim(String(val)).length>len){
			alert(message);
			return false;	
		}else{
			return true;	
		}
	}
	this.checkReg=function (val,reg,message){
		if(String(val).match(reg)==null){
			alert(message);
			return false;	
		}else{
			return true;	
		}
	}
	this.checkEqual=function (val,va12,message){
		if(val!=va12){
			alert(message);
			return false;	
		}else{
			return true;	
		}
	}
}