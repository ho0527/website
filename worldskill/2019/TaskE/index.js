docgetid("main").innerHTML=`
    <div class="elementdiv" id="0" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">
        <div class="elementposition">
            <div class="element"></div>
        </div>
    </div>
` // 初始化

docgetall(".elementdiv").forEach(function(event){
    // hover時顯示
    event.onmouseover=function(){
        event.querySelectorAll(".element")[0].innerHTML=`
            <div class="elementposition2">
                <div class="element1" id="1"><div class="element1text">1</div></div>
                <div class="element2" id="2"><div class="element2text">2</div></div>
                <div class="element3" id="3"><div class="element3text">3</div></div>
                <div class="element4" id="4"><div class="element4text">4</div></div>
            </div>
        `

        // 各元素創建 START
        docgetid("1").onclick=function(){

        }

        docgetid("2").onclick=function(){

        }

        docgetid("3").onclick=function(){

        }

        docgetid("4").onclick=function(){

        }
        // 各元素創建 END
    }

    // 離開時清空
    event.onmouseleave=function(){
        event.querySelectorAll(".element")[0].innerHTML=``
    }
})

// 函式庫初始化 TOEND
startmacossection()