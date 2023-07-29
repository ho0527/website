let difficulty:string=weblsget("difficulty")
let timemin:number=0
let timesec:number=0
let width:number=innerWidth*0.6 // innerwidth == 100vw
let height:number=innerHeight*0.85 // innerHeight == 100vh
let nowarray=[]
let blocklist=[]
let blockarray=[]

for(let i=0;i<17;i=i+1){
    nowarray.push([])
    for(let j=0;j<10;j=j+1){
        nowarray[i].push(0)
    }
}

docgetid("main").style.width=width+"px"
docgetid("main").style.height=height+"px"
docgetid("difficulty").innerHTML=difficulty // 拿到難易度並顯示

setInterval(function(){
    timesec=timesec+1
    if(timesec==60){
        timemin=timemin+1
        timesec=0
    }
    let min:string=timemin.toString()
    let sec:string=timesec.toString()
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

function block(key:"a"|"b"|"c"|"d"|"e"|"f"|"g"){
    if(key=="a"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typea")
        docappendchild("main",div)
        blockarray=[
            [0,0,0,0],
            [1,1,1,1]
        ]
    }else if(key=="b"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typeb")
        docappendchild("main",div)
        blockarray=[
            [1,0,0,0],
            [1,1,1,0]
        ]
    }else if(key=="c"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typec")
        docappendchild("main",div)
        blockarray=[
            [0,0,1,0],
            [1,1,1,0]
        ]
    }else if(key=="d"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typed")
        docappendchild("main",div)
        blockarray=[
            [0,1,1,0],
            [0,1,1,0]
        ]
    }else if(key=="e"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typee")
        docappendchild("main",div)
        blockarray=[
            [0,1,1,0],
            [1,1,0,0]
        ]
    }else if(key=="f"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typef")
        docappendchild("main",div)
        blockarray=[
            [0,1,0,0],
            [1,1,1,0]
        ]
    }else if(key=="g"){
        let div:HTMLElement=doccreate("div")
        div.classList.add("typeg")
        docappendchild("main",div)
        blockarray=[
            [1,1,0,0],
            [0,1,1,0]
        ]
    }else{ conlog("[ERROR]error key","red","15") }
}

function test(key:boolean){
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

test(false)
startmacossection()