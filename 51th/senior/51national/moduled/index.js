let maxpage=0
// search data START
let title=""
let minprice=""
let maxprice=""
let room=""
let minage=""
let maxage=""
let sortby=""
let order=""
let page=0
// search data END

// 查詢房屋
function main(){
	innerhtml("#houselist",``,false) // 清空房屋

	ajax("GET",AJAXURL+"/house?title="+title+"&minprice="+minprice+"&maxprice="+maxprice+"&room="+room+"&minage="+minage+"&maxage="+maxage+"&sortby="+sortby+"&order="+order+"&page="+page,function(event,data){
		if(data["success"]){
			let row=data["data"]["houses"]

			maxpage=Math.floor(data["data"]["total_count"]/10)

			// house顯示

			// page控制
			innerhtml("#page",`
				<input type="button" class="buttonghost" id="prev" value="<">
				${page+1}
				<input type="button" class="buttonghost" id="next" value=">">
			`)

			onclick("prev",function(element,event){
				if(0<page){
					page=page-1
					main()
				}
			})

			onclick("next",function(element,event){
				if(page<maxpage){
					page=page+1
					main()
				}
			})
		}else{
			alert(ERRORMESSAGE[data["message"]])
		}
	})
}

if(weblsget("51nationalmoduled-permission")){
	if(weblsget("51nationalmoduled-permission")=="USER"){
		innerhtml("#navigationbar",`
			<div class="navigationbarleft">
				<img src="/website/material/icon/mainicon.png" class="logo">
			</div>
			<div class="navigationbarright">
				<input type="button" class="navigationbarbutton navigationbarselect" onclick="location.reload()" value="首頁">
				<input type="button" class="navigationbarbutton" onclick="location.href=''" value="刊登列表">
				<input type="button" class="navigationbarbutton" id="signout" value="登出">
			</div>
		`,false)
	}else{
		innerhtml("#navigationbar",`
			<div class="navigationbarleft">
				<img src="/website/material/icon/mainicon.png" class="logo">
			</div>
			<div class="navigationbarright">
				<input type="button" class="navigationbarbutton navigationbarselect" onclick="location.reload()" value="首頁">
				<input type="button" class="navigationbarbutton" onclick="location.href=''" value="刊登列表">
				<input type="button" class="navigationbarbutton" onclick="location.href=''" value="申請列表">
				<input type="button" class="navigationbarbutton" onclick="location.href=''" value="精選房屋列表">
				<input type="button" class="navigationbarbutton" id="signout" value="登出">
			</div>
		`,false)
	}
}else{
	innerhtml("#navigationbar",`
		<div class="navigationbarleft">
			<img src="/website/material/icon/mainicon.png" class="logo">
		</div>
		<div class="navigationbarright">
			<input type="button" class="navigationbarbutton navigationbarselect" onclick="location.reload()" value="首頁">
			<input type="button" class="navigationbarbutton" onclick="location.href='signup.html'" value="註冊">
			<input type="button" class="navigationbarbutton" onclick="location.href='signin.html'" value="登入">
		</div>
	`,false)
}

main()

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