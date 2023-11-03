let aside="close" // 設定aside為關閉
let playing=false
let data

if(!isset(weblsget("50nationalmodulealist"))){ weblsset("50nationalmodulealist","") }
if(!isset(weblsget("50nationalmoduleaplayingindex"))){ weblsset("50nationalmoduleaplayingindex",0) }

function main(){ // 主程式(起始)
    docgetid("main").innerHTML=`` // 清空主區域
    data["albums"].sort(function(a,b){ return a["title"].localeCompare(b["title"]) }) // 符合字典檔排序

    for(let i=0;i<data["albums"].length;i=i+1){
        let albumartistlist=data["albums"][i]["album_artists"] // 演奏者名字列表
        let albumtitle=data["albums"][i]["title"] // 專輯標題
        let cover=data["albums"][i]["cover"] // 封面
        if(!isset(cover)){ cover="cover/default.png" }// 如果沒有封面就要用預設的
        let albumartist=albumartistlist.join(",") // 將陣列變成字串

        // 設定每張專輯的div
        docgetid("main").innerHTML=`
            ${docgetid("main").innerHTML}
            <div class="album" id="${i}">
                <img src="${cover}" class="cover" draggable="false"><br>
                <div class="albumttext">
                    <div class="albumtitle">${albumtitle}</div>
                    <div class="albumartist">${albumartist}</div>
                </div>
            </div>
        `
    }
    // 專輯內文
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
            else{ publicdate=date.split("-").join("/") }// 改成要求形式
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
                        <input type="button" class="menubutton" id="goback" value="index"> > ${albumtitle}專輯詳細位置
                    </div>
                    <img src="${cover}" class="albumcover">
                    <div class="albumtext title">專輯名稱:${albumtitle}</div>
                    <div class="albumtext artist">演唱者:${albumartist}</div>
                    <div class="albumtext publicdate">發布日期:${publicdate}</div>
                    <div class="albumtext trackslengthandtime">歌曲總數:${tracklength}專輯總時長:${totaltime}</div>
                    <div class="albumtext albumdescription">專輯描述:${albumdescription}</div>
                    <div class="albumplay icondiv" id="albumpaly"><img src="material/icon/play.svg" class="albumicon"></div>
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
                docgetid("albummain").innerHTML=`
                    ${docgetid("albummain").innerHTML}
                    <div class="tracklist grid" id="${trackid}">
                        <div class="tracklisttext no">${i+1}</div>
                        <div class="tracklisttext tracktitle">${tracktitle}</div>
                        <div class="tracklisttext artists">${artists}</div>
                        <div class="tracklisttext albumtitle">${data["albums"][id]["title"]}</div>
                        <div class="tracklisttext time">${time}</div>
                        <div class="tracklisttext def"><input type="button" class="defbutton" data-id="${trackid}" value="+"></div>
                    </div>
                `
            }

            tracklistedit() // 新增歌曲到播放清單

            docgetid("goback").onclick=function(){
                main() // 重呼叫(開啟主程式)
            }

            docgetid("albumpaly").onclick=function(){
                if(confirm("確定是否取代播放清單成此專輯?")){
                    weblsset("50nationalmodulealist","")
                    weblsset("50nationalmoduleaplayingindex",0)
                    let list=[]
                    for(let i=0;i<tracklength;i=i+1){
                        let trackid=data["albums"][id]["tracks"][i]["id"] // 歌曲標題
                        list.push(trackid)
                    }
                    weblsset("50nationalmodulealist",list.join(","))
                }
            }
        }
    })
}

