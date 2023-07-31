let maintimer
let pdtimer
let timer
let min=1
let sec=30
let ms=0
let sec2=0
let ms2=0
let defucheck=0

docgetid("audio").src="material/audio/start.mp3"
docgetid("audio").volume=1

docgetid("game").onpointerdown=function(event){
    event.preventDefault()
    if(docgetid("game").value=="開始遊戲"){
        docgetid("audio").load()
        docgetid("audio").play()
        setTimeout(function(){ docgetid("audio").src="material/audio/plant.mp3" },1000)
        docgetid("audio").volume=0.80
        docgetid("game").value="裝包"

        let input=doccreate("input")
        input.type="button"
        input.classList.add("stop")
        input.id="stop"
        input.value="停止"
        docappendchild("main",input)

        maintimer=setInterval(function(){
            let tempsec
            let tempms
            if(ms==0){
                sec=sec-1
                if(sec==0&&min==0){
                    lightbox(null,"lightbox",function(){
                        return `
                           <div>
                                <h1>超過時間</h1>
                                <h2>守方獲勝</h2><br>
                               <input type="button" class="button" onclick="location.reload()" value="重新開始">
                           </div>
                        `
                    })
                    clearInterval(maintimer)
                }else if(min==1&&sec==0){
                    min=min-1
                    sec=59
                    ms=99
                }else{
                    ms=99
                }
            }else{
                ms=ms-1
            }
            tempsec=sec
            tempms=ms
            if(tempsec<10){
                tempsec="0"+tempsec
            }
            if(tempms<10){
                tempms="0"+tempms
            }
            if(min==0){
                docgetid("timer").innerHTML=`${tempsec}.${tempms}`
            }else{
                docgetid("timer").innerHTML=`0${min}:${tempsec}`
            }
        },10)

        docgetid("stop").onclick=function(){
            if(confirm("是否終止")){
                location.reload()
            }
        }
    }else if(docgetid("game").value=="裝包"){
        docgetid("audio").play()
        pdtimer=setInterval(function(){
            let tempsec
            let tempms
            if(ms2==99){
                sec2=sec2+1
                if(sec2==3){
                    clearInterval(pdtimer)
                    clearInterval(maintimer)
                    docgetid("audio").src="material/audio/defu.mp3"
                    docgetid("game").value="拆包"
                    min=0
                    sec=10
                    ms=0
                    maintimer=setInterval(function(){
                        let tempsec
                        let tempms
                        if(ms==0){
                            sec=sec-1
                            if(sec==0){
                                clearInterval(pdtimer)
                                clearInterval(maintimer)
                                document.onpointerup=function(event){ event.preventDefault() }
                                lightbox(null,"lightbox",function(){
                                    return `
                                    <div>
                                        <h1>炸彈爆炸</h1>
                                        <h2>攻方獲勝</h2><br>
                                        <input type="button" class="button" onclick="location.reload()" value="重新開始">
                                    </div>
                                    `
                                })
                            }else{
                                ms=99
                            }
                        }else{
                            ms=ms-1
                        }
                        tempsec=sec
                        tempms=ms
                        if(tempsec<10){
                            tempsec="0"+tempsec
                        }
                        if(tempms<10){
                            tempms="0"+tempms
                        }
                        docgetid("timer").innerHTML=`${tempsec}.${tempms}`
                    },10)
                }
                ms2=0
            }else{
                ms2=ms2+1
            }
            tempsec=sec2
            tempms=ms2
            if(tempsec<10){
                tempsec="0"+tempsec
            }
            if(tempms<10){
                tempms="0"+tempms
            }
            if(sec2==3){
                docgetid("timer2").innerHTML=`
                    <div class="right" id="right">00.00</div>
                    <div class="left" id="left">00.00</div>
                `
            }else{
                docgetid("timer2").innerHTML=`${tempsec}.${tempms}`
            }
        },10)
    }else{
        docgetid("audio").play()
        pdtimer=setInterval(function(){
            let tempsec
            let tempms
            if(ms2==99){
                sec2=sec2+1
                ms2=0
            }else{
                ms2=ms2+1
            }
            if(sec2==2&&ms2==40){
                if(defucheck==0){
                    defucheck=defucheck+1
                    docgetid("right").innerHTML=`Check`
                    docgetid("right").classList.add("pass")
                    sec2=0
                    ms2=0
                }else{
                    clearInterval(maintimer)
                    clearInterval(pdtimer)
                    document.onpointerup=function(event){ event.preventDefault() }
                    docgetid("left").innerHTML=`Check`
                    docgetid("left").classList.add("pass")
                    lightbox(null,"lightbox",function(){
                        return `
                        <div>
                            <h1>炸彈拆除</h1>
                            <h2>守方獲勝</h2><br>
                            <input type="button" class="button" onclick="location.reload()" value="重新開始">
                        </div>
                        `
                    })
                }
            }
            tempsec=sec2
            tempms=ms2
            if(tempsec<10){
                tempsec="0"+tempsec
            }
            if(tempms<10){
                tempms="0"+tempms
            }
            if(defucheck==0){
                docgetid("right").innerHTML=`${tempsec}.${tempms}`
            }else{
                docgetid("left").innerHTML=`${tempsec}.${tempms}`
            }
        },10)
    }
}

document.onpointerup=function(){
    sec2=0
    ms2=0
    clearTimeout(pdtimer)
    if(docgetid("game").value=="裝包"){
        docgetid("timer2").innerHTML=`00.00`
    }else if(docgetid("game").value=="拆包"){
        if(defucheck==0){
            docgetid("right").innerHTML=`00.00`
        }else{
            docgetid("left").innerHTML=`00.00`
        }
    }
}