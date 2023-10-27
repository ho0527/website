let username=weblsget("name")
let difficulty=weblsget("difficulty")
let mainarray=[]
let score=0
let topstarcount=0
let maininnerhtml2=``
let min=0
let sec=0
let click=false
let blockwh=25 // 一格的長寬
let mid=5
let life=3
let canhit=true
let timestop=false
let timer // 計時器
let ghostinterval
let playerinterval
let starcount
let player // [[x,y],目前方塊狀態]
let ghost1=[]
let ghost2=[]
let ghost3=[]
let doorlist=[]

/*
mainarray 內容:
0=牆
1=道路
2=豆子
3=星星
4=只有鬼能走的地方
5=player
6=鬼1
7?=鬼2
8?=鬼
*/

function check(type){
    if(type=="player"){
        if(player[1]==2){
            score=score+10
            mainarray[player[0][0]][player[0][1]]=1
            docgetall(".row>div")[player[0][0]*27+player[0][1]].innerHTML=``
            player[1]=1
        }else if(player[1]==3){
            score=score+50
            mainarray[player[0][0]][player[0][1]]=1
            docgetall(".row>div")[player[0][0]*27+player[0][1]].innerHTML=``
            player[1]=1
        }
        docgetid("score").innerHTML=`
            ${score}
        `
        if((player[0].toString()==ghost1.toString()||player[0].toString()==ghost2.toString()||player[0].toString()==ghost3.toString())&&canhit){
            let playercooldown

            life=life-1

            docgetid("life").innerHTML=`
                ${life}
            `

            if(life<=0){
                clearInterval(timer)
                timestop=true
                newajax("POST","register.php",JSON.stringify({
                    "adddata": true,
                    "time": min*60+sec,
                    "name": username,
                    "score": score
                }))
                return
            }

            canhit=false
            docgetid("player").style.opacity=0
            setTimeout(function(){
                docgetid("player").style.opacity=1
            },500)
            playercooldown=setInterval(function(){
                docgetid("player").style.opacity=0
                setTimeout(function(){
                    docgetid("player").style.opacity=1
                },500)
            },1000)
            clearInterval(timer)
            document.onkeydown=function(event){
                if(event.key=="p"||event.key=="P"){
                    stopstart()
                }else if(event.key=="ArrowUp"||event.key=="ArrowDown"||event.key=="ArrowLeft"||event.key=="ArrowRight"){
                    event.preventDefault()
                }
            }
            timestop=true
            setTimeout(function(){
                timestart()
                pacmankeydonwn()
                clearInterval(playercooldown)
                timestop=false
                setTimeout(function(){
                    canhit=true
                },1000)
            },3000)
        }
    }else{
        console.log("還沒做啦啦啦啦啦")
    }
}

function moveto(movetype,startx,starty){
    for(let i=0;i<blockwh;i=i+1){
        setTimeout(function(){
            if(movetype=="up"){
                docgetid("player").style.top=((startx*25+mid)-i)+"px"
            }else if(movetype=="down"){
                docgetid("player").style.top=((startx*25+mid)+i)+"px"
            }else if(movetype=="left"){
                docgetid("player").style.left=((starty*25+mid)-i)+"px"
            }else if(movetype=="right"){
                docgetid("player").style.left=((starty*25+mid)+i)+"px"
            }else{
                conlog("[ERROR] function moveto movetype error","red")
            }
        },500/blockwh)
    }
}

function pacmankeydonwn(){
    document.onkeydown=function(event){
        if(event.key=="ArrowUp"){
            playermove("up")
            if(!click){
                setTimeout(function(){
                    click=true
                },250)
            }
        }else if(event.key=="ArrowDown"){
            playermove("down")
            if(!click){
                setTimeout(function(){
                    click=true
                },250)
            }
        }else if(event.key=="ArrowLeft"){
            playermove("left")
            if(!click){
                setTimeout(function(){
                    click=true
                },250)
            }
        }else if(event.key=="ArrowRight"){
            playermove("right")
            if(!click){
                setTimeout(function(){
                    click=true
                },250)
            }
        }else if(event.key=="p"||event.key=="P"){
            stopstart()
        }
    }
    document.onkeyup=function(event){
        if(event.key=="ArrowUp"){
            click=false
        }else if(event.key=="ArrowDown"){
            click=false
        }else if(event.key=="ArrowLeft"){
            click=false
        }else if(event.key=="ArrowRight"){
            click=false
        }else if(event.key=="p"){
            click=false
        }
    }
}

function checkghostnotblock(testarray){    
    if(testarray.toString()!=ghost1.toString()&&testarray.toString()!=ghost2.toString()&&testarray.toString()!=ghost3.toString()){
        return true
    }else{
        return false
    }
}

function ghostrun(){
    if(difficulty=="easy"){
        ghostmove("ghost1",ghost1)
    }else if(difficulty=="normal"){
        ghostmove("ghost1",ghost1)
        ghostmove("ghost2",ghost2)
    }else{
        ghostmove("ghost1",ghost1)
        ghostmove("ghost2",ghost2)
        ghostmove("ghost3",ghost3)
    }
}

