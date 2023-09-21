let page=0
let size=10
let sortby="title"
let sortdir="asc"

let ajax=newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games?page="+page+"&size="+size+"&sortBy="+sortby+"&sortDir="+sortdir)

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    if(data["status"]!="invalid"){
        let total=data["totalElements"]
        for(let i=0;i<data["content"].length;i=i+1){
            let pictureurl="material/picture/default.jpg"

            // 不會接image
            // if(isset(data["content"][i]["thumbnail"])){
            //     pictureurl="https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/storage/app"+data["content"][i]["thumbnail"]+""
            // }

            // game div
            let div=doccreate("div")
            div.classList.add("game")
            div.classList.add("grid")
            div.id=(page*10)+i
            div.innerHTML=`
                <div class="title">${data["content"][i]["title"]}</div>
                <div class="author">by ${data["content"][i]["author"]}</div>
                <div class="description">${data["content"][i]["description"]}</div>
                <div class="scorecount">score submit: ${data["content"][i]["scoreCount"]}</div>
                <div class="imagediv"><img src="${pictureurl}" class="image"></div>
            `
            docappendchild("main",div)
        }
        docgetid("gamecount").innerHTML=`${total}`
    }else{
        alert("get an error in request!")
        location.reload()
    }
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

startmacossection()