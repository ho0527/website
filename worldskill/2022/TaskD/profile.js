docgetid("signout").onclick=function(){
    newajax("POST","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/auth/signout",null,[
        ["Authorization","Bearer "+weblsget("token")]
    ]).onload=function(){
        let data=JSON.parse(this.responseText)
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

newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/users/"+weblsget("username"),null,[
    ["Authorization","Bearer "+weblsget("token")]
]).onload=function(){
    let data=JSON.parse(this.responseText)
    docgetid("navigationbartitle2").innerHTML=`
        (User Profile: ${weblsget("username")})
    `
    newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games").onload=function(){
        let data=JSON.parse(this.responseText)
        newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games?size="+data["totalElements"]).onload=function(){
            let data=JSON.parse(this.responseText)
            let maindata=[]
            for(let i=0;i<data["content"].length;i=i+1){
                if(data["content"][i]["author"]==weblsget("username")){
                    let pictureurl="material/picture/default.jpg"
        
                    // 不會接image
                    // if(isset(data["content"][i]["thumbnail"])){
                    //     pictureurl="https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/storage/app"+data["content"][i]["thumbnail"]+""
                    // }

                    // game div
                    docgetid("profilegamediv").innerHTML=`
                        <div class="game profilegame grid" id="${data["content"][i]["slug"]}">
                            <div class="title">${data["content"][i]["title"]}</div>
                            <div class="description">${data["content"][i]["description"]}</div>
                            <div class="scorecount">score submit: ${data["content"][i]["scoreCount"]}</div>
                            <div class="imagediv"><img src="${pictureurl}" class="image"></div>
                        </div>
                        ${docgetid("profilegamediv").innerHTML}
                    `
                }
            }

            if(docgetid("profilegamediv").innerHTML!=""){
                docgetid("profilegamediv").innerHTML=`
                    <div class="profiletitle">Authored Games</div>
                    ${docgetid("profilegamediv").innerHTML}
                `
            }

            docgetall(".game").forEach(function(event){
                event.onclick=function(){
                    location.href="game.html?game="+event.id
                }
            })
        }
    }
}

docgetid("usernamelink").innerHTML=`
    ${weblsget("username")} profile
`

if(!isset(weblsget("token"))){
    location.href="signinsignup.html?key=signin"
}