let tool={
    name:["checkbox","button","submit","h1","h2","h3","h4","h5","h6","hr","br"],
    src:["checkbox","button","button","text","text","text","text","text","text","br","hr"],
    tag:["input","input","input","h1","h2","h3","h4","h5","h6","hr","br"],
    class:["checkbox","button","button","h1","h2","h3","h4","h5","h6","hr",""],
    id:["input","input","input","h1","h2","h3","h4","h5","h6","hr","br"],
    value:["","這是一個按鈕","送出","測試文本","測試文本","測試文本","測試文本","測試文本","測試文本","",""],
    ps:["inputtag","inputtag","inputtag","","","","","","","soletag","soletag"],
}
let toolid
let toolindex
let toollength

function appendchildmain(){
    let target=document.createElement(tool.tag[toolindex])
    if(tool.tag[toolindex]=="input"){ target.type=tool.name[toolindex] }
    target.className=tool.class[toolindex]
    target.id=tool.id[toolindex]
    target.name=tool.name[toolindex]
    if(tool.ps[toolindex]=="inputtag"){
        target.value=tool.value[toolindex]
    }else if(tool.ps[toolindex]=="soletag"){ }else{
        target.innerHTML=tool.value[toolindex]
    }
    document.getElementById("main").appendChild(target)
}

function ulclearall(){
    document.getElementById("ulmain").style.display="none"
    document.getElementById("ulinput").style.display="none"
    document.getElementById("ultext").style.display="none"
    document.getElementById("ulanthor").style.display="none"
}

document.getElementById("mode").onclick=function(){
    if(document.getElementById("mode").value=="一般模式"){
        document.getElementById("mode").value="開發者模式"
        document.querySelectorAll("br").forEach(function(event){
            event.classList.add("br")
        })
    }else{
        document.getElementById("mode").value="一般模式"
        document.querySelectorAll("br").forEach(function(event){
            event.classList.remove("br")
        })
    }
}

window.onload=function(){
    ulclearall()
    setTimeout(function(){
        document.getElementById("ulmaintext").onclick=function(){
            if(document.getElementById("ulmain").style.display=="none"){
                document.getElementById("ulmain").style.display="block"
            }else{
                ulclearall()
            }
        }
        document.getElementById("ulinputtext").onclick=function(){
            if(document.getElementById("ulinput").style.display=="none"){
                document.getElementById("ulinput").style.display="block"
            }else{
                document.getElementById("ulinput").style.display="none"
            }
        }
        document.getElementById("ultexttext").onclick=function(){
            if(document.getElementById("ultext").style.display=="none"){
                document.getElementById("ultext").style.display="block"
            }else{
                document.getElementById("ultext").style.display="none"
            }
        }
        document.getElementById("ulanthortext").onclick=function(){
            if(document.getElementById("ulanthor").style.display=="none"){
                document.getElementById("ulanthor").style.display="block"
            }else{
                document.getElementById("ulanthor").style.display="none"
            }
        }
        toollength=tool.name.length
        if((toollength==tool.tag.length)&&(toollength==tool.src.length)&&(toollength==tool.value.length)&&(toollength==tool.ps.length)&&(toollength==tool.class.length)&&(toollength==tool.id.length)&&(toollength==tool.ps.length)){
            console.log("[PASS] tool count success")
            document.querySelectorAll(".toolitem").forEach(function(event){
                event.addEventListener("dragstart",function(){
                    toolid=event.id
                    for(let i=0;i<toollength;i=i+1){
                        if(tool.name[i]==toolid){
                            toolindex=i
                            break
                        }
                    }
                })
            })

            document.querySelectorAll(".toolitem").forEach(function(event){
                event.addEventListener("dblclick",function(){
                    toolid=event.id
                    for(let i=0;i<toollength;i=i+1){
                        if(tool.name[i]==toolid){
                            toolindex=i
                            break
                        }
                    }
                    appendchildmain()
                })
            })

            for(let i=0;i<toollength;i=i+1){
                if(tool.src[i]!=""){
                    document.querySelectorAll(".toolicon")[i].src="icon/"+tool.src[i]+".png"
                }
            }

            document.getElementById("main").addEventListener("dragover",function(event){
                event.preventDefault()
            })

            document.getElementById("main").addEventListener("drop",appendchildmain)

            document.getElementById("downloadwebsite").onclick=function(){
                let alink=document.createElement("a")
                let htmlcontext=`
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <meta charset="UTF-8">
                            <title>Document</title>
                            <link rel="stylesheet" href="index.css">
                        </head>
                        <body>
                            ${ document.getElementById("main").innerHTML }
                            <script src="index.js"></script>
                        </body>
                    </html>
                `
                alink.download="index.html"
                alink.href="data:text/html,"+htmlcontext
                alink.click()
            }

            document.getElementById("download").onclick=function(){
                let alink=document.createElement("a")
                let downloadcontext="index.js"
                alink.download=downloadcontext
                alink.href=downloadcontext
                alink.click()
            }
        }else{
            document.getElementById("main").innerHTML=`
                <h1>程式錯誤請聯絡 @小賀chris#9517(DC) 謝謝</h1>
            `
            console.log("[WARNING] tool count error")
            console.log("tool.name.length="+tool.name.length)
            console.log("tool.src.length="+tool.src.length)
            console.log("tool.tag.length="+tool.tag.length)
            console.log("tool.value.length="+tool.value.length)
            console.log("tool.value.length="+tool.class.length)
            console.log("tool.value.length="+tool.id.length)
            console.log("tool.ps.length="+tool.ps.length)
        }
    },50);
}