let link=location.href.split("=")[1]
let div=""

if(isset(link)){
    if(link=="normal"){
        div=`
            <div class="command">這裡會放一些很一般的指令</div>
            <div class="warning">
                這些指令有些會破壞伺服器請謹慎使用!
            </div>
        `
    }else if(link=="startmacossection"){
        div=`
        `
    }else if(link=="divsort"){
        div=`
            <div class="command">/feedback</div>
            <div class="commanddescription">回報問題等等</div>
            <div class="howtouse">語法: /feedback [string(要回報的內容)]</div>
        `
    }else if(link=="lightbox"){
        div=`
            <div class="command">/help</div>
            <div class="commanddescription">查看指令列表</div>
            <div class="howtouse">語法: /help</div>
        `
    }else if(link=="pagechanger"){
        div=`
            <div class="command">/helpmusic</div>
            <div class="commanddescription">查看music指令列表</div>
            <div class="howtouse">語法: /helpmusic</div>
        `
    }

    else if(link=="short"){
        div=`
            <div class="command">/stop</div>
            <div class="commanddescription">暫停歌曲</div>
            <div class="howtouse">語法: /stop</div>
        `
    }

    else if(link=="test"){
        div=`
            <div class="command">這裡會放一些測試中或連線測試有關的指令</div>
            <div class="notice">
                這裡的指令普遍沒有功能，所以沒有變化也不要覺得奇怪
            </div>
        `
    }else if(link==""){
        div=`
        `
    }

    else if(link=="about"){
        div=`
            <div class="command">在這個頁面中會放一些關於這個網頁和機器人的東西</div>
        `
    }else if(link=="credits"){
        div=`
            <div>
                機器人製作: 小賀chris
            </div><br><br>
            <div>
                網頁製作: 小賀chris
            </div><br><br>
            <div>
                特別感謝:<br>
                chatGPT<br>
                https://github.com/eritislami/evobot 提供以下函式參考: /help, /invite 以及音樂撥放的函式!<br>
            </div><br><br>
        `
    }else if(link=="bot"){
        div=`
            <div>
                邀請連結:<br>
                <a class="a" href="https://discord.com/api/oauth2/authorize?client_id=1136953396662915093&permissions=8&scope=bot">https://discord.com/api/oauth2/authorize?client_id=1136953396662915093&permissions=8&scope=bot</a><br>
                github連結:<br>
                <a class="a" href="https://github.com/ho0527/dcbot">https://github.com/ho0527/dcbot</a>
            </div><br><br>
            <div>
                簡介:<br>
                這是一個由小賀chris我自己一個人開發出來的東西 如果有任何機器人相關的問題 都可以用 <a class="a" href="#feedback">/feedback</a> 指令告訴我喔，或者直接DC: chris0527 找我!
            </div><br><br>
            <div>
                網站導覽:<br>
                可以點左側面板就可以找到你要的指令了! 之後會在右側面板呈現 如果有任何問題直接連絡我即可!<br>
                登入目前還不知道要幹嘛 目前主要只是給我看feedback的東西而已 如果你想要註冊也沒差
            </div><br><br>
        `
    }else if(link=="ps"){
        div=`
        `
    }
    docgetid("main").innerHTML=div
}

startmacossection()