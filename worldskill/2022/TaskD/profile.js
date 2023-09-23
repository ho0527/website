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

let ajax2=newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/users/"+weblsget("username"),null,[
    ["Authorization","Bearer "+weblsget("token")]
])

ajax2.onload=function(){
    let data=JSON.parse(ajax2.responseText)
    console.log(data)
    docgetid("username").innerHTML=`
        ${weblsget("username")}
    `
    if(data["status"]=="success"){
    }else{
    }
}

docgetid("usernamelink").innerHTML=`
    ${weblsget("username")} profile
`

if(!isset(weblsget("token"))){
    location.href="signinsignup.html?key=signin"
}