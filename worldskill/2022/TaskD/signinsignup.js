let key=location.href.split("?key=")[1]

if(key=="signin"){
    docgetid("navigationbartitle2").innerHTML=`(Sign In)`
}else if(key=="signup"){
    docgetid("navigationbartitle2").innerHTML=`(Sign Up)`
}else{ alert("key error");location.href="index.html" }

docgetid(key).classList.add("navigationbarselect")
docgetid("submit").value=`${key}`

docgetid("submit").onclick=function(){
    if(this.value=="signin"){
        let ajax=newajax("POST","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/auth/signin",JSON.stringify({
            "username": docgetid("username").value,
            "password": docgetid("password").value
        }),[
            ["Content-Type", "application/json"]
        ])
        ajax.onload=function(){
            let data=JSON.parse(ajax.responseText)
            console.log(data)
            if(data["status"]!="invalid"){
                alert("Sign in successfully!")
                weblsset("token",data["token"])
                location.href="main.html"
            }else{
                alert(data["message"])
            }
        }
    }else{

    }
}

document.onkeydown=function(event){
    if(event.key=="Enter"){
        docgetid("submit").click()
    }
}
