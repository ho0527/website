if(!isset(weblsget("worldskill2022MDgame"))){
    location.href="indx.html"
}

newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games/"+weblsget("worldskill2022MDgame")).onload=function(){
    let data=JSON.parse(this.responseText)
    docgetid("navigationbartitle2").innerHTML=`
        (Game: ${data["title"]})
    `
    console.log(data)
}

// show signin/signup || signout button
if(isset(weblsget("token"))){
    docgetid("navigationbarright").innerHTML=`
        <a href="profile.html" class="a navigationbara">${weblsget("username")} profile</a>
        <input type="button" class="navigationbarbutton" id="signout" value="Sign Out">
    `

    // logout
    docgetid("signout").onclick=function(){
        let ajax=newajax("POST","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/auth/signout",null,[
            ["Authorization","Bearer "+weblsget("token")]
        ])
        ajax.onload=function(){
            let data=JSON.parse(ajax.responseText)
            console.log(data)
            if(data["status"]=="success"){
                weblsset("token",null)
                weblsset("username",null)
                location.href="signout.html"
            }else{
                alert(data["message"])
            }
        }
    }
}else{
    docgetid("navigationbarright").innerHTML=`
        <input type="button" class="navigationbarbutton" onclick="location.href='signinsignup.html?key=signup'" value="Sign Up">
        <input type="button" class="navigationbarbutton" onclick="location.href='signinsignup.html?key=signin'" value="Sign In">
    `
}