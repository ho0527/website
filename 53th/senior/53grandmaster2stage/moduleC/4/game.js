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
let itemlist=["apple","banana","grape","peach","watermelon"]
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

// 檢查是否形成連線(感謝chatgpt)
function isLineFormed(x, y, fruit) {
    // Check horizontally
    if (y >= 2 && mainarray[x][y - 1] === fruit && mainarray[x][y - 2] === fruit) {
        return true;
    }
    if (y <= 5 && mainarray[x] && mainarray[x][y + 1] === fruit && mainarray[x][y + 2] === fruit) {
        return true;
    }
    if (y >= 1 && y <= 6 && mainarray[x][y - 1] === fruit && mainarray[x] && mainarray[x][y + 1] === fruit) {
        return true;
    }

    // Check vertically
    if (x >= 2 && mainarray[x - 1] && mainarray[x - 1][y] === fruit && mainarray[x - 2][y] === fruit) {
        return true;
    }
    if (x <= 5 && mainarray[x + 1] && mainarray[x + 1][y] === fruit && mainarray[x + 2] && mainarray[x + 2][y] === fruit) {
        return true;
    }
    if (x >= 1 && x <= 6 && mainarray[x - 1] && mainarray[x - 1][y] === fruit && mainarray[x + 1] && mainarray[x + 1][y] === fruit) {
        return true;
    }

    return false;
}

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
        let linesFound=false;
        let removedFruits=0;

        // Check horizontal lines
        for (let i=0; i < 8; i++) {
            for (let j=0; j < 6; j++) {
                if (mainarray[i][j] !== -1 && mainarray[i][j] === mainarray[i][j + 1] && mainarray[i][j] === mainarray[i][j + 2]) {
                    let count=0;
                    for (let k=j; k < 8 && mainarray[i][k] === mainarray[i][j]; k++) {
                        count++;
                    }
                    if (count >= 3) {
                        for (let k=j; k < j + count; k++) {
                            mainarray[i][k]=-1; // Mark for removal
                            removedFruits++;
                        }
                        linesFound=true;
                        j += count - 1; // Skip checked fruits
                    }
                }
            }
        }

        // Check vertical lines
        for (let j=0; j < 8; j++) {
            for (let i=0; i < 6; i++) {
                if (mainarray[i][j] !== -1 && mainarray[i][j] === mainarray[i + 1][j] && mainarray[i][j] === mainarray[i + 2][j]) {
                    let count=0;
                    for (let k=i; k < 8 && mainarray[k][j] === mainarray[i][j]; k++) {
                        count++;
                    }
                    if (count >= 3) {
                        for (let k=i; k < i + count; k++) {
                            mainarray[k][j]=-1; // Mark for removal
                            removedFruits++;
                        }
                        linesFound=true;
                        i += count - 1; // Skip checked fruits
                    }
                }
            }
        }

        // Update the score and refill the board if lines were found
        if (linesFound) {
            score += removedFruits * 20; // 20 points for each removed fruit
            totalscore=totalscore+removedFruits * 20
            docgetid("gamescore").innerHTML=score;

            // Refill the board
            for (let i=0; i < 8; i++) {
                for (let j=0; j < 8; j++) {
                    if (mainarray[i][j] === -1) {
                        let fruit;
                        do {
                            fruit=Math.floor(Math.random() * 5); // Assuming 5 different fruits
                        } while (isLineFormed(i, j, fruit));
                        mainarray[i][j]=fruit;
                    }
                }
            }
            for (let i=0; i < 8; i++) {
                let boardHTML="";
                for (let j=0; j < 8; j++) {
                    let fruit=mainarray[i][j];
                    let itemlist=["apple","banana","grape", "peach", "watermelon"];
                    boardHTML += `
                        <div class="item item${j + 1}" data-id="${i + "_" + j}">
                            <img src="material/picture/fruit-${itemlist[fruit]}.png" alt="${itemlist[fruit]}" class="itemimage" draggable="false">
                        </div>
                    `;
                }
                docgetid("gameboard" + i).innerHTML=boardHTML;
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
        }
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
            let fruit=Math.floor(Math.random()*5) // 隨機產生水果

            while(isLineFormed(i,j,fruit)){
                fruit=Math.floor(Math.random()*5)
            }

            mainarray[i][j]=fruit

            docgetid("gameboard"+i).innerHTML=`
                ${docgetid("gameboard"+i).innerHTML}
                <div class="item item${j+1}" data-id="${i+"_"+j}">
                    <img src="material/picture/fruit-${itemlist[fruit]}.png" alt="${itemlist[fruit]}" class="itemimage" draggable="false">
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