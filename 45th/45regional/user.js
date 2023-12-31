let workbox=document.getElementsByClassName("work-box")
let button=document.getElementsByClassName("todobut")
let updownbut=document.getElementById("updownbut")
let down=false
let move=false
//訂定變數


for(let i=0;i<button.length;i=i+1){
    button[i].disabled=true//讓每個button都是disabled
}

for(let i=0;i<workbox.length;i=i+1){//做總workbox數
    workbox[i].addEventListener('click',function(){
        down=false
        move=false
        let buttons=this.querySelectorAll(".todobut")//選擇該todobut
        for(let i=0;i<button.length;i=i+1){
            button[i].disabled=true//將其他todobut disabled
        }
        for(let i=0;i<buttons.length;i=i+1){
            buttons[i].disabled=false//將該todobut disabled false
            setTimeout(function(){
                for(let j=0;j<button.length;j=j+1){
                    button[j].disabled=true //等待5秒設為true
                }
            },5000)
        }
        console.log(workbox[i]);
    })
}

// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mousedown",function(){
//         down=true
//     })
// })

// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mousemove",function(event){
//         if(down==true){
//             move=true
//         }
//     })
// })

// document.querySelectorAll(".todo").forEach(function(element){
//     element.addEventListener("mouseup",function(){
//         if(move==true){
//             location.href="useradd.php"
//         }
//     })
// })

let upusertablediv=document.querySelectorAll(".upusertablediv")
let downusertablediv=document.querySelectorAll(".downusertablediv")
let boxid
var boxs
document.querySelectorAll('.work-box').forEach(function(element){
    element.addEventListener("mousedown",function(){
        boxid=this.id//取得id
        down=false
        move=false
        boxs=document.querySelectorAll("#"+boxid)
        boxs.forEach(function(box){
            box.addEventListener("dragstart",dragstart)
        })
    })
})

upusertablediv.forEach(function(up){
    up.addEventListener("dragenter",dragenter)
    up.addEventListener("dragover",dragover)
    up.addEventListener("dragleave",dragleave)
    up.addEventListener("drop",updrop)
})

downusertablediv.forEach(function(down){
    down.addEventListener("dragenter",dragenter)
    down.addEventListener("dragover",dragover)
    down.addEventListener("dragleave",dragleave)
    down.addEventListener("drop",downdrop)
})

function dragstart(e){
    e.dataTransfer.setData("text",boxid)
}

function dragenter(e){
    e.preventDefault()
    e.target.classList.add("drag-over")
}

function dragover(e){
    e.preventDefault()
    e.target.classList.add("drag-over")
}

function dragleave(e){
    e.preventDefault()
    e.target.classList.remove("drag-over")
}

function updrop(e){
    e.target.classList.remove("drag-over")
    let id=e.dataTransfer.getData("text")
    let box=document.getElementById(id)
    e.target.appendChild(box)
    box.style.top="0px"
    box.style.left="10px"
    let boxheight=box.style.height
    let time=parseInt(boxheight)/30
    let divtarget=parseFloat(e.target.id)
    let starthr=Math.floor(divtarget)
    let startmin=((divtarget-starthr)*60).toFixed(0)
    if(starthr<10){
        starthr="0"+starthr
    }
    if(startmin<10){
        startmin="0"+startmin
    }
    let starttime=starthr+":"+startmin
    let endhr=parseInt(starthr)+parseInt(time)
    let decimalonly=time%1*10
    let endmin=parseInt(startmin)+((decimalonly/5)*30)
    if(endmin<10){
        endmin="0"+endmin
    }
    if(endmin==60){
        endmin="00"
        endhr=endhr+1
    }
    if(endhr<10){
        endhr="0"+endhr
    }
    let endtime=endhr+":"+endmin
    document.getElementById(boxid+"starttime").innerHTML=`開始時間: ${starttime}`
    document.getElementById(boxid+"endtime").innerHTML=`結束時間: ${endtime}`
}