function ghostmove(name,array){
    if(!timestop){
        let type=parseInt(Math.random()*4) // 會有上(0)下(1)左(2)右(3)4種方式
        if(type==0){
            if(mainarray[array[0]-1][array[1]]!=0&&checkghostnotblock([array[0]-1,array[1]])){
                for(let i=0;i<blockwh;i=i+1){
                    setTimeout(function(){
                        docgetid(name).style.top=((array[0]*25+mid)-i)+"px"
                    },500/blockwh)
                }
                if(name=="ghost1"){
                    ghost1=[array[0]-1,array[1]]
                }else if(name=="ghost2"){
                    ghost2=[array[0]-1,array[1]]
                }else{
                    ghost3=[array[0]-1,array[1]]
                }
            }else{ ghostmove(name,array) } // 再用一次
        }else if(type==1){
            if(mainarray[array[0]+1][array[1]]!=0&&checkghostnotblock([array[0]+1,array[1]])){
                for(let i=0;i<blockwh;i=i+1){
                    setTimeout(function(){
                        docgetid(name).style.top=((array[0]*25+mid)+i)+"px"
                    },500/blockwh)
                }
                if(name=="ghost1"){
                    ghost1=[array[0]+1,array[1]]
                }else if(name=="ghost2"){
                    ghost2=[array[0]+1,array[1]]
                }else{
                    ghost3=[array[0]+1,array[1]]
                }
            }else{ ghostmove(name,array) }
        }else if(type==2){
            if(mainarray[array[0]][array[1]-1]!=0&&checkghostnotblock([array[0],array[1]-1])){
                for(let i=0;i<blockwh;i=i+1){
                    setTimeout(function(){
                        docgetid(name).style.left=((array[1]*25+mid)-i)+"px"
                    },500/blockwh)
                }
                if(name=="ghost1"){
                    ghost1=[array[0],array[1]-1]
                }else if(name=="ghost2"){
                    ghost2=[array[0],array[1]-1]
                }else{
                    ghost3=[array[0],array[1]-1]
                }
            }else{
                // if(isset(mainarray[array[0]][26])){
                //     docgetid(name).style.left=((27*25+5)-25)+"px"
                //     if(name=="ghost1"){
                //         ghost1=[array[0],26]
                //     }else if(name=="ghost2"){
                //         ghost2=[array[0],26]
                //     }else{
                //         ghost3=[array[0],26]
                //     }
                // }else{
                    ghostmove(name,array)
                // }
            }
        }else if(type==3){
            if(mainarray[array[0]][array[1]+1]!=0&&checkghostnotblock([array[0],array[1]+1])){
                for(let i=0;i<blockwh;i=i+1){
                    setTimeout(function(){
                        docgetid(name).style.left=((array[1]*25+mid)+i)+"px"
                    },500/blockwh)
                }
                if(name=="ghost1"){
                    ghost1=[array[0],array[1]+1]
                }else if(name=="ghost2"){
                    ghost2=[array[0],array[1]+1]
                }else{
                    ghost3=[array[0],array[1]+1]
                }
            }else{
                // if(isset(mainarray[array[0]][0])){
                //     docgetid(name).style.left=((-1*25+5)+25)+"px"
                //     if(name=="ghost1"){
                //         ghost1=[array[0],0]
                //     }else if(name=="ghost2"){
                //         ghost2=[array[0],0]
                //     }else{
                //         ghost3=[array[0],0]
                //     }
                // }else{
                    ghostmove(name,array)
                // }
            }
        }else{ console.log("type error") }
    }
}

// 玩家移動
function playermove(type){
    if(type=="up"){
        if(mainarray[player[0][0]-1][player[0][1]]!=0&&mainarray[player[0][0]-1][player[0][1]]!=4){
            moveto("up",player[0][0],player[0][1])
            player=[
                [player[0][0]-1,player[0][1]],
                mainarray[player[0][0]-1][player[0][1]]
            ]
            check("player")
        }
    }else if(type=="down"){
        if(mainarray[player[0][0]+1][player[0][1]]!=0&&mainarray[player[0][0]+1][player[0][1]]!=4){
            moveto("down",player[0][0],player[0][1])
            player=[
                [player[0][0]+1,player[0][1]],
                mainarray[player[0][0]+1][player[0][1]]
            ]
            check("player")
        }
    }else if(type=="left"){
        if(mainarray[player[0][0]][player[0][1]-1]!=0&&mainarray[player[0][0]][player[0][1]-1]!=4){
            if(isset(mainarray[player[0][0]][player[0][1]-1])){
                moveto("left",player[0][0],player[0][1])
                player=[
                    [player[0][0],player[0][1]-1],
                    mainarray[player[0][0]][player[0][1]-1]
                ]
                check("player")
            }else{
                if(isset(mainarray[player[0][0]][26])){
                    docgetid("player").style.left=((27*25+5)-25)+"px"
                    player=[
                        [player[0][0],26],
                        mainarray[player[0][0]][26]
                    ]
                    check("player")
                }
            }
        }
    }else if(type=="right"){
        if(mainarray[player[0][0]][player[0][1]+1]!=0&&mainarray[player[0][0]][player[0][1]+1]!=4){
            if(isset(mainarray[player[0][0]][player[0][1]+1])){
                moveto("right",player[0][0],player[0][1])
                player=[
                    [player[0][0],player[0][1]+1],
                    mainarray[player[0][0]][player[0][1]+1]
                ]
                check("player")
            }else{
                if(isset(mainarray[player[0][0]][0])){
                    docgetid("player").style.left=((-1*25+5)+25)+"px"
                    player=[
                        [player[0][0],0],
                        mainarray[player[0][0]][0]
                    ]
                    check("player")
                }
            }
        }
    }else{ console.log("[ERROR] playermove key type error.","red") }
}

