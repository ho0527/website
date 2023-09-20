docgetid("signout").onclick=function(){
    let ajax=newajax("POST","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/auth/signout",null,[
        ["Authorization","Bearer "+weblsget("token")]
    ])
    ajax.onload=function(){
        let data=JSON.parse(ajax.responseText)
        console.log(data)
        if(data["status"]=="success"){
            weblsset("token",null)
            location.href="signout.html"
        }else{
            alert(data["message"])
        }
    }
}