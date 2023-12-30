let midx=window.innerWidth/2-60
let midy=window.innerHeight/2-60
let data={}
let count=1

// 初始化函式
function main(){
    let maininnerhtml=``

    if(!weblsget("worldskill2022ME")){
        weblsset("worldskill2022ME",JSON.stringify({
            "data": [
                {
                    "id": 0,
                    "position": {
                        "top": midy,
                        "left": midx
                    },
                    "content": "",
                    "1": {
                        "id": "",
                        "title": "",
                        "position": {
                            "top": 0,
                            "left": 0
                        }
                    },
                    "2": {
                        "id": "",
                        "title": "",
                        "position": {
                            "top": 0,
                            "left": 0
                        }
                    },
                    "3": {
                        "id": "",
                        "title": "",
                        "position": {
                            "top": 0,
                            "left": 0
                        }
                    },
                    "4": {
                        "id": "",
                        "title": "",
                        "position": {
                            "top": 0,
                            "left": 0
                        }
                    }
                }
            ]
        }))
    }
    data=JSON.parse(weblsget("worldskill2022ME"))

    for(let i=0;i<data["data"].length;i=i+1){
        if(data["data"][i]){
            maininnerhtml=`
                ${maininnerhtml}
                <div class="elementdiv" id="${i}" style="position: absolute;top: ${data["data"][i]["position"]["top"]}px;left: ${data["data"][i]["position"]["left"]}px;">
                    <div class="elementposition">
                        <div class="element"></div>
                    </div>
                </div>
            `

            for(let j=1;j<=4;j=j+1){
                if(data["data"][i][j]["title"]!=""){
                    let elementdistance=(((data["data"][i]["position"]["top"]-data["data"][i][j]["position"]["top"])**2)+((data["data"][i]["position"]["left"]-data["data"][i][j]["position"]["left"])**2))**(1/2)
                    maininnerhtml=`
                        ${maininnerhtml}
                        <div class="line" id="${i}" style="
                            position: absolute;top: ${data["data"][i]["position"]["top"]+110}px;left: ${data["data"][i]["position"]["left"]+60}px;
                            height: ${elementdistance-90}px;
                        "></div>
                    `
                }
            }
        }
    }
    docgetid("main").innerHTML=maininnerhtml
    
    count=data["data"].length

    docgetall(".elementdiv").forEach(function(event){
        // hover時顯示
        event.onmouseover=function(){
            event.querySelectorAll(".element")[0].innerHTML=`
                <div class="elementposition2">
                    <div class="element1" id="element1"><div class="element1text">1</div></div>
                    <div class="element2" id="element2"><div class="element2text">2</div></div>
                    <div class="element3" id="element3"><div class="element3text">3</div></div>
                    <div class="element4" id="element4"><div class="element4text">4</div></div>
                    <input type="button" class="elementedit" id="edit" value="E">
                    <input type="button" class="elementdelete" id="delete" value="X">
                </div>
            `
    
            // 各元素創建 START
            docgetid("element1").onmousedown=function(){
                newelement(event.id,"1")
            }
    
            docgetid("element2").onmousedown=function(){
                newelement(event.id,"2")
            }
    
            docgetid("element3").onmousedown=function(){
                newelement(event.id,"3")
            }
    
            docgetid("element4").onmousedown=function(){
                newelement(event.id,"4")
            }
    
            docgetid("edit").onmousedown=function(){
                lightbox(null,"lightbox",function(){
                    return `
                        <div class="close" id="close">X</div>
                        <div class="stinput light">
                            <textarea class="edittextarea" id="description" placeholder="pls type word that need to show">${data["data"][event.id]["content"]}</textarea>
                        </div>
                        <div class="stinput inputmargin light">
                            <input class="editinput" id="relationtitle1" placeholder="relation 1" value="${data["data"][event.id]["1"]["title"]}">
                        </div>
                        <div class="stinput inputmargin light">
                            <input class="editinput" id="relationtitle2" placeholder="relation 2" value="${data["data"][event.id]["2"]["title"]}">
                        </div>
                        <div class="stinput inputmargin light">
                            <input class="editinput" id="relationtitle3" placeholder="relation 3" value="${data["data"][event.id]["3"]["title"]}">
                        </div>
                        <div class="stinput inputmargin light">
                            <input class="editinput" id="relationtitle3" placeholder="relation 4" value="${data["data"][event.id]["4"]["title"]}">
                        </div>
                    `
                },"close",true,"none")
                docgetid("description").onchange=function(){
                    data["data"][event.id]["content"]=this.value
                }

                docgetid("relationtitle1").onchange=function(){
                    data["data"][event.id]["1"]["title"]=this.value
                }

                docgetid("relationtitle2").onchange=function(){
                    data["data"][event.id]["2"]["title"]=this.value
                }

                docgetid("relationtitle3").onchange=function(){
                    data["data"][event.id]["3"]["title"]=this.value
                }

                docgetid("relationtitle3").onchange=function(){
                    data["data"][event.id]["3"]["title"]=this.value
                }

                event.querySelectorAll(".element")[0].innerHTML=``
                weblsset("worldskill2022ME",JSON.stringify(data))
                main()
            }
    
            docgetid("delete").onmousedown=function(){
                for(let i=0;i<data["data"].length;i=i+1){
                    if(data["data"][i]){
                        for(let j=1;j<=4;j=j+1){
                            if(data["data"][i][j]["id"]==event.id){
                                data["data"][i][j]={
                                    "id": "",
                                    "title": "",
                                    "position": {
                                        "top": 0,
                                        "left": 0
                                    }
                                }
                            }
                        }
                    }
                }
                delete data["data"][event.id]
                docgetid(event.id).remove()
                weblsset("worldskill2022ME",JSON.stringify(data))
                main()
            }
            // 各元素創建 END
        }
    
        // 離開時清空
        event.onmouseleave=function(){
            event.querySelectorAll(".element")[0].innerHTML=``
        }
    })
    
}

