function XmlHttpRequest(){
	this.xml=null;
	this.url="";
	this.callBackFun="";
	var self=this;
	this.set=function(errEval){
		try{
			if( window.ActiveXObject ){
				for( var i = 5; i > -1; i-- ){
					try{
						if( i == 2 ){
							self.xml = new ActiveXObject( "Microsoft.XMLHTTP" );
						}else{
							self.xml = new ActiveXObject( "Msxml2.XMLHTTP." + i + ".0" );
						}
						break;
					}catch(e){
						self.xml = null;
					}
				}
			}else if( window.XMLHttpRequest ){
				self.xml = new XMLHttpRequest();
			}
		}catch(e){
			self.xml = null;
		}
		if(self.xml==null&&errEval!=""){
			eval(errEval);	
		}
	}
	this.sendPost=function(url,postStr,callBackFun){
		if(self.xml){
			self.callBackFun=callBackFun;
			self.url=url;
			self.xml.open("post", url, true);
			self.xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			self.xml.onreadystatechange =self.onReadyStateChange;
			self.xml.send(postStr);	
		}
	}
	this.onReadyStateChange=function(){
		if(self.xml.readyState==4 && self.xml.status==200){
			if(self.callBackFun!=""){
				eval(self.callBackFun);
			}
		}
	}
}