function createaside(){
    let list=weblsget("50nationalmodulealist").split(",") // 播放列表

    docgetid("aside").innerHTML=`
            <div class="asidelist macossectiondiv" id="list"></div>
            <div class="audioplay" id="play"></div>
    `

    // 創建標題
    docgetid("list").innerHTML=`
        ${docgetid("list").innerHTML}
        <div class="list grid">
            <div class="tracklisttext no">序號</div>
            <div class="tracklisttext tracktitle">歌曲名稱</div>
            <div class="tracklisttext artists">演唱者</div>
            <div class="tracklisttext albumtitle">專輯名稱</div>
            <div class="tracklisttext time">歌曲時間</div>
            <div class="tracklisttext def">功能區</div>
        </div>
    `

    if(list[0]!=""){
        let playingindex=weblsget("50nationalmoduleaplayingindex")
        let path=""
        for(let i=0;i<list.length;i=i+1){
            let id=list[i].split("_")
            let trackid=data["albums"][id[0]]["tracks"][id[1]]["id"]
            let tracktitle=data["albums"][id[0]]["tracks"][id[1]]["title"] // 歌曲標題
            let time=data["albums"][id[0]]["tracks"][id[1]]["duration"] // 歌曲時間
            let artists=data["albums"][id[0]]["tracks"][id[1]]["artists"].join(",") // 歌曲演唱者
            let divinnerhtml=``
            let listdivclasslist="list grid"

            if(i==playingindex){ // 如果是該歌曲
                path=data["albums"][id[0]]["tracks"][id[1]]["path"] // 歌曲路徑
                listdivclasslist=listdivclasslist+" playing"
            }

            if(id[2]=="ER"){ // 偵測是否為不可撥放歌曲
                weblsset("50nationalmoduleaplayingindex",weblsget("50nationalmoduleaplayingindex")+1)
                playingindex=playingindex+1
                divinnerhtml=`
                    <div class="playerror">此音樂已無法播放</div>
                `
            }else{
                divinnerhtml=`
                    <div class="tracklisttext no">${i+1}.</div>
                    <div class="tracklisttext tracktitle">${tracktitle}</div>
                    <div class="tracklisttext artists">${artists}</div>
                    <div class="tracklisttext albumtitle">${data["albums"][id[0]]["title"]}</div>
                    <div class="tracklisttext time">${time}</div>
                    <div class="tracklisttext def"><input type="button" class="defbutton" data-id="${trackid}" data-no="${i+1}" value="-"></div>
                `
            }

            // 創建一個div放每個歌曲
            docgetid("list").innerHTML=`
                ${docgetid("list").innerHTML}
                <div class="${listdivclasslist}" id="list_${i}">
                    ${divinnerhtml}
                </div>
            `
        }

        tracklistedit() // 刪除歌曲

        docgetid("play").innerHTML=`
            ${docgetid("play").innerHTML}
            <div>
                <div class="playerdiv">
                    <div class="icondiv" id="back"><img src="material/icon/play-skip-back.svg" class="icon"></div>
                    <div class="icondiv" id="palypause"><img src="material/icon/play.svg" class="icon" id="palypauseicon"></div>
                    <div class="icondiv" id="forward"><img src="material/icon/play-skip-forward.svg" class="icon"></div>
                    <div class="icondiv" id="volume"><img src="material/icon/volume-high.svg" class="icon"></div>
                </div>
                <audio class="player" id="player" controls>
                    <source src="https://www.youtube.com/watch?v=by4SYYWlhEs?autoplay=1&controls=0" type="audio/mpeg">
                </audio>
            </div>
        `

        docgetid("back").onclick=function(){

        }

        docgetid("palypause").onclick=function(){
            if(playing){
                docgetid("palypauseicon").src="material/icon/play.svg"
                playing=false
            }else{
                docgetid("palypauseicon").src="material/icon/pause.svg"
                playing=true
            }
        }

        docgetid("forward").onclick=function(){

        }

        docgetid("volume").onclick=function(){
            // docgetid("volumerange")
        }

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
            let list=weblsget("50nationalmodulealist").split(",")
            let mainlist=[]
            for(let i=0;i<list.length;i=i+1){
                if(i==playingindex){
                    mainlist.push(list[i]+"_ER")
                }else{
                    mainlist.push(list[i])
                }
            }
            weblsset("50nationalmodulealist",mainlist.join(","))
            weblsset("50nationalmoduleaplayingindex",weblsget("50nationalmoduleaplayingindex")+1)
            createaside()
        }

        docgetid("player").onended=function(){
            weblsset("50nationalmoduleaplayingindex",weblsget("50nationalmoduleaplayingindex")+1)
        }

        docgetid("player").volume=0.5
    }else{
        docgetid("list").innerHTML=`
            ${docgetid("list").innerHTML}
            <div class="list warning">
                目前無歌曲
            </div>
        `
    }

    // 設定aside的開啟及關閉
    docgetid("openaside").onclick=function(){
        if(aside=="close"){
            docgetid("aside").style.width="55%"
            docgetid("openaside").style.left="55%"
            docgetid("openaside").value="<"
            docgetid("body").innerHTML=`
                ${docgetid("body").innerHTML}
                <div class="mask" id="asidemask"></div>
            `
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
}

function search(title,artist,album){
    let count=0
    let searchdata=data

    // 解析搜尋條件
    let part=title.concat(artist,album).join(" ").split(" ")
    let term={
        title:[],
        artist:[],
        album:[],
    }

    let field="title" // 預設為標題(title)

    part.forEach(function(event){
        if(event.startsWith("title:")){
            field="title"
            term.title.push(event.substring(6)) // 移除 "title:"
        }else if(event.startsWith("artist:")){
            field="artist"
            term.artist.push(event.substring(7)) // 移除 "artist:"
        }else if(event.startsWith("album:")){
            field="album"
            term.album.push(event.substring(6)) // 移除 "album:"
        }else{
            // 如果不是以上指定的欄位搜尋，將該部分加入當前的搜尋欄位中
            term[field].push(event)
        }
    })


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
            let titlematch=false
            let artistmatch=false
            let albummatch=false

            // 檢查是否符合搜尋條件
            if(term.title.length>0){
                titlematch=term.title.some(function(term){ return track[j]["title"].match(new RegExp(term,"gi")) })
            }else{
                titlematch=true // 沒有 title 條件時，預設為 true
            }

            if(term.artist.length>0){
                artistmatch=term.artist.some(function(term){ return track[j]["artists"].join(",").match(new RegExp(term,"gi")) })
            }else{
                artistmatch=true // 沒有 artist 條件時，預設為 true
            }

            if(term.album.length>0){
                albummatch=term.album.some(function(term){ return searchdata["albums"][i]["title"].match(new RegExp(term,"gi")) })
            }else{
                albummatch=true // 沒有 album 條件時，預設為 true
            }

            if(titlematch&&artistmatch&&albummatch){
                let id=searchdata["albums"][i]["tracks"][j]["id"]
                let tracktitle = searchdata["albums"][i]["tracks"][j]["title"].replace(new RegExp("("+title.concat(artist,album).join(" ")+")","gi"),"<div class='searchresult'>$1</div>") // 替換成高亮
                let artists=searchdata["albums"][i]["tracks"][j]["artists"].join(",") // 歌曲作者
                let albumtitle=searchdata["albums"][i]["title"] // 專輯標題
                let time=searchdata["albums"][i]["tracks"][j]["duration"] // 歌曲時間

                docgetid("searchlist").innerHTML=`
                    ${docgetid("searchlist").innerHTML}
                    <div class="tracklist grid" id=${id}>
                        <div class="tracklisttext no">${count+1}</div>
                        <div class="tracklisttext tracktitle">${tracktitle}</div>
                        <div class="tracklisttext artists">${artists}</div>
                        <div class="tracklisttext albumtitle">${albumtitle}</div>
                        <div class="tracklisttext time">${time}</div>
                        <div class="tracklisttext def"><input type="button" class="defbutton" data-id="${id}" value="+"></div>
                    </div>
                `
                count=count+1
            }
        }
    }

    if(count>0){
        tracklistedit() // 新增歌曲到播放清單
    }else{
        docgetid("searchlist").innerHTML=`
            ${docgetid("searchlist").innerHTML}
            <div class="list warning">
                查無歌曲
            </div>
        `
    }

    // 輸出結果筆數
    docgetid("counter").innerHTML=`
        結果:${count}筆
    `
}