function downdrop(e){
    e.preventDefault()
    e.target.classList.remove("drag-over")
    const id=e.dataTransfer.getData("text")
    const box=document.getElementById(id)
    e.target.appendChild(box)
    box.style.top="0px"
    box.style.left="10px"
    let height=box.style.height
    let time=parseInt(height)/30
    let divtarget=parseFloat(e.target.id)
    let starthr=Math.floor(divtarget)
    let startmin=((divtarget-starthr)*60).toFixed(0)
    if(starthr<10){
        starthr="0"+starthr
    }
    if(startmin<10){
        startmin="0"+startmin
    }
    let starttime=starthr+":"+startmin
    let endhr=parseInt(starthr)-parseInt(time)
    let decimalonly=time%1*10
    let endmin=parseInt(startmin)+((decimalonly/5)*30)
    if(endmin<10){
        endmin="0"+endmin
    }
    if(endmin==60){
        endmin="00"
    }
    if(endhr<10){
        endhr="0"+endhr
    }
    let endtime=endhr+":"+endmin
    document.getElementById(boxid+"starttime").innerHTML=`開始時間: ${endtime}`
    document.getElementById(boxid+"endtime").innerHTML=`結束時間: ${starttime}`
}

// -------------------------
let positiontype="top"
let maintableinnerhtml=`
    <tr>
        <td class="todotabletime">時間</td>
        <td>工作計畫</td>
    </tr>
`

if(!weblsget("45regionaltodosorttype")){
    weblsset("45regionaltodosorttype","ASC")
}

if(weblsget("45regionaltodosorttype")=="ASC"){
    for(let i=0;i<=22;i=i+2){
        maintableinnerhtml=`
            ${maintableinnerhtml}
            <tr>
                <td class="todotabletime">${String(i).padStart(2,"0")}~${String(i+2).padStart(2,"0")}</td>
                <td class="todotablecontent"></td>
            </tr>
        `
    }
    docgetid("updownbutton").value="升冪"
}else{
    for(let i=22;i>=0;i=i-2){
        maintableinnerhtml=`
            ${maintableinnerhtml}
            <tr>
                <td class="todotabletime">${String(i+2).padStart(2,"0")}~${String(i).padStart(2,"0")}</td>
                <td class="todotablecontent"></td>
            </tr>
        `
    }
    docgetid("updownbutton").value="降冪"
    positiontype="bottom"
}

docgetid("maintable").innerHTML=maintableinnerhtml

docgetid("updownbutton").onclick=function(){
    if(weblsget("45regionaltodosorttype")=="ASC"){
        weblsset("45regionaltodosorttype","DESC")
    }else{
        weblsset("45regionaltodosorttype","ASC")
    }
    location.reload()
}

docgetid("logout").onclick=function(){
    ajax("GET","/backend/45regional/logout/"+weblsget("45regionaluserid"),function(){
        let data=JSON.parse(this.responseText)

        if(data["success"]){
            alert("登出成功")
            weblsset("45regionaluserid",null)
            weblsset("45regionalpermission",null)
            weblsset("45regionalsortnumber",null)
            weblsset("45regionalsortusername",null)
            weblsset("45regionalsortname",null)
            location.href="index.html"
        }
    })
}

