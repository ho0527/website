let page=0
let size=10
let sortby="title"
let sorttype="asc"

function main(){
    newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games?page="+page+"&size="+size+"&sortBy="+sortby+"&sortDir="+sorttype).onload=function(){
        let data=JSON.parse(this.responseText)
        console.log(data)
        if(data["status"]!="invalid"){
            let total=data["totalElements"]
            for(let i=0;i<data["content"].length;i=i+1){
                let pictureurl="material/picture/default.jpg"

                // 不會接image
                // if(isset(data["content"][i]["thumbnail"])){
                //     pictureurl="https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/storage/app"+data["content"][i]["thumbnail"]+""
                // }

                // game div
                docgetid("main").innerHTML=`
                    ${docgetid("main").innerHTML}
                    <div class="game grid" data-id="${data["content"][i]["slug"]}">
                        <div class="title">${data["content"][i]["title"]}</div>
                        <div class="author">by ${data["content"][i]["author"]}</div>
                        <div class="description">${data["content"][i]["description"]}</div>
                        <div class="scorecount">score submit: ${data["content"][i]["scoreCount"]}</div>
                        <div class="imagediv"><img src="${pictureurl}" class="image"></div>
                    </div>
                `
            }
            docgetid("gamecount").innerHTML=`${total}`

            docgetall(".game").forEach(function(event){
                event.onclick=function(){
                    weblsset("worldskill2022MDgame",event.dataset.id)
                    location.href="game.html"
                }
            })
        }else{
            alert("get an error in request!")
            location.reload()
        }
    }
    page=page+1
}

function clearselectbutton(){
    docgetall(".indexfunctionbutton").forEach(function(event){
        event.classList.remove("bluebuttonselect")
    })
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

if(!isset(weblsget("worldskill2022MDindexsortby"))){
    weblsset("worldskill2022MDindexsortby","title")
}

if(!isset(weblsget("worldskill2022MDindexsorttype"))){
    weblsset("worldskill2022MDindexsorttype","asc")
}

clearselectbutton()
docgetid(weblsget("worldskill2022MDindexsortby")).classList.add("bluebuttonselect")
docgetid(weblsget("worldskill2022MDindexsorttype")).classList.add("bluebuttonselect")
sortby=weblsget("worldskill2022MDindexsortby")
sorttype=weblsget("worldskill2022MDindexsorttype")


docgetall(".indexfunctionbutton").forEach(function(event){
    event.onclick=function(){
        if(event.id=="asc"||event.id=="desc"){
            weblsset("worldskill2022MDindexsorttype",event.id)
            sorttype=event.id
        }else{
            weblsset("worldskill2022MDindexsortby",event.id)
            sortby=event.id
        }
        clearselectbutton()
        docgetid(weblsget("worldskill2022MDindexsortby")).classList.add("bluebuttonselect")
        docgetid(weblsget("worldskill2022MDindexsorttype")).classList.add("bluebuttonselect")
        docgetid("main").innerHTML=``
        page=page-1
        main()
    }
})


main()

document.onscroll=function(){
    if((window.innerHeight+Math.round(window.scrollY))>=document.body.offsetHeight){
        setTimeout(main,500)
    }
}


startmacossection()