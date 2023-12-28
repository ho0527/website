let midx=window.innerWidth/2-60
let midy=window.innerHeight/2-60
let maininnerhtml=``
let data={}

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
                "1": "",
                "2": "",
                "3": "",
                "4": ""
            }
        ]
    }))
}
data=JSON.parse(weblsget("worldskill2022ME"))


// 初始化 START
for(let i=0;i<data["data"].length;i=i+1){
    maininnerhtml=`
        ${maininnerhtml}
        <div class="elementdiv" id="${data["data"][i]["id"]}" style="position: absolute;top: ${data["data"][i]["position"]["top"]}px;left: ${data["data"][i]["position"]["left"]}px;transform: ${data["data"][i]["position"]["transform"]};">
            <div class="elementposition">
                <div class="element"></div>
            </div>
        </div>
    `
}
docgetid("main").innerHTML=maininnerhtml
// 初始化 END

docgetall(".elementdiv").forEach(function(event){
    // hover時顯示
    event.onmouseover=function(){
        event.querySelectorAll(".element")[0].innerHTML=`
            <div class="elementposition2">
                <div class="element1" id="element1"><div class="element1text">1</div></div>
                <div class="element2" id="element2"><div class="element2text">2</div></div>
                <div class="element3" id="element3"><div class="element3text">3</div></div>
                <div class="element4" id="element4"><div class="element4text">4</div></div>
                <input type="button" class="elementedit" id="edit" data-id="${event.id}" value="E">
                <input type="button" class="elementdelete" id="delete" data-id="${event.id}" value="X">
            </div>
        `

        // 各元素創建 START
        docgetid("element1").onclick=function(){

        }

        docgetid("element2").onclick=function(){
            console.log("inininin")
        }

        docgetid("element3").onclick=function(){

        }

        docgetid("element4").onclick=function(){

        }

        docgetid("edit").onclick=function(){

        }

        docgetid("delete").onclick=function(){
            console.log("inininininininin")
            docgetid(this.dataset.id).remove()
            for(let i=0;i<data["data"].length;i=i+1){
                if(data["data"][i]["id"]==this.dataset.id``){
                    delete data["data"][i]
                }
            }
        }
        // 各元素創建 END
    }

    // 離開時清空
    event.onmouseleave=function(){
        event.querySelectorAll(".element")[0].innerHTML=``
    }
})

// 函式庫初始化 TOEND
startmacossection()