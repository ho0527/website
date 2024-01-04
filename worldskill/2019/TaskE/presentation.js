let data={}
let maininnerhtml=``
let rootdata

// 初始化
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
rootdata=data["data"][0]

for(let i=0;i<data["data"].length;i=i+1){
    maininnerhtml=`
        ${maininnerhtml}
    `
}

docgetid("main").innerHTML=`
    <div class="stinput presentationcontent disabled">
        <textarea disabled>${rootdata["content"]}</textarea>
    </div>
    <div class="presentationbuttondiv" id="buttondiv">
        <input type="button" class="stbutton fill light" value="123456">
    </div>
`

// 函式庫初始化
startmacossection()