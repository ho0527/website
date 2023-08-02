let difficulty=weblsget("difficulty")
let timemin=0
let timesec=0
let width=innerWidth*0.6
let height=innerHeight*0.85
let nowarray=[] // 現在的狀態
let blocklist=[] // 方塊列表(a~e)
let blockarray=[] //
let temparray // 暫存arr
let blocklength=20 // 方怪長度
let rotatedeg=0 // 旋轉度數(0,90,180,270)
let speed // 移動速度

function block(key){
    let div=doccreate("div")
    div.classList.add("grid")
    div.style.width=(blocklength*4)+"px"
    div.style.height=(blocklength*4)+"px"
    if(key=="a"){
        div.innerHTML=`
            <div class="typea1"></div>
            <div class="typea2"></div>
            <div class="typea3"></div>
            <div class="typea4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,0,0,0],
            [1,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="b"){
        div.innerHTML=`
            <div class="typeb1"></div>
            <div class="typeb2"></div>
            <div class="typeb3"></div>
            <div class="typeb4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,1,0,0],
            [0,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="c"){
        div.innerHTML=`
            <div class="typec1"></div>
            <div class="typec2"></div>
            <div class="typec3"></div>
            <div class="typec4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,0,0,1],
            [0,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="d"){
        div.innerHTML=`
            <div class="typed1"></div>
            <div class="typed2"></div>
            <div class="typed3"></div>
            <div class="typed4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,1,1,0],
            [0,1,1,0],
            [0,0,0,0]
        ]
    }else if(key=="e"){
        div.innerHTML=`
            <div class="typee1"></div>
            <div class="typee2"></div>
            <div class="typee3"></div>
            <div class="typee4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,0,1,1],
            [0,1,1,0],
            [0,0,0,0]
        ]
    }else if(key=="f"){
        div.innerHTML=`
            <div class="typef1"></div>
            <div class="typef2"></div>
            <div class="typef3"></div>
            <div class="typef4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,0,1,0],
            [0,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="g"){
        div.innerHTML=`
            <div class="typeg1"></div>
            <div class="typeg2"></div>
            <div class="typeg3"></div>
            <div class="typeg4"></div>
        `
        blockarray=[
            [0,0,0,0],
            [0,1,1,0],
            [0,0,1,1],
            [0,0,0,0]
        ]
    }else{ conlog("[ERROR]error key","red","15") }
    docappendchild("main",div)
}

function test(key){
    if(key){
        conlog("teststart","green","15")
        block("a")
        block("b")
        block("c")
        block("d")
        block("e")
        block("f")
        block("g")
    }
}

function left(){
}

function right(){
}

function rotate(){
}

function down(){
    speed=0.1
}

function downtobottom(){
}

function share(){
}

function stopstart(){
    if(docgetid("stop").value=="暫停遊戲"){
        document.addEventListener("keydown",function(event){
            if(event.key=="ArrowLeft"){ event.preventDefault() }
            if(event.key=="ArrowRight"){ event.preventDefault() }
            if(event.key=="ArrowUp"){ event.preventDefault() }
            if(event.key=="ArrowDown"){ event.preventDefault() }
            if(event.key==" "){ event.preventDefault() }
        })
        docgetid("stop").value="繼續遊戲"
    }else{
        document.addEventListener("keydown",function(event){
            if(event.key=="ArrowLeft"){ event.preventDefault() }
            if(event.key=="ArrowRight"){ event.preventDefault() }
            if(event.key=="ArrowUp"){ event.preventDefault() }
            if(event.key=="ArrowDown"){ event.preventDefault() }
            if(event.key==" "){ event.preventDefault() }
        })
        docgetid("stop").value="暫停遊戲"
    }
}


function cancel(){
    stop()
    if(confirm("是否要放棄遊戲?")){
        location.href="index.html"
    }else{
        start()
    }
}

for(let i=0;i<17;i=i+1){
    nowarray.push([])
    for(let j=0;j<10;j=j+1){
        nowarray[i].push(0)
    }
}
temparray=nowarray

docgetid("main").style.width=width+"px"
docgetid("main").style.height=height+"px"
docgetid("difficulty").innerHTML=difficulty

setInterval(function(){
    timesec=timesec+1
    if(timesec==60){
        timemin=timemin+1
        timesec=0
    }
    let min=timemin.toString()
    let sec=timesec.toString()
    if(timesec<10){
        sec="0"+sec
    }
    if(timemin<10){
        min="0"+min
    }
    docgetid("time").innerHTML=`
        時間: ${min}:${sec}
    `
},1000)

document.addEventListener("keydown",function(event){
    if(event.key=="Escape"){ event.preventDefault();cancel() }
    if(event.key=="ArrowLeft"){ event.preventDefault();left() }
    if(event.key=="ArrowRight"){ event.preventDefault();right() }
    if(event.key=="ArrowUp"){ event.preventDefault();rotate() }
    if(event.key=="ArrowDown"){ event.preventDefault();down() }
    if(event.key==" "){ event.preventDefault();downtobottom() }
    if(event.key=="s"){ event.preventDefault();share() }
    if(event.key=="p"){ event.preventDefault();stopstart() }
})

if(difficulty=="normal"){
    speed=1
}else{
    speed=0.25
}

// 顯示下一個方塊
docgetid("shownext")

// 分享
docgetid("share").onclick=function(){ share() }

// 暫停/開始遊戲
docgetid("stop").onclick=function(){ stopstart() }

// 放棄遊戲
docgetid("cancel").onclick=function(){ cancel() }

test(false)
startmacossection()