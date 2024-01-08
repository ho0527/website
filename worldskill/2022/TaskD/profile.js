docgetid("signout").onclick=function(){
    oldajax("POST","/backend/worldskill2022modulec/api/v1/auth/signout",null,[
        ["Authorization","Bearer "+weblsget("worldskill2022MDtoken")]
    ]).onload=function(){
        let data=JSON.parse(this.responseText)
        console.log(data)
        if(data["status"]=="success"){
            weblsset("worldskill2022MDtoken",null)
            weblsset("worldskill2022MDusername",null)
            location.href="signout.html"
        }else{
            alert(data["message"])
        }
    }
}

oldajax("GET","/backend/worldskill2022modulec/api/v1/users/"+weblsget("worldskill2022MDusername"),null,[
    ["Authorization","Bearer "+weblsget("worldskill2022MDtoken")]
]).onload=function(){
    let data=JSON.parse(this.responseText)
    // navbar
    docgetid("navigationbartitle2").innerHTML=`
        (User Profile: ${weblsget("worldskill2022MDusername")})
    `

    // 製作的遊戲
    oldajax("GET","/backend/worldskill2022modulec/api/v1/games").onload=function(){
        let data=JSON.parse(this.responseText)
        oldajax("GET","/backend/worldskill2022modulec/api/v1/games?size="+data["totalElements"]).onload=function(){
            let data=JSON.parse(this.responseText)
            for(let i=0;i<data["content"].length;i=i+1){
                if(data["content"][i]["author"]==weblsget("worldskill2022MDusername")){
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

    console.log(data["highscores"])
}

docgetid("usernamelink").innerHTML=`
    ${weblsget("worldskill2022MDusername")} profile
`

if(!isset(weblsget("worldskill2022MDtoken"))){
    location.href="signinsignup.html?key=signin"
}