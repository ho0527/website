let id=getget("id")

if(!id){ location.href="index.html" }

ajax("GET",AJAXURL+"/house/"+id,function(event,data){
	if(data["success"]){
		console.log(data["data"])
	}else{
		alert(ERRORMESSAGE[data["message"]])
	}
})

onclick("#signout",function(element,event){
	ajax("POST",AJAXURL+"/user/logout",function(event,data){
		if(data["success"]){
			alert("登出成功")
			weblsset("51nationalmoduled-userid",null)
			weblsset("51nationalmoduled-permission",null)
			weblsset("51nationalmoduled-token",null)
			href("index.html")
		}else{
			alert(ERRORMESSAGE[data["message"]])
		}
	},[],[
		["Authorization","Bearer "+weblsget("51nationalmoduled-token")]
	])
})