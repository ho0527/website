let count=0
let aside="close" // 設定aside為關閉

let ajax=newajax("GET","albumlist.json")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText) // 拿到data

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
                    let tracktitle=data["albums"][id]["tracks"][i]["title"] // 歌曲標題
                    let time=data["albums"][id]["tracks"][i]["duration"] // 歌曲時間
                    let artists=data["albums"][id]["tracks"][i]["artists"].join(",") // 歌曲演唱者
                    let path=data["albums"][id]["tracks"][i]["path"] // 歌曲路徑

                    // 創建一個div放每個歌曲
                    let div=doccreate("div")
                    div.id=id+"_"+i
                    div.classList.add("tracklist")
                    div.classList.add("grid")
                    div.innerHTML=`
                        <div class="tracklisttext no">${i+1}</div>
                        <div class="tracklisttext tracktitle">${tracktitle}</div>
                        <div class="tracklisttext artists">${artists}</div>
                        <div class="tracklisttext albumtitle">${data["albums"][id]["title"]}</div>
                        <div class="tracklisttext time">${time}</div>
                        <div class="tracklisttext def"><input type="button" value="add to list"></div>
                    `
                    docappendchild("albummain",div)
                }

                docgetid("goback").onclick=function(){
                    main() // 重呼叫(開啟主程式)
                }
            }
        })
    }
    main() // 開始主程式
}

docgetid("aside").style.width="0px"

// 設定aside的開啟及關閉
docgetid("openaside").onclick=function(){
    if(aside=="close"){
        docgetid("aside").style.width="45%"
        docgetid("openaside").style.left="45%"
        docgetid("openaside").value="<"
        let div=doccreate("div")
        div.classList.add("mask")
        div.id="asidemask"
        docgetall("body")[0].appendChild(div)
        aside="open"
    }else{
        docgetid("aside").style.width="0px"
        docgetid("openaside").style.left="0px"
        docgetid("openaside").value=">"
        docgetid("asidemask").remove()
        aside="close"
    }
}

startmacossection()


// <audio></audio>