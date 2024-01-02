let data={}
let maininnerhtml=``

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

for(let i=0;i<data["data"].length;i=i+1){
    maininnerhtml=`
        ${maininnerhtml}
    `
}
docgetid("main").innerHTML=maininnerhtml

// 函式庫初始化
startmacossection()