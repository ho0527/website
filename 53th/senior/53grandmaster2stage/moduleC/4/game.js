let stage=1
let score=0
let select=false
let canclick=true
let stagelist=[
    [1000,300],
    [1500,270],
    [2000,240],
    [2500,210],
    [3000,180]
]
let mainarray=[]
let timer
let sec
let min

/*
stagelist:
stage-1[score,timelimit]
*/

/*
mainarray:
0=apple
1=banana
2=grape
3=peach
4=watermelon
*/

function nextstage(){
    docgetid("lightbox").style.transform="translateY(-100%)"

    setTimeout(function(){
        docgetid("lightbox").style.display="none"
        docgetid("lightbox").innerHTML=``
    },300)

    stage=stage+1
    score=0
    game()
}

function move(key){
    if(select&&canclick){
        let temp=mainarray[select[0]][select[1]]
        let selectfruit=docgetall(".item")[select[0]*8+select[1]].innerHTML
        let hasmove=false

        if(key=="up"){
            if(0<=select[0]-1){
                mainarray[select[0]][select[1]]=mainarray[select[0]-1][select[1]]
                mainarray[select[0]-1][select[1]]=temp
                    docgetall(".item")[select[0]*8+select[1]].innerHTML=docgetall(".item")[(select[0]-1)*8+select[1]].innerHTML
                    docgetall(".item")[(select[0]-1)*8+select[1]].innerHTML=selectfruit

                hasmove=true
            }
        }else if(key=="down"){
            if(select[0]+1<=7){
                mainarray[select[0]][select[1]]=mainarray[select[0]+1][select[1]]
                mainarray[select[0]+1][select[1]]=temp
                docgetall(".item")[select[0]*8+select[1]].innerHTML=docgetall(".item")[(select[0]+1)*8+select[1]].innerHTML
                docgetall(".item")[(select[0]+1)*8+select[1]].innerHTML=selectfruit

                hasmove=true
            }
        }else if(key=="left"){
            if(0<=select[1]-1){
                mainarray[select[0]][select[1]]=mainarray[select[0]][select[1]-1]
                mainarray[select[0]][select[1]-1]=temp
                docgetall(".item")[select[0]*8+select[1]].innerHTML=docgetall(".item")[select[0]*8+select[1]-1].innerHTML
                docgetall(".item")[select[0]*8+select[1]-1].innerHTML=selectfruit

                hasmove=true
            }
        }else if(key=="right"){
            if((select[1]+1)<=7){
                mainarray[select[0]][select[1]]=mainarray[select[0]][select[1]+1]
                mainarray[select[0]][select[1]+1]=temp
                docgetall(".item")[select[0]*8+select[1]].innerHTML=docgetall(".item")[select[0]*8+select[1]+1].innerHTML
                docgetall(".item")[select[0]*8+select[1]+1].innerHTML=selectfruit

                hasmove=true
            }
        }else{ conlog("[ERROR]function move key not exist","15","red") }
        
        // 清除選擇方塊
        if(hasmove){
            select=false
            docgetall(".item").forEach(function(event){
                event.style.border="none"
            })
        }

        // 連線判斷 START
        score=score+100
        totalscore=totalscore+100
        docgetid("gamescore").innerHTML=`
            ${score}
        `
        // 連線判斷 END

        // 分數判斷 START
        if(score>=stagelist[stage-1][0]){
            if(stage==5){
                // end()
                result=true
            }else{
                clearInterval(timer)
                // 清空移動水果 START
                document.onkeydown=function(event){
                    if(event.key=="ArrowUp"||event.key=="ArrowDown"||event.key=="ArrowLeft"||event.key=="ArrowRight"){
                        event.preventDefault()
                        canclick=false
                    }
                }
                // 清空移動水果 END
            
                // 清空復原 START
                document.onkeyup=function(event){
                    if(event.key=="ArrowUp"||event.key=="ArrowDown"||event.key=="ArrowLeft"||event.key=="ArrowRight"){
                        event.preventDefault()
                        canclick=false
                    }
                }
                // 清空復原 END
                lightbox(null,"lightbox",function(){
                    return `
                        第${stage}關 完成!<br>
                        總分: ${totalscore}<br>
                        總用時: ${totaltime}s<br><br>
                        <input type="button" class="bluebutton" onclick="nextstage()" value="next stage">
                    `
                },null,false,"none")
            }
        }
        // 分數判斷 END
    }
}

