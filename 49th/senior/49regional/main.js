function main(request){
    docgetid("main").innerHTML=``

    newajax("GET","api.php?product=").onload=function(){
        let productdata=JSON.parse(this.responseText)

        if(productdata["success"]){
            let product=productdata["data"]
            let url="api.php?game="
            if(request){
                url=url+"&search=&"+request
            }
            newajax("GET",url).onload=function(){
                let data=JSON.parse(this.responseText)
                let maindata=""
                let edit=""

                if(data["success"]){
                    for(let i=0;i<data["data"].length;i=i+1){
                        let projectid
                        for(let j=0;j<product.length;j=j+1){
                            if(data["data"][i]["version"]==product[j][0]){
                                projectid=j
                                break
                            }
                        }

                        if(weblsget("49regionalpermission")=="管理者"){
                            edit=`
                                <input type="button" class="pin" data-id="${data["data"][i]["id"]}" value="訂選">
                                <input type="button" class="edit" data-id="${data["data"][i]["id"]}" value="修改">
                            `
                        }
                        if(i%2==0){
                            maindata=`
                                ${maindata}
                                <div class="productdiv">
                                    <div class="productleft product macossectiondivy grid">
                                        ${edit}
                                        <div class="id">id: ${data["data"][i]["id"]}</div>
                                        <div class="date" style="${product[projectid][3]}">競賽日期: ${data["data"][i]["date"]}</div>
                                        <div class="description" style="${product[projectid][4]}">電競活動簡介: <br>${data["data"][i]["description"]}</div>
                                        <div class="link" style="${product[projectid][5]}">活動新聞連結: ${data["data"][i]["link"]}</div>
                                        <div class="signupbutton mainsignupbutton" data-id="${data["data"][i]["id"]}" style="${product[projectid][6]}">${data["data"][i]["signupbutton"]}</div>
                                        <div class="name" style="${product[projectid][2]}">電競名稱: ${data["data"][i]["name"]}</div>
                                        <div class="picture" style="${product[projectid][1]}"><img src="${data["data"][i]["picture"]}" class="image" draggable="false"></div>
                                    </div>
                            `
                        }else{
                            maindata=`
                                ${maindata}
                                    <div class="productright product macossectiondivy grid">
                                        ${edit}
                                        <div class="id">id: ${data["data"][i]["id"]}</div>
                                        <div class="date" style="${product[projectid][3]}">競賽日期: ${data["data"][i]["date"]}</div>
                                        <div class="description" style="${product[projectid][4]}">電競活動簡介: <br>${data["data"][i]["description"]}</div>
                                        <div class="link" style="${product[projectid][5]}">活動新聞連結: ${data["data"][i]["link"]}</div>
                                        <div class="signupbutton mainsignupbutton" data-id="${data["data"][i]["id"]}" style="${product[projectid][6]}">${data["data"][i]["signupbutton"]}</div>
                                        <div class="name" style="${product[projectid][2]}">電競名稱: ${data["data"][i]["name"]}</div>
                                        <div class="picture" style="${product[projectid][1]}"><img src="${data["data"][i]["picture"]}" class="image"></div>
                                    </div>
                                </div>
                            `
                        }
                        if(i%2==0&&data["data"].length-1==i){
                            maindata=`
                                ${maindata}
                                </div>
                            `
                        }
                    }

                    docgetid("main").innerHTML=maindata

                    docgetall(".signupbutton").forEach(function(event){
                        event.onclick=function(){
                            location.href="game.html?game="+event.dataset.id
                        }
                    })
                }
            }
        }
    }
}

if(weblsget("49regionalpermission")=="管理者"){
    docgetid("navigationbar").innerHTML=`
        <div class="maintitle">電子競技網站管理</div>
        <div class="navigationbarbuttondiv">
            <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='main.html'" value="首頁">
            <input type="button" class="navigationbarbutton" onclick="location.href='productindex.html'" value="電競活動管理精靈">
            <input type="button" class="navigationbarbutton" onclick="location.href='admin.php'" value="會員管理">
            <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
        </div>
    `
}else{
    docgetid("navigationbar").innerHTML=`
        <div class="maintitle">電子競技網站管理</div>
        <div class="navigationbarbuttondiv">
            <input type="button" class="navigationbarbutton selectbutton" onclick="location.href='main.html'" value="首頁">
            <input type="button" class="navigationbarbutton" onclick="location.href='api.php?logout='" value="登出">
        </div>
    `
}

main()

docgetid("submit").onclick=function(){
    let start=docgetid("start").value
    let end=docgetid("end").value
    let keyword=docgetid("keyword").value

    if(!start){
        start="00000-01-01"
    }

    if(!end){
        end="99999-12-31"
    }

    main(`start=${start}&end=${end}&keyword=${keyword}`)
}

docgetall(".searchinput").forEach(function(event){
    event.onkeydown=function(ketdownevent){
        if(ketdownevent.key=="Enter"){
            docgetid("submit").click()
        }
    }
})

docgetall(".pin").forEach(function(event){
    event.onkeydown=function(){
        location.href=""
    }
})

docgetall(".edit").forEach(function(event){
    event.onclick=function(){
        location.href=""
    }
})