// 新元素函式
function newelement(id,key){
    let topchange=0
    let leftchange=0
    let thisdata=data["data"][id]

    if(thisdata["1"]["title"]==""&&key=="1"){
        topchange=-250
    }else if(thisdata["2"]["title"]==""&&key=="2"){
        leftchange=250
    }else if(thisdata["3"]["title"]==""&&key=="3"){
        topchange=250
    }else if(thisdata["4"]["title"]==""&&key=="4"){
        leftchange=-250
    }

    if(topchange!=0||leftchange!=0){
        docgetid("main").innerHTML=`
            ${docgetid("main").innerHTML}
            <div class="elementdiv" id="${count}" style="position: absolute;top: ${thisdata["position"]["top"]+topchange}px;left: ${thisdata["position"]["left"]+leftchange}px;">
                <div class="elementposition">
                    <div class="element"></div>
                </div>
            </div>
    
            <div class="line"></div>
        `
    
        data["data"].push({
            "id": count,
            "position": {
                "top": thisdata["position"]["top"]+topchange,
                "left": thisdata["position"]["left"]+leftchange
            },
            "content": "",
            "1": {
                "id": "",
                "title": "",
                "position": {
                    "top": 0,
                    "left": 0
                }
            },
            "2": {
                "id": "",
                "title": "",
                "position": {
                    "top": 0,
                    "left": 0
                }
            },
            "3": {
                "id": "",
                "title": "",
                "position": {
                    "top": 0,
                    "left": 0
                }
            },
            "4": {
                "id": "",
                "title": "",
                "position": {
                    "top": 0,
                    "left": 0
                }
            }
        })
    
        if(key=="1"){
            data["data"][data["data"].length-1]["3"]["id"]=id
            data["data"][data["data"].length-1]["3"]["title"]="default relation 3"
            data["data"][data["data"].length-1]["3"]["position"]["top"]=thisdata["position"]["top"]
            data["data"][data["data"].length-1]["3"]["position"]["left"]=thisdata["position"]["left"]
        }else if(key=="2"){
            data["data"][data["data"].length-1]["4"]["id"]=id
            data["data"][data["data"].length-1]["4"]["title"]="default relation 4"
            data["data"][data["data"].length-1]["4"]["position"]["top"]=thisdata["position"]["top"]
            data["data"][data["data"].length-1]["4"]["position"]["left"]=thisdata["position"]["left"]
        }else if(key=="3"){
            data["data"][data["data"].length-1]["1"]["id"]=id
            data["data"][data["data"].length-1]["1"]["title"]="default relation 1"
            data["data"][data["data"].length-1]["1"]["position"]["top"]=thisdata["position"]["top"]
            data["data"][data["data"].length-1]["1"]["position"]["left"]=thisdata["position"]["left"]
        }else if(key=="4"){
            data["data"][data["data"].length-1]["2"]["id"]=id
            data["data"][data["data"].length-1]["2"]["title"]="default relation 2"
            data["data"][data["data"].length-1]["2"]["position"]["top"]=thisdata["position"]["top"]
            data["data"][data["data"].length-1]["2"]["position"]["left"]=thisdata["position"]["left"]
        }

        thisdata[key]["title"]="default relation "+key
        thisdata[key]["id"]=count
        thisdata[key]["position"]["top"]=thisdata["position"]["top"]+topchange
        thisdata[key]["position"]["left"]=thisdata["position"]["left"]+leftchange
    
        weblsset("worldskill2022ME",JSON.stringify(data))
        main()
    }
}

main()

// 函式庫初始化
startmacossection()