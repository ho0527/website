let count=0
let aside="close" // 設定aside為關閉

let ajax=newajax("GET","albumlist.json")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText) // 拿到data

    data["albums"].sort(function(a,b){ return a["title"].localeCompare(b["title"]) }) // 符合字典檔排序

    for(let i=0;i<data["albums"].length;i=i+1){
        let albumartistlist=data["albums"][i]["album_artists"] // 演奏者名字列表
        let albumtitle=data["albums"][i]["title"] // 專輯標題
        let cover=data["albums"][i]["cover"] // 封面
        if(!isset(cover)){ cover="cover/default.png" } // 如果沒有封面就要用預設的
        let albumartist=albumartistlist.join(", ") // 將陣列變成字串

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

    docgetall(".album").forEach(function(event){
        event.onclick=function(){ // 偵測專輯是否被點擊
            let id=event.id // 專輯id
            docgetid("main").innerHTML=`` // 清空主區域
            let albumartistlist=data["albums"][id]["album_artists"]
            let albumtitle=data["albums"][id]["title"]
            let cover=data["albums"][id]["cover"]
            if(!isset(cover)){ cover="cover/default.png" }
            let albumartist=albumartistlist.join(", ")

            let date=data["albums"][id]["attr"]["pubdate"] // 拿到上傳的時間
            let publicdate
            if(!isset(date)){ publicdate="N/A" }
            else{ publicdate=date.split("-").join("/") } // 改成要求形式
            let totalbefore=0 // MM
            let totalafter=0 // SS
            let trackslength=data["albums"][id]["tracks"].length // 歌曲總數
            for(let i=0;i<trackslength;i=i+1){
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
                標題: ${albumtitle}<br>
                ${cover}<br>
                演唱者: ${albumartist}<br>
                發布日期: ${publicdate}<br>
                歌曲總數: ${trackslength}<br>
                專輯總時長: ${totaltime}<br>
                專輯描述: ${albumdescription}<br>
            `
        }
    })
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