function tracklistedit(key){
    docgetall(".defbutton").forEach(function(event){
        event.onclick=function(){
            let id=event.dataset.id // 歌曲id
            if(event.value=="+"){ // 新增專輯

                // 判斷專輯是否存在
                let list=weblsget("50nationalmodulealist").split(",")
                if(list.includes(id)){ alert("該專輯以存在於撥放清單") }
                else{
                    list.push(id)
                    weblsset("50nationalmodulealist",list.join(","))
                }
                conlog("success add in the track list! trackid="+id,"green","15","bold")
            }else if(event.value=="-"){ // 刪除專輯
                if(weblsget("50nationalmoduleaplayingindex")!=event.dataset.no||!playing){
                    let list=weblsget("50nationalmodulealist").split(",")
                    list.splice(list.indexOf(id),1) // 刪除資料
                    weblsset("50nationalmodulealist",list.join(",")) // 回復資料
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

newajax("GET","albumlist.json").onload=function(){
    data=JSON.parse(this.responseText) // 拿到data

    docgetid("search").oninput=function(){
        let value=docgetid("search").value
        let title=[]
        let artist=[]
        let album=[]
    
        if(value.match(new RegExp("title:","gi"))){
            valuetemp=value.split("title:")
            title.push(valuetemp[1])
        }
    
        if(value.match(new RegExp("artist:","gi"))){
            valuetemp=value.split("artist:")
            artist.push(valuetemp[1])
        }
    
        if(value.match(new RegExp("album:","gi"))){
            valuetemp=value.split("album:")
            album.push(valuetemp[1])
        }
    
        if(value.length>=3){
            search(title,artist,album)
        }else{
            main()
        }
    }

    main() // 開始主程式
}

// 設定aside的開啟及關閉
docgetid("openaside").onclick=function(){
    if(aside=="close"){
        docgetid("aside").style.width="55%"
        docgetid("openaside").style.left="55%"
        docgetid("openaside").value="<"
        docgetid("body").innerHTML=`
            ${docgetid("body").innerHTML}
            <div class="mask" id="asidemask"></div>
        `
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