let difficulty=weblsget("difficulty")
let timemin=0
let timesec=0
let width=innerWidth*0.6
let height=innerHeight*0.85
let nowarray=[]
let blocklist=[]
let blockarray=[]

function block(key){
    if(key=="a"){
        let div=doccreate("div")
        div.classList.add("typea")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,0,0,0],
            [1,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="b"){
        let div=doccreate("div")
        div.classList.add("typeb")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,1,0,0],
            [0,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="c"){
        let div=doccreate("div")
        div.classList.add("typec")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,0,0,1],
            [0,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="d"){
        let div=doccreate("div")
        div.classList.add("typed")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,1,1,0],
            [0,1,1,0],
            [0,0,0,0]
        ]
    }else if(key=="e"){
        let div=doccreate("div")
        div.classList.add("typee")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,0,1,1],
            [0,1,1,0],
            [0,0,0,0]
        ]
    }else if(key=="f"){
        let div=doccreate("div")
        div.classList.add("typef")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,0,1,0],
            [0,1,1,1],
            [0,0,0,0]
        ]
    }else if(key=="g"){
        let div=doccreate("div")
        div.classList.add("typeg")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [0,1,1,0],
            [0,0,1,1],
            [0,0,0,0]
        ]
    }else{ conlog("[ERROR]error key","red","15") }
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
}

function downtobottom(){
}

function share(){
}

function stop(){
    document.addEventListener("keydown",function(event){
        if(event.key=="ArrowLeft"){ event.preventDefault() }
        if(event.key=="ArrowRight"){ event.preventDefault() }
        if(event.key=="ArrowUp"){ event.preventDefault() }
        if(event.key=="ArrowDown"){ event.preventDefault() }
        if(event.key==" "){ event.preventDefault() }
    })
}

function start(){
    document.addEventListener("keydown",function(event){
        if(event.key=="ArrowLeft"){ event.preventDefault();left() }
        if(event.key=="ArrowRight"){ event.preventDefault();right() }
        if(event.key=="ArrowUp"){ event.preventDefault();rotate() }
        if(event.key=="ArrowDown"){ event.preventDefault();down() }
        if(event.key==" "){ event.preventDefault();downtobottom() }
    })
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
    if(event.key=="ArrowLeft"){ event.preventDefault();left() }
    if(event.key=="ArrowRight"){ event.preventDefault();right() }
    if(event.key=="ArrowUp"){ event.preventDefault();rotate() }
    if(event.key=="ArrowDown"){ event.preventDefault();down() }
    if(event.key==" "){ event.preventDefault();downtobottom() }
    if(event.key=="Escape"){ event.preventDefault();cancel() }
})

// 顯示下一個方塊
docgetid("shownext")

// 分享
docgetid("share").onclick=function(){
    share()
}

// 暫停/開始遊戲
docgetid("stop").onclick=function(){
    if(docgetid("stop").value=="暫停遊戲"){
        stop()
        docgetid("stop").value="繼續遊戲"
    }else{
        start()
        docgetid("stop").value="暫停遊戲"
    }
}

// 放棄遊戲
docgetid("cancel").onclick=function(){
    cancel()
}

test(false)
startmacossection()