// 讀取(初始化)各工作項目
ajax("GET","/backend/45regional/gettodolist",function(event,data){
    if(data["success"]){
        let row=data["data"]
        let maintableinnerhtml=``
        for(let i=0;i<row.length;i=i+1){
            let starthr=parseInt(row[i][2])
            let endhr=parseInt(row[i][3])

            maintableinnerhtml=`
                ${maintableinnerhtml}
                <div class="todoblockdiv macossectiondivy" id="${row[i][0]}" style="position: absolute;${positiontype}: ${40+30*(starthr)}px;left: 110px;">
                    <div class="todoblock" style="height: ${30*(endhr-starthr)}px">
                        <img src="icon/close.svg" class="tododeleteicon" data-id="${row[i][0]}">
                        <img src="icon/edit.svg" class="todoediticon" data-id="${row[i][0]}">
                        <div class="todoblocktitle">工作名稱: ${row[i][1]}</div>
                        <div class="todoblocktime">執行時間: ${String(starthr).padStart(2,"0")}:00~${String(endhr).padStart(2,"0")}:00</div>
                        <div class="todoblocktime">處理情形: ${row[i][4]}</div>
                        <div class="todoblocktime">優先情形: ${row[i][5]}</div>
                    </div>
                </div>
            `
        }
        docgetid("maintable").innerHTML=`
            ${docgetid("maintable").innerHTML}
            ${maintableinnerhtml}
        `

        // 各事件執行
        docgetall(".todoblock").forEach(function(event){
            event.onmouseover=function(){}
        })

        docgetall(".todoediticon").forEach(function(event){
            event.onclick=function(){}
        })

        docgetall(".tododeleteicon").forEach(function(event){
            event.onclick=function(){
                if(confirm("確定刪除?")){
                    ajax("DELETE","/backend/45regional/deletetodo/"+event.dataset.id,function(event,data){
                        if(data["success"]){
                            alert("刪除成功")
                            location.reload()
                        }else{
                            alert("刪除失敗: "+data["data"])
                        }
                    })
                }
            }
        })
    }else{
        alert(data["data"])
    }
})


// 創建新工作
docgetid("newtodo").onclick=function(){
    lightbox(null,"lightbox",function(){
        let timeoptionlist=``

        for(let i=0;i<=24;i=i+1){
            timeoptionlist=`
                ${timeoptionlist}
                <option value="${String(i).padStart(2,"0")}">${String(i).padStart(2,"0")}:00</option>
            `
        }

        return `
            <div class="textcenter userlightbox">
                <div class="newtodotitle">新增工作</div>
                <div class="inputmargin textleft">
                    <div class="sttextlabel light">工作標題:</div>
                    <div class="stinput underline">
                        <input type="text" id="title" value="work">
                    </div>
                </div>
                <div class="stselect fill colorwhite inputmargin">
                    <select class="textcenter" id="starthour">
                        <option value="na">開始時間</option>
                        ${timeoptionlist}
                    </select>
                </div><br>
                <div class="stselect fill colorwhite inputmargin">
                    <select class="textcenter" id="endhour">
                        <option value="na">結束時間</option>
                        ${timeoptionlist}
                    </select>
                </div><br>
                <div class="flex inputmargin">
                    <div class="box">
                        處理情形:
                        <div class="stselect solid">
                            <select class="textcenter" id="deal">
                                <option value="未處理">未處理</option>
                                <option value="處理中">處理中</option>
                                <option value="已完成">已完成</option>
                            </select>
                        </div>
                    </div>
                    <div class="box">
                        類別:
                        <div class="stselect solid">
                            <select class="textcenter" id="priority">
                                <option value="普通">普通</option>
                                <option value="速件">速件</option>
                                <option value="最速件">最速件</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="stinput inputmargin">
                    <textarea class="todotextarea" id="description" placeholder="詳細敘述工作內容"></textarea>
                </div>
                <input type="button" class="stbutton light" id="close" value="取消">
                <input type="button" class="stbutton light" id="submit" value="完成">
            </div>
        `
    },"close",true,"none")

    docgetid("submit").onclick=function(){
        if(docgetid("starthour").value!="na"&&docgetid("endhour").value!="na"){
            if(parseInt(docgetid("starthour").value)<parseInt(docgetid("endhour").value)){
                ajax("POST","/backend/45regional/newtodo",function(event){
                    let data=JSON.parse(event.responseText)
                    if(data["success"]){
                        alert("新增成功")
                        location.reload()
                    }else{
                        alert(data["data"])
                    }
                },JSON.stringify({
                    "title": docgetid("title").value,
                    "starthour": docgetid("starthour").value,
                    "endhour": docgetid("endhour").value,
                    "deal": docgetid("deal").value,
                    "priority": docgetid("priority").value,
                    "description": docgetid("description").value
                }))
            }else{
                alert("結束時間不可大於開始時間!")
            }
        }else{
            alert("請選擇時間!")
        }
    }
}

startmacossection()