let aside="close" // 設定aside為關閉
let data
let playing=false

if(!isset(weblsget("list"))){ weblsset("list","") }
if(!isset(weblsget("playingindex"))){ weblsset("playingindex",0) }

function createaside(){
    docgetid("aside").innerHTML=`
            <div class="asidelist" id="list"></div>
            <div class="audioplay" id="play"></div>
    `

    // 創建標題
    let div=doccreate("div")
    div.classList.add("list")
    div.classList.add("grid")
    div.innerHTML=`
        <div class="tracklisttext no">序號</div>
        <div class="tracklisttext tracktitle">歌曲名稱</div>
        <div class="tracklisttext artists">演唱者</div>
        <div class="tracklisttext albumtitle">專輯名稱</div>
        <div class="tracklisttext time">歌曲時間</div>
        <div class="tracklisttext def">功能區</div>
    `
    docappendchild("list",div)

    let list=weblsget("list").split(",")
    if(list[0]!=""){
        let playingindex=weblsget("playingindex")
        let path=""
        for(let i=0;i<list.length;i=i+1){
            let id=list[i].split("_")

            let trackid=data["albums"][id[0]]["tracks"][id[1]]["id"]
            let tracktitle=data["albums"][id[0]]["tracks"][id[1]]["title"] // 歌曲標題
            let time=data["albums"][id[0]]["tracks"][id[1]]["duration"] // 歌曲時間
            let artists=data["albums"][id[0]]["tracks"][id[1]]["artists"].join(",") // 歌曲演唱者
            // 創建一個div放每個歌曲
            let div=doccreate("div")
            div.id="list_"+i
            div.classList.add("list")
            div.classList.add("grid")
            if(i==playingindex){ // 如果是該歌曲
                path=data["albums"][id[0]]["tracks"][id[1]]["path"] // 歌曲路徑
                div.classList.add("playing")
            }
            div.innerHTML=`
                <div class="tracklisttext no">${i+1}.</div>
                <div class="tracklisttext tracktitle">${tracktitle}</div>
                <div class="tracklisttext artists">${artists}</div>
                <div class="tracklisttext albumtitle">${data["albums"][id[0]]["title"]}</div>
                <div class="tracklisttext time">${time}</div>
                <div class="tracklisttext def"><input type="button" class="defbutton" data-id="${trackid}" data-no="${i+1}" value="-"></div>
            `
            if(id[2]=="ER"){
                weblsset("playingindex",weblsget("playingindex")+1)
                playingindex=playingindex+1
                div.innerHTML=div.innerHTML+`
                    <div class="playerror">此音樂已無法播放</div>
                `
            }
            docappendchild("list",div)
        }

        tracklistedit() // 刪除歌曲

        let div2=doccreate("div")
        div2.innerHTML=`
            <div class="playerdiv">
                <div class="icondiv" id="back"><img src="material/play-skip-back.svg" class="icon"></div>
                <div class="icondiv" id="palyandpause"><img src="material/play.svg" class="icon"></div>
                <div class="icondiv" id="forward"><img src="material/play-skip-forward.svg" class="icon"></div>
                <div class="icondiv" id="volume"><img src="material/volume-high.svg" class="icon"></div>
            </div>
            <audio class="player" id="player" controls>
                <source src="https://www.youtube.com/watch?v=by4SYYWlhEs?autoplay=1&controls=0" type="audio/mpeg">
            </audio>
        `
        docappendchild("play",div2)

        docgetid("player").addEventListener("keydown",function(event){
            if(event.key=="ArrowRight"){ // 向后跳转5秒
                event.preventDefault()
                docgetid("player").currentTime=docgetid("player").currentTime+2
            }
            if(event.key=="ArrowLeft"){ // 向前跳转5秒
                event.preventDefault()
                docgetid("player").currentTime=docgetid("player").currentTime-2
            }
        })

        docgetid("player").onerror=function(){
            alert("因此音樂無法撥放或損毀，將重新加載並自動撥放下一首音樂")
            let list=weblsget("list").split(",")
            let mainlist=[]
            for(let i=0;i<list.length;i=i+1){
                if(i==playingindex){
                    mainlist.push(list[i]+"_ER")
                }else{
                    mainlist.push(list[i])
                }
            }
            weblsset("list",mainlist.join(","))
            weblsset("playingindex",weblsget("playingindex")+1)
            createaside()
        }

        docgetid("player").onended=function(){
            weblsset("playingindex",weblsget("playingindex")+1)
        }

        docgetid("player").volume=0.5
    }else{
        let div=doccreate("div")
        div.classList.add("list")
        div.classList.add("warning")
        div.innerHTML=`
            目前無歌曲
        `
        docappendchild("list",div)
    }
}

