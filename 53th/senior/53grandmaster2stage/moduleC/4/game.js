function game(){
    let nickname=weblsget("53grandmaster2stagemodulecnickname")
    let stagelist={
        1: {
            "score": 1000,
            "timelimit": 300
        },
        2: {
            "score": 1500,
            "timelimit": 270
        },
        3: {
            "score": 2000,
            "timelimit": 240
        },
        4: {
            "score": 2500,
            "timelimit": 210
        },
        5: {
            "score": 3000,
            "timelimit": 180
        }
    }
    let stage=1
    let score=0
    let sec=parseInt(stagelist[stage]["timelimit"]%60)
    let min=parseInt(stagelist[stage]["timelimit"]/60)
    let totaltime=0 // (s)
    let select=false
    let canclick=false
    let mainarray=[]
    let timer

    /*
    mainarray:
    0=apple
    1=banana
    2=grape
    3=peach
    4=watermelon
    */

    function move(key){
        if(select){
            if(key=="up"){

            }else if(key=="down"){

            }else if(key=="left"){

            }else if(key=="right"){

            }else{

            }
        }
    }

    // 初始化 START
    docgetid("gamestage").innerHTML=`
        stage-${stage}
    `

    docgetid("gamenickname").innerHTML=`
        ${nickname}
    `

    docgetid("gamescore").innerHTML=`
        ${score}
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
        }

        docgetid("timer").innerHTML=`${String(min).padStart(2,"0")}:${String(sec).padStart(2,"0")}`
    },1000)

    setInterval(function(){
        let lostwidth=(stagelist[stage]["timelimit"]/4)/475

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
            select=[event.dataset.id.split("_")[0],event.dataset.id.split("_")[1]]
        }
    })

    // 初始化 END

    document.onkeydown=function(event){
        if(event.key=="ArrowUp"){
            if(!canclick){
                canclick=true
                move("up")
            }
        }else if(event.key=="ArrowDown"){
            if(!canclick){
                canclick=true
                move("down")
            }
        }else if(event.key=="ArrowLeft"){
            if(!canclick){
                canclick=true
                move("left")
            }
        }else if(event.key=="ArrowRight"){
            if(!canclick){
                canclick=true
                move("right")
            }
        }
    }

    document.onkeyup=function(event){
        if(event.key=="ArrowUp"){
            canclick=false
        }else if(event.key=="ArrowDown"){
            canclick=false
        }else if(event.key=="ArrowLeft"){
            canclick=false
        }else if(event.key=="ArrowRight"){
            canclick=false
        }
    }
}

game()