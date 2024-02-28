if(!weblsget("50nationalmodulea-token")){ href("index.html") }

if(4<=weblsget("50nationalmodulea-permission")){
	innerhtml("#navigationbar",`
		<div class="navigationbarleft">
			<input type="button" class="navigationbarbutton" id="newalbum" value="新增專輯">
		</div>
		<div class="navigationbarright">
			<input type="button" class="navigationbarbutton" onclick="location.href='index.html'" value="首頁">
			<input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='album.html'" value="專輯列表">
			<input type="button" class="navigationbarbutton" onclick="location.href='music.html'" value="音樂列表">
			<input type="button" class="navigationbarbutton" onclick="location.href='log.html'" value="伺服器紀錄">
			<input type="button" class="navigationbarbutton" onclick="location.href='user.html'" value="使用者管理">
			<input type="button" class="navigationbarbutton" id="signout" value="登出">
		</div>
	`)
}else{
	innerhtml("#navigationbar",`
		<div class="navigationbarleft">
			<input type="button" class="navigationbarbutton" id="newalbum" value="新增專輯">
		</div>
		<div class="navigationbarright">
			<input type="button" class="navigationbarbutton" onclick="location.href='index.html'" value="首頁">
			<input type="button" class="navigationbarbutton navigationbarselect" onclick="location.href='album.html'" value="專輯列表">
			<input type="button" class="navigationbarbutton" onclick="location.href='music.html'" value="音樂列表">
			<input type="button" class="navigationbarbutton" id="signout" value="登出">
		</div>
	`)
}

ajax("GET",AJAXURL+"getalbumlist",function(event,data){
	if(data["success"]){
		console.log(data)
	}else{
		alert(ERRORMESSAGE[data["data"]])
	}
},null,[
	["Authorization","Bearer "+weblsget("50nationalmodulea-token")]
])

onclick("#newalbum",function(element,event){
	lightbox(null,"lightbox",function(){
		return ``
	})
})

onclick("#signout",function(element,event){
	ajax("POST",AJAXURL+"signout",function(evennt,data){
		if(data["success"]){
			weblsset("50nationalmodulea-userid",null)
			weblsset("50nationalmodulea-permission",null)
			weblsset("50nationalmodulea-token",null)
			href("index.html")
		}else{
			alert(ERRORMESSAGE[data["data"]])
			weblsset("50nationalmodulea-userid",null)
			weblsset("50nationalmodulea-permission",null)
			weblsset("50nationalmodulea-token",null)
			href("index.html")
		}
	},null,[
		["Authorization","Bearer "+weblsget("50nationalmodulea-token")]
	])
})