function search(title,artist,album){
    let count=0
    let searchdata=data

    docgetid("main").innerHTML=`
        <div class="counter" id="counter"></div>
        <div class="list macossectiondiv" id="searchlist">
            <div class="tracklist grid">
                <div class="tracklisttext no">序號</div>
                <div class="tracklisttext tracktitle">歌曲名稱</div>
                <div class="tracklisttext artists">演唱者</div>
                <div class="tracklisttext albumtitle">專輯名稱</div>
                <div class="tracklisttext time">歌曲時間</div>
                <div class="tracklisttext def">功能區</div>
            </div>
        </div>
    ` // 把主區域消除及放入預設

    for(let i=0;i<searchdata["albums"].length;i=i+1){
        let track=searchdata["albums"][i]["tracks"]
        for(let j=0;j<track.length;j=j+1){
            if(regexpmatch(track[j]["title"],title[0],"gi")&&isset(title[0])){ // 判斷是否查詢結果
                let id=searchdata["albums"][i]["tracks"][j]["id"]
                let tracktitle=regexpreplace(searchdata["albums"][i]["tracks"][j]["title"],"<div class='searchresult'>$1</div>","("+title[0]+")","gi") // 替換成高亮
                let artists=searchdata["albums"][i]["tracks"][j]["artists"].join(",") // 歌曲作者
                let albumtitle=searchdata["albums"][i]["title"] // 專輯標題
                let time=searchdata["albums"][i]["tracks"][j]["duration"] // 歌曲時間

                let div=doccreate("div")
                div.id=i+"_"+j
                div.classList.add("tracklist")
                div.classList.add("grid")
                div.innerHTML=`
                    <div class="tracklisttext no">${count+1}</div>
                    <div class="tracklisttext tracktitle">${tracktitle}</div>
                    <div class="tracklisttext artists">${artists}</div>
                    <div class="tracklisttext albumtitle">${albumtitle}</div>
                    <div class="tracklisttext time">${time}</div>
                    <div class="tracklisttext def"><input type="button" class="defbutton" data-id="${id}" value="+"></div>
                `
                docappendchild("searchlist",div)
                count=count+1
            }
        }
    }

    if(count>0){
        tracklistedit() // 新增歌曲到播放清單
    }else{
        // 輸出查無歌曲提示
        let div=doccreate("div")
        div.classList.add("list")
        div.classList.add("warning")
        div.innerHTML=`
            查無歌曲
        `
        docappendchild("searchlist",div)
    }

    // 輸出結果筆數
    docgetid("counter").innerHTML=`
        結果: ${count} 筆
    `
}

function tracklistedit(key){
    docgetall(".defbutton").forEach(function(event){
        event.onclick=function(){
            let id=event.dataset.id // 歌曲id
            if(event.value=="+"){ // 新增專輯

                // 判斷專輯是否存在
                let list=weblsget("list").split(",")
                if(list.includes(id)){ alert("該專輯以存在於撥放清單") }
                else{
                    list.push(id)
                    weblsset("list",list.join(","))
                }
                conlog("success add in the track list! trackid="+id,"green","15","bold")
            }else if(event.value=="-"){ // 刪除專輯
                if(weblsget("playingindex")!=event.dataset.no||!playing){
                    let list=weblsget("list").split(",")
                    list.splice(list.indexOf(id),1) // 刪除資料
                    weblsset("list",list.join(",")) // 回復資料
                    createaside()
                    conlog("success delect in the track list! trackid="+id,"green","15","bold")
                }
            }else{ conlog("[ERROR]tracklistedit function event value error","red","15","bold") }
        }
    })
}

