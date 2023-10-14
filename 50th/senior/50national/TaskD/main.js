let username=weblsget("name")
let difficulty=weblsget("difficulty")
let mainarray=[]
let score=0
let topstarcount=0
let maininnerhtml2=``
let min=0
let sec=0
let timer // 計時器
let ghostinterval
let playerinterval
let starcount

/*
mainarray 內容:
0=牆
1=道路
2=豆子
3=星星
4=門
5=player
6=鬼1
7?=鬼2
8?=鬼3
*/

// player move START
function up(){

}

function down(){

}

function left(){

}

function right(){

}
// player move END


// stop/start
function stopstart(){
    if(docgetid("pausecontinue").innerHTML=="暫停"){
        clearInterval(timer)
        docgetid("pausecontinue").innerHTML="繼續"
    }else{
        timestart()
        docgetid("pausecontinue").innerHTML="暫停"
    }
}

// timer
function timestart(){
    timer=setInterval(function(){
        sec=sec+1
        if(sec>=60){
            sec=0
            min=min+1
        }
        docgetid("timer").innerHTML=`
            ${String(min).padStart(2,"0")}:${String(sec).padStart(2,"0")}
        `
    },1000)
}

if(difficulty=="easy"){
    starcount=10
    maininnerhtml2=`
        <div class="ghost ghost1" id="ghost1" style="width: 20px;height: 20px;top: 330px;left: 330px;"></div>
        <div class="player" id="player" style="width: 20px;height: 20px;"></div>
    `
}else if(difficulty=="normal"){
    starcount=8
    maininnerhtml2=`
        <div class="ghost ghost1" id="ghost1" style="width: 20px;height: 20px;top: 330px;left: 285px;"></div>
        <div class="ghost ghost2" id="ghost2" style="width: 20px;height: 20px;top: 330px;left: 380px;"></div>
        <div class="player" id="player" style="width: 20px;height: 20px;"></div>
    `
}else{
    starcount=6
    maininnerhtml2=`
        <div class="ghost ghost1" id="ghost1" style="width: 20px;height: 20px;top: 330px;left: 330px;"></div>
        <div class="ghost ghost2" id="ghost2" style="width: 20px;height: 20px;top: 330px;left: 380px;"></div>
        <div class="ghost ghost3" id="ghost3" style="width: 20px;height: 20px;top: 330px;left: 285px;"></div>
        <div class="player" id="player" style="width: 20px;height: 20px;"></div>
    `
}

docgetid("difficulty").innerHTML=difficulty // 拿到難易度並顯示
docgetid("name").innerHTML=username // 拿到名稱並顯示

let ajax=newajax("GET","map.txt") // start ajsx

ajax.onload=function(){
    let data=ajax.responseText.split("\r\n") // 分隔及讀取檔案
    let tempstartcount=starcount
    let maininnerhtml=`
        <div class="center">
            <div class="position">
    `

    // 產出檔案
    for(let i=0;i<data.length;i=i+1){
        let row=data[i].split(",")
        mainarray.push([])
        maininnerhtml=`
            ${maininnerhtml}
            <div class="row">
        `
        for(let j=0;j<row.length;j=j+1){
            if(row[j]==0){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="wall"></div>
                `
                mainarray[i].push(0)
            }else if(row[j]==1){
                let roadinnerhtml
                if((((i+1)/2)<=7.5&&Math.random()>=0.95&&tempstartcount>0&&topstarcount<(starcount/2))||(((i+1)/2)>=7.5&&Math.random()>=0.95&&tempstartcount>0)){
                    roadinnerhtml=`
                        <div class="star center">&#9733;</div>
                    `
                    mainarray[i].push(3)
                    tempstartcount=tempstartcount-1
                    if((i+1/2)<=15){
                        topstarcount=topstarcount+1
                    }
                }else{
                    roadinnerhtml=`
                        <div class="dot center"></div>
                    `
                    mainarray[i].push(2)
                }
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="road">
                        ${roadinnerhtml}
                    </div>
                `
            }else if(row[j]==2){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="ghostrespawn"></div>
                `
                mainarray[i].push(1)
            }else if(row[j]==3){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="door"></div>
                `
                mainarray[i].push(4)
            }else{ console.log("error") }
        }
        maininnerhtml=`
                ${maininnerhtml}
            </div>
        `
    }

    docgetid("app").innerHTML=`
                ${maininnerhtml}
                ${maininnerhtml2}
            </div>
        </div>
    `

    if(difficulty=="easy"){
        mainarray[13][13]=6
    }else if(difficulty=="normal"){
        mainarray[13][11]=6
        mainarray[13][15]=7
    }else{
        mainarray[13][13]=6
        mainarray[13][15]=7
        mainarray[13][11]=8
    }

    // 玩家定位
    let x=parseInt(Math.random()*25)+1
    let y=parseInt(Math.random()*30)+1
    function xy(){
        if(mainarray[x][y]==0||mainarray[x][y]==1||mainarray[x][y]==4||!mainarray[x][y]){
            x=parseInt(Math.random()*25)+1
            y=parseInt(Math.random()*30)+1
            xy()
        }
    }

    xy()

    docgetid("player").style.top=(x*25+5)+"px"
    docgetid("player").style.left=(y*25+5)+"px"

    mainarray[x][y]=5
    
    docgetall(".ghost").forEach(function(event){
    })

    document.onkeydown=function(event){
        if(event.key=="ArrowUP"){
            up()
        }else if(event.key=="ArrowDown"){
            down()
        }else if(event.key=="ArrowLeft"){
            left()
        }else if(event.key=="ArrowRight"){
            right()
        }else if(event.key=="p"){
            stopstart()
        }
    }

    timestart()
}

startmacossection()