// stop/start
function stopstart(){
    if(docgetid("pausecontinue").innerHTML=="暫停"){
        clearInterval(timer)
        docgetid("pausecontinue").innerHTML="繼續"
        document.onkeydown=function(event){
            if(event.key=="p"||event.key=="P"){
                stopstart()
            }else if(event.key=="ArrowUp"||event.key=="ArrowDown"||event.key=="ArrowLeft"||event.key=="ArrowRight"){
                event.preventDefault()
            }
        }
        timestop=true
    }else{
        timestart()
        docgetid("pausecontinue").innerHTML="暫停"
        pacmankeydonwn()
        timestop=false
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
        if(sec==3&&min==0){
            docgetall(".door").forEach(function(event){
                event.style.backgroundColor="black"
            })
            for(let i=0;i<doorlist.length;i=i+1){
                mainarray[doorlist[i][0]][doorlist[i][1]]=4
            }
        }
        docgetid("timer").innerHTML=`
            ${String(min).padStart(2,"0")}:${String(sec).padStart(2,"0")}
        `
    },1000)
}

if(difficulty=="easy"){
    starcount=10
    maininnerhtml2=`
        <div class="ghost ghost1" id="ghost1" style="width: 20px;height: 20px;top: 355px;left: 330px;"></div>
        <div class="player" id="player" style="width: 20px;height: 20px;"></div>
    `
    ghost1=[14,13]
}else if(difficulty=="normal"){
    starcount=8
    maininnerhtml2=`
        <div class="ghost ghost1" id="ghost1" style="width: 20px;height: 20px;top: 355px;left: 285px;"></div>
        <div class="ghost ghost2" id="ghost2" style="width: 20px;height: 20px;top: 355px;left: 380px;"></div>
        <div class="player" id="player" style="width: 20px;height: 20px;"></div>
    `
    ghost1=[14,11]
    ghost2=[14,15]
}else{
    starcount=6
    maininnerhtml2=`
        <div class="ghost ghost1" id="ghost1" style="width: 20px;height: 20px;top: 355px;left: 285px;"></div>
        <div class="ghost ghost2" id="ghost2" style="width: 20px;height: 20px;top: 355px;left: 330px;"></div>
        <div class="ghost ghost3" id="ghost3" style="width: 20px;height: 20px;top: 355px;left: 380px;"></div>
        <div class="player" id="player" style="width: 20px;height: 20px;"></div>
    `
    ghost1=[14,11]
    ghost2=[14,13]
    ghost3=[14,15]
}

docgetid("difficulty").innerHTML=difficulty // 拿到難易度並顯示
docgetid("name").innerHTML=username // 拿到名稱並顯示

newajax("GET","map.txt").onload=function(){
    let data=this.responseText.split("\r\n") // 分隔及讀取檔案
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
                mainarray[i].push(4)
            }else if(row[j]==3){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="door"></div>
                `
                doorlist.push([i,j])
                mainarray[i].push(0)
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

    // 玩家定位
    let f=parseInt(Math.random()*25)+1
    let s=parseInt(Math.random()*30)+1
    function xy(){
        if(mainarray[f][s]==0||mainarray[f][s]==1||mainarray[f][s]==4||mainarray[f][s]==6||mainarray[f][s]==7||!mainarray[f][s]){
            f=parseInt(Math.random()*25)+1
            s=parseInt(Math.random()*30)+1
            xy()
        }
    }

    xy()

    docgetid("player").style.top=(f*25+5)+"px"
    docgetid("player").style.left=(s*25+5)+"px"
    player=[[f,s],mainarray[f][s]]
    
    docgetid("pausecontinue").onclick=function(){ stopstart() }

    pacmankeydonwn()
    timestart()
    ghostrun()
    setInterval(ghostrun,500)
}

docgetid("statisticaldata").onclick=function(){
    newajax("GET","register.php?submit=").onload=function(){
        let data=JSON.parse(this.responseText)
        if(data["success"]){
            lightbox(null,"lightbox",function(){
                return `
                    <div>test</div>
                `
            })
        }else{
            alert("在獲取高分榜時出現問題，請告知管理員。或重新整理後再試一次。")
        }
    }
}

startmacossection()