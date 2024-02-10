if(weblsget("51nationalmoduled-permission")){
    if(weblsget("51nationalmoduled-permission")=="USER"){
        innerhtml("#navigationbar",`
            <div class="navigationbarleft">
                <img src="/website/material/icon/mainicon.png" class="logo">
            </div>
            <div class="navigationbarright">
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
            <input type="button" class="navigationbarbutton" onclick="location.href='signup.html'" value="註冊">
            <input type="button" class="navigationbarbutton" onclick="location.href='signin.html'" value="登入">
        </div>
    `,false)
}

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