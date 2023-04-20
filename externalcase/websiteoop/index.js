let tool={
    name:["inputbox","checkbox","button","submit","p","h1","h2","h3","h4","h5","h6","br","hr"],
    src:["inputbox","checkbox","button","button","p","text","text","text","text","text","text","br","hr"],
    tag:["input","input","input","input","p","h1","h2","h3","h4","h5","h6","br","hr"],
    class:["input","checkbox","button","button","p","h1","h2","h3","h4","h5","h6","","hr"],
    id:["input","input","input","input","p","h1","h2","h3","h4","h5","h6","br","hr"],
    value:["這是一個文字","","這是一個按鈕","送出","測試文本","測試文本","測試文本","測試文本","測試文本","測試文本","測試文本","",""],
    ps:["inputtag","inputtag","inputtag","inputtag","","","","","","","","soletag","soletag"],
}
let toolid
let toolindex
let toollength
let oopmode=document.getElementById("oopmode")

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
    document.getElementById("oopmain").appendChild(target)
}

function ulclearall(){
    document.getElementById("oopulmain").style.display="none"
    document.getElementById("oopulinput").style.display="none"
    document.getElementById("oopultext").style.display="none"
    document.getElementById("oopulanthor").style.display="none"
}

oopmode.onclick=function(){
    if(oopmode.value=="一般模式"){
        oopmode.value="開發者模式"
        document.querySelectorAll("br").forEach(function(event){
            event.classList.add("br")
        })
    }else{
        oopmode.value="一般模式"
        document.querySelectorAll("br").forEach(function(event){
            event.classList.remove("br")
        })
    }
}

window.onload=function(){
    ulclearall()
    setTimeout(function(){
        document.getElementById("oopulmaintext").onclick=function(){
            if(document.getElementById("oopulmain").style.display=="none"){
                document.getElementById("oopulmain").style.display="block"
            }else{
                ulclearall()
            }
        }
        document.getElementById("oopulinputtext").onclick=function(){
            if(document.getElementById("oopulinput").style.display=="none"){
                document.getElementById("oopulinput").style.display="block"
            }else{
                document.getElementById("oopulinput").style.display="none"
            }
        }
        document.getElementById("oopultexttext").onclick=function(){
            if(document.getElementById("oopultext").style.display=="none"){
                document.getElementById("oopultext").style.display="block"
            }else{
                document.getElementById("oopultext").style.display="none"
            }
        }
        document.getElementById("oopulanthortext").onclick=function(){
            if(document.getElementById("oopulanthor").style.display=="none"){
                document.getElementById("oopulanthor").style.display="block"
            }else{
                document.getElementById("oopulanthor").style.display="none"
            }
        }
        toollength=tool.name.length
        if((toollength==tool.tag.length)&&(toollength==tool.src.length)&&(toollength==tool.value.length)&&(toollength==tool.ps.length)&&(toollength==tool.class.length)&&(toollength==tool.id.length)&&(toollength==tool.ps.length)){
            console.log("[PASS] tool count success")
            document.querySelectorAll(".toolitem").forEach(function(event){
                event.addEventListener("dragstart",function(){
                    toolid=event.id
                    console.log("toolid="+toolid)
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

            document.getElementById("oopmain").addEventListener("dragover",function(event){
                event.preventDefault()
            })

            document.getElementById("oopmain").addEventListener("drop",appendchildmain)

            document.getElementById("oopdownloadwebsite").onclick=function(){
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
                            ${ document.getElementById("oopmain").innerHTML }
                            <script src="index.js"></script>
                        </body>
                    </html>
                `
                alink.download="index.html"
                alink.href="data:text/html,"+htmlcontext
                alink.click()
            }

            document.getElementById("oopdownload").onclick=function(){
                let alink=document.createElement("a")
                let downloadcontext="index.js"
                alink.download=downloadcontext
                alink.href=downloadcontext
                alink.click()
            }
        }else{
            document.getElementById("oopmain").innerHTML=`
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