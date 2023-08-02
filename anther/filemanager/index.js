let mainfolder="upload"
let folderlist
let folder
let locaitonfolderdata=""

function main(){
    folderlist=[mainfolder]
    folder=mainfolder+"/"

    if(isset(location.href.split("#")[1])){
        locaitonfolderdata=location.href.split("#")[1]
        folder=folder+locaitonfolderdata
        for(let i=0;i<locaitonfolderdata.split("/").length;i=i+1){
            if(isset(locaitonfolderdata.split("/")[i])){
                folderlist.push(locaitonfolderdata.split("/")[i])
            }
        }
    }

    let ajax=newajax("GET","filelist.php?folder="+folder)

    ajax.onload=function(){
        let data=JSON.parse(this.responseText)
        let folderpath=""

        if(data["success"]){
            for(let i=0;i<folderlist.length;i=i+1){
                folderpath=folderpath+"<div class=\"pathlink\" id=\""+i+"\">"+folderlist[i]+"</div>"+"/"
            }

            docgetall("pathlink").forEach(function(event){
                // event.onclick=function(){
                //     location.href="#"+folderlist.join("/")+"/"+event.innerText
                //     location.reload()
                // }
            })

            docgetid("pathlist").innerHTML=`${folderpath}`

            if(folderlist.length==1){
                docgetid("pathgoback").innerHTML=`已經在最前一頁了`
            }else{
                docgetid("pathgoback").innerHTML=`
                    <div class="goback" id="goback">回到上一頁</div>
                `
                docgetid("goback").onclick=function(){
                    folderlist.pop()
                    console.log(folderlist)
                    if(folderlist.length>1){
                        location.href="#"+folderlist.join("/")
                        location.reload()
                    }else{
                        location.href=""
                    }
                }
            }

            docgetid("filelist").innerHTML=``
            for(let i=0;i<data["filelist"].length;i=i+1){
                let filelist=data["filelist"]

                let div=doccreate("div")
                div.classList.add("fileitem")
                div.classList.add("grid")

                let div2=doccreate("div")
                div2.classList.add("filename")

                if(filelist[i]["isfolder"]){
                    div2.innerHTML=filelist[i]["name"]
                    div2.classList.add("folder")
                    div2.onclick=function(){
                        location.href="#"+locaitonfolderdata+filelist[i]["name"]
                        location.reload()
                    }
                }else{
                    div2.innerText=filelist[i]["name"]
                }

                let div3=doccreate("div")
                div3.classList.add("fileitembuttondiv")

                if (!filelist[i]["isfolder"]) {
                    let input=doccreate("input")
                    input.classList.add("fileitembutton")
                    input.classList.add("bluebutton")
                    input.type="button"
                    input.value="下載"
                    input.onclick=function(){
                        let a=doccreate("a")
                        a.href=folderlist.join("/")+"/"+filelist[i]["name"]
                        a.download=filelist[i]["name"]
                        a.click()
                    }
                    div3.appendChild(input)
                }

                let deleteButton=doccreate("button")
                deleteButton.classList.add("fileitembutton")
                deleteButton.classList.add("bluebutton")
                deleteButton.innerText="刪除"
                deleteButton.addEventListener("click",() => {
                    deleteFile(filelist[i]["name"],filelist[i]["isfolder"])
                })
                div3.appendChild(deleteButton)

                div.appendChild(div2)
                div.appendChild(div3)

                docgetid("filelist").appendChild(div)
            }
        }else{
            docgetid("pathgoback").innerHTML=`
                <div class="goback" id="goback">回到最前頁</div>
            `
            docgetid("filelist").innerHTML=`<div class="warning">查無此路徑</div>`
            docgetid("goback").onclick=function(){
                location.href=""
            }
        }
    }
}

function deleteFile(fileName,isFolder) {
    Swal.fire({
        title: "確定刪除?",
        text: "刪除後將無法恢復。",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "確定",
        cancelButtonText: "取消",
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`delete.php?file=${fileName}&isfolder=${isFolder}`,{
                method: "DELETE",
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            title: "刪除成功",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(function () {
                            location.reload()
                        })
                    } else {
                        Swal.fire({
                            title: "刪除失敗",
                            text: "請稍後再試。",
                            icon: "error",
                            confirmButtonText: "確定",
                        })
                    }
                })
                .catch((error) => {
                    console.error("Error:",error)
                })
        }
    })
}

docgetid("submit").onclick=function(){
    lightbox(null,"uploading",function(){
        return `
            <h2>UPLOADING...</h2>
            <div id="percent"></div>
            <progress id="progress" max="100" value="0"></progress>
        `
    })
    let ajax=newajax("POST","upload.php",new FormData(docgetid("form")))
    ajax.upload.addEventListener("progress",function(event){
        if(event.lengthComputable){
            let percent=(event.loaded/event.total)*100
            docgetid("progress").value=percent
            if(percent==100){
                docgetid("percent").innerHTML=`
                    已完成上傳!
                `
            }else{
                docgetid("percent").innerHTML=`
                    已完成: ${percent}%
                `
            }
        }
    },false)
    ajax.onload=function(){
        if(ajax.readyState==4){
            if(ajax.status==200){
                let response=JSON.parse(ajax.responseText)
                if(response.success){
                    Swal.fire({
                        title: "Upload Success",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function(){
                        docgetid("filelist").innerHTML=""
                        docgetid("progress").value=0
                        location.reload()
                    })
                }else{
                    Swal.fire({
                        title: "Upload Failed",
                        text: response.message,
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then(function(){
                        docgetid("progress").value=0
                        docgetid("fileinput").disabled=false
                        docgetid("folderinput").disabled=false
                    })
                }
            }else{
                Swal.fire({
                    title: "Upload Failed",
                    text: "ajax staues get an error",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(function(){
                    docgetid("progress").value=0
                    docgetid("fileinput").disabled=false
                    docgetid("folderinput").disabled=false
                })
            }
        }
    }
}

setInterval(function(){
    main()
},3000000)

main()

startmacossection()