function playerfunction(){
    let palyer=docgetid("player")
    // if(palyer.paused){ palyer.play() }
}

let ajax=newajax("GET","albumlist.json")

ajax.onload=function(){
    data=JSON.parse(ajax.responseText) // 拿到data

    function main(){ // 主程式(起始)
        docgetid("main").innerHTML=`` // 清空主區域
        data["albums"].sort(function(a,b){ return a["title"].localeCompare(b["title"]) }) // 符合字典檔排序

        for(let i=0;i<data["albums"].length;i=i+1){
            let albumartistlist=data["albums"][i]["album_artists"] // 演奏者名字列表
            let albumtitle=data["albums"][i]["title"] // 專輯標題
            let cover=data["albums"][i]["cover"] // 封面
            if(!isset(cover)){ cover="cover/default.png" } // 如果沒有封面就要用預設的
            let albumartist=albumartistlist.join(",") // 將陣列變成字串

            // 設定每張專輯的div
            let div=doccreate("div")
            div.classList.add("album")
            div.id=i
            div.innerHTML=`
                <img src="${cover}" class="cover"><br>
                <div class="albumttext">
                    <div class="albumtitle">${albumtitle}</div>
                    <div class="albumartist">${albumartist}</div>
                </div>
            `
            docappendchild("main",div)
        }
        albummain() // 呼叫專輯內文
    }

    function albummain(){ // 專輯內文
        docgetall(".album").forEach(function(event){
            event.onclick=function(){ // 偵測專輯是否被點擊
                let id=event.id // 專輯id
                docgetid("main").innerHTML=`` // 清空主區域
                let albumartistlist=data["albums"][id]["album_artists"]
                let albumtitle=data["albums"][id]["title"]
                let cover=data["albums"][id]["cover"]
                if(!isset(cover)){ cover="cover/default.png" }
                let albumartist=albumartistlist.join(",")

                let date=data["albums"][id]["attr"]["pubdate"] // 拿到上傳的時間
                let publicdate
                if(!isset(date)){ publicdate="N/A" }
                else{ publicdate=date.split("-").join("/") } // 改成要求形式
                let totalbefore=0 // MM
                let totalafter=0 // SS
                let tracklength=data["albums"][id]["tracks"].length // 歌曲總數
                for(let i=0;i<tracklength;i=i+1){
                    // 判斷個專輯的時間並加總
                    let time=data["albums"][id]["tracks"][i]["duration"].split(":")
                    totalafter=totalafter+parseInt(time[1])
                    if(totalafter>=60){
                        totalafter=totalafter-60
                        totalbefore=totalbefore+1
                    }
                    totalbefore=totalbefore+parseInt(time[0])
                }
                if(totalafter<10){ totalafter="0"+totalafter }
                if(totalbefore<10){ totalbefore="0"+totalbefore }
                totaltime=totalbefore+":"+totalafter // 合併
                let albumdescription=data["albums"][id]["description"] // 專輯介紹

                // 印出結果
                docgetid("main").innerHTML=`
                    <div class="top">
                        <div class="menu">
                            <input type="button" class="menubutton" id="goback" value="index"> > ${albumtitle} 專輯詳細位置
                        </div>
                        <img src="${cover}" class="albumcover">
                        <div class="albumtext title">專輯名稱: ${albumtitle}</div>
                        <div class="albumtext artist">演唱者: ${albumartist}</div>
                        <div class="albumtext publicdate">發布日期: ${publicdate}</div>
                        <div class="albumtext trackslengthandtime">歌曲總數: ${tracklength} 專輯總時長: ${totaltime}</div>
                        <div class="albumtext albumdescription">專輯描述: ${albumdescription}</div>
                        <div class="albumplay icondiv" id="albumpaly"><img src="material/play.svg" class="albumicon"></div>
                    </div>
                    <div class="albummain macossectiondiv" id="albummain">
                        <div class="tracklist grid">
                            <div class="tracklisttext no">序號</div>
                            <div class="tracklisttext tracktitle">歌曲名稱</div>
                            <div class="tracklisttext artists">演唱者</div>
                            <div class="tracklisttext albumtitle">專輯名稱</div>
                            <div class="tracklisttext time">歌曲時間</div>
                            <div class="tracklisttext def">功能區</div>
                        </div>
                    </div>
                `

                for(let i=0;i<tracklength;i=i+1){
                    let trackid=data["albums"][id]["tracks"][i]["id"] // 歌曲標題
                    let tracktitle=data["albums"][id]["tracks"][i]["title"] // 歌曲標題
                    let time=data["albums"][id]["tracks"][i]["duration"] // 歌曲時間
                    let artists=data["albums"][id]["tracks"][i]["artists"].join(",") // 歌曲演唱者
                    let path=data["albums"][id]["tracks"][i]["path"] // 歌曲路徑

                    // 創建一個div放每個歌曲
                    let div=doccreate("div")
                    div.id=trackid
                    div.classList.add("tracklist")
                    div.classList.add("grid")
                    div.innerHTML=`
                        <div class="tracklisttext no">${i+1}</div>
                        <div class="tracklisttext tracktitle">${tracktitle}</div>
                        <div class="tracklisttext artists">${artists}</div>
                        <div class="tracklisttext albumtitle">${data["albums"][id]["title"]}</div>
                        <div class="tracklisttext time">${time}</div>
                        <div class="tracklisttext def"><input type="button" class="defbutton" data-id="${trackid}" value="+"></div>
                    `
                    docappendchild("albummain",div)
                }

                tracklistedit() // 新增歌曲到播放清單

                docgetid("goback").onclick=function(){
                    main() // 重呼叫(開啟主程式)
                }

                docgetid("albumpaly").onclick=function(){
                    if(confirm("確定是否取代播放清單成此專輯?")){
                        weblsset("list","")
                        weblsset("playingindex",0)
                        let list=[]
                        for(let i=0;i<tracklength;i=i+1){
                            let trackid=data["albums"][id]["tracks"][i]["id"] // 歌曲標題
                            list.push(trackid)
                        }
                        weblsset("list",list.join(","))
                    }
                }
            }
        })
    }

    docgetid("search").oninput=function(){
        // testing
        let value=docgetid("search").value
        let title=[]
        let artist=[]
        let album=[]

        if(regexpmatch(value,"title:","gi")){
            valuetemp=value.split("title:")
            title.push(valuetemp[1])
        }

        // for(let i=0;i<data["albums"].length;i=i+1){
        //     title.push(data["albums"][i]["title"])
        //     artist.push(data["albums"][i]["album_artists"].join(","))
        // }
        if(value.length>=3){ search(title,artist,album) }
        else{ main() }
    }

    main() // 開始主程式
}

docgetid("aside").style.width="0px"

// 設定aside的開啟及關閉
docgetid("openaside").onclick=function(){
    if(aside=="close"){
        docgetid("aside").style.width="55%"
        docgetid("openaside").style.left="55%"
        docgetid("openaside").value="<"
        let div=doccreate("div")
        div.classList.add("mask")
        div.id="asidemask"
        docgetall("body")[0].appendChild(div)
        aside="open"
        createaside()
    }else{
        docgetid("aside").style.width="0px"
        docgetid("openaside").style.left="0px"
        docgetid("openaside").value=">"
        docgetid("asidemask").remove()
        aside="close"
        docgetid("aside").innerHTML=``
    }
}

startmacossection()