function game(){
    // 初始化 START
    nickname=weblsget("53grandmaster2stagemodulecnickname")

    sec=parseInt(stagelist[stage-1][1]%60)
    min=parseInt(stagelist[stage-1][1]/60)

    docgetid("gamestage").innerHTML=`
        stage-${stage}
    `

    docgetid("gamenickname").innerHTML=`
        ${nickname}
    `

    docgetid("gamescore").innerHTML=`
        ${score}
    `

    docgetid("gameboard").innerHTML=`
        <img src="material/picture/game-boards.svg" class="gameinfoimage" draggable="false">
        <div class="gameboard0 gameboarditem" id="gameboard0"></div>
        <div class="gameboard1 gameboarditem" id="gameboard1"></div>
        <div class="gameboard2 gameboarditem" id="gameboard2"></div>
        <div class="gameboard3 gameboarditem" id="gameboard3"></div>
        <div class="gameboard4 gameboarditem" id="gameboard4"></div>
        <div class="gameboard5 gameboarditem" id="gameboard5"></div>
        <div class="gameboard6 gameboarditem" id="gameboard6"></div>
        <div class="gameboard7 gameboarditem" id="gameboard7"></div>
    `

    timer=setInterval(function(){
        totaltime=totaltime+1

        if(sec==0){
            min=min-1
            sec=60
        }

        sec=sec-1

        // 遊戲結束判斷
        if(min==0&&sec==0){
            // game end
            // end()
        }

        docgetid("timer").innerHTML=`${String(min).padStart(2,"0")}:${String(sec).padStart(2,"0")}`
    },1000)

    setInterval(function(){
        let lostwidth=(stagelist[stage-1][1]/4)/475

        docgetid("timerimage").style.width=(parseFloat(docgetid("timerimage").style.width)-lostwidth)+"px"
        docgetid("timerimage").style.right=(parseFloat(docgetid("timerimage").style.right)+lostwidth)+"px"
    },100)

    docgetid("timerimage").style.width="475px"
    docgetid("timerimage").style.right="85px"

    for(let i=0;i<8;i=i+1){
        mainarray[i]=[]
        for(let j=0;j<8;j=j+1){
            let random=parseInt(Math.random()*5)
            let itemlist=["apple","banana","grape","peach","watermelon"]

            mainarray[i].push(random)
            docgetid("gameboard"+i).innerHTML=`
                ${docgetid("gameboard"+i).innerHTML}
                <div class="item item${j+1}" data-id="${i+"_"+j}">
                    <img src="material/picture/fruit-${itemlist[random]}.png" alt="${itemlist[random]}" class="itemimage" draggable="false">
                </div>
            `
        }
    }

    docgetall(".item").forEach(function(event){
        event.onclick=function(){
            docgetall(".item").forEach(function(event){
                event.style.border="none"
            })
            event.style.border="5px yellow solid"
            event.childNodes[1].style.width="95%" // 縮小該水果
            select=[parseInt(event.dataset.id.split("_")[0]),parseInt(event.dataset.id.split("_")[1])]
        }
    })
    // 初始化 END

    // 移動水果 START
    document.onkeydown=function(event){
        if(event.key=="ArrowUp"){
            event.preventDefault()
            if(canclick){
                move("up")
                canclick=false
            }
        }else if(event.key=="ArrowDown"){
            event.preventDefault()
            if(canclick){
                move("down")
                canclick=false
            }
        }else if(event.key=="ArrowLeft"){
            event.preventDefault()
            if(canclick){
                move("left")
                canclick=false
            }
        }else if(event.key=="ArrowRight"){
            event.preventDefault()
            if(canclick){
                move("right")
                canclick=false
            }
        }
    }
    // 移動水果 END

    // 復原 START
    document.onkeyup=function(event){
        if(event.key=="ArrowUp"){
            event.preventDefault()
            canclick=true
        }else if(event.key=="ArrowDown"){
            event.preventDefault()
            canclick=true
        }else if(event.key=="ArrowLeft"){
            event.preventDefault()
            canclick=true
        }else if(event.key=="ArrowRight"){
            event.preventDefault()
            canclick=true
        }
    }
    // 復原 END

    nickname=weblsget("53grandmaster2stagemodulecnickname")
}

game()