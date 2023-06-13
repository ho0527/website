let width=localStorage.getItem("width")
let height=localStorage.getItem("height")
let mod="select"
let canva=document.getElementById("canva1")
let undohistory=[]
let redohistory=[]
let isdrawing=false
let x=0
let y=0
let ctx=canva.getContext("2d")
let color="black"
let thick=1
let paintstin=1
let x1=0
let y1=0
let x2=0
let y2=0
let canvacount=1
let sampleselect=""

document.getElementById("width").value=width
document.getElementById("height").value=height
canva.width=width
canva.height=height
canva.style.backgroundColor=localStorage.getItem("backgroundcolor")
if(localStorage.getItem("count")==null){ localStorage.setItem("count",0); }

function date(ymdlink,midlink,hmslink){
    let date=new Date()
    let year=date.getFullYear().toString().padStart(4,"0")
    let month=(date.getMonth()+1).toString().padStart(2,"0")
    let day=date.getDate().toString().padStart(2,"0")
    let hour=date.getHours().toString().padStart(2,"0")
    let minute=date.getMinutes().toString().padStart(2,"0")
    let second=date.getSeconds().toString().padStart(2,"0")

    return year+ymdlink+month+ymdlink+day+midlink+hour+hmslink+minute+hmslink+second
}

function undo(){
    if(undohistory.length==0){ return }

    redohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    ctx.putImageData(undohistory.pop(),0,0)
}

function redo(){
    if(redohistory.length==0){ return }

    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    ctx.putImageData(redohistory.pop(),0,0)
}

function save(){
    let alink=document.createElement("a")
    alink.href=canva.toDataURL("image/jpg")
    alink.download=date("","_","")+".jpg"
    alink.click()
}

function savesample(){
    data=canva.toDataURL("image/jpg")
    let count=parseInt(localStorage.getItem("count"))
    localStorage.setItem("image"+(count+1),data)
    localStorage.setItem("count",count+1)
    location.reload()
}

function upload(){
}

function selectdown(){

}

function selectmove(){

}

function selectup(){

}

function paintdown(event){
    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    redohistory.length=0
    ctx.strokeStyle=color
    ctx.lineWidth=thick
    x1=event.offsetX
    y1=event.offsetY
    ctx.lineCap="round"
    ctx.lineJoin="round"
    isdrawing=true
}

function paintmove(event){
    if(isdrawing){
        x2=event.offsetX
        y2=event.offsetY
        ctx.beginPath()
        ctx.moveTo(x1, y1)
        ctx.lineTo(x2, y2)
        ctx.stroke()
        x1=x2
        y1=y2
    }
}

function paintup(){
    if(isdrawing){
        isdrawing=false
    }
}

function bucket(event){
    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    redohistory.length=0
    x=event.offsetX
    y=event.offsetY
    fillBucket(ctx,color,x,y)
}

function sampledown(event){
    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    redohistory.length=0
    x=event.offsetX
    y=event.offsetY
    isdrawing=true
}

function samplemove(event){
    if(isdrawing){
        setTimeout(function(){
            drawline(ctx,color,thick,x,y,event.offsetX,event.offsetY)
            x=event.offsetX
            y=event.offsetY
        },500)
    }else{
        if(document.getElementById("mainimage")){
            document.getElementById("mainimage").style.top=(event.offsetY+50)+"px"
            document.getElementById("mainimage").style.left=(event.offsetX+50)+"px"
        }
    }
}

function sampleup(event){
    if(isdrawing){
        drawline(ctx,color,thick,x,y,event.offsetX,event.offsetY)
        x=0
        y=0
        isdrawing=false
    }
}

function removealllistener(){
    if(mod=="sample"&&document.getElementById("mainimage")){
        document.getElementById("mainimage").remove()
    }
    canva.removeEventListener("pointerdown",paintdown)
    canva.removeEventListener("pointermove",paintmove)
    canva.removeEventListener("pointerup",paintup)
    canva.removeEventListener("pointerdown",bucket)
}

function fillBucket(canvactx,color,x,y){
    let imageData=canvactx.getImageData(0,0,canva.width,canva.height)
    let pixels=imageData.data
    let width=canvactx.width
    let height=canvactx.height
    let targetColor=getPixelColor(pixels,width,height,x,y)
    let stack=[]
    stack.push({ x:x,y:y })

    while(stack.length>0){
        let pixel=stack.pop()
        let { x,y }=pixel

        if(x<0||x>=width||y<0||y>=height){ continue }

        let pixelColor=getPixelColor(pixels,width,height,x,y)

        if(pixelColor!=targetColor){ continue }

        // 填充当前像素
        setPixelColor(pixels,width,height,x,y,color)

        // 将相邻像素添加到堆栈
        stack.push({ x:x-1,y:y })
        stack.push({ x:x+1,y:y })
        stack.push({ x:x,y:y-1 })
        stack.push({ x:x,y:y+1 })
    }

    // 更新画布
    canvactx.putImageData(imageData,0,0)
    console.log("inini")
}

function getPixelColor(pixels,width,height,x,y){
    let index=(y*width+x)*4
    let r=pixels[index]
    let g=pixels[index+1]
    let b=pixels[index+2]
    return [r,g,b]
}

function setPixelColor(pixels,width,height,x,y,color){
    let index=(y*width+x)*4
    let [r,g,b]=color
    pixels[index]=r
    pixels[index+1]=g
    pixels[index+2]=b
}

document.getElementById("new").onclick=function(){ if(confirm("是否裡開編輯頁面?")){ location.href="index.html" } }
document.getElementById("undo").onclick=function(){ undo() }
document.getElementById("redo").onclick=function(){ redo() }
document.getElementById("save").onclick=function(){ save() }
document.querySelectorAll(".savesample").forEach(function(event){ event.onclick=function(){ savesample() } })
document.getElementById("uploadpicture").onclick=function(){ document.getElementById("file").click() }
document.getElementById("file").onchange=function(){ upload() }
document.getElementById("black").style.borderColor="yellow"
let count=parseInt(localStorage.getItem("count"))
console.log("count="+count)
for(let i=1;i<=count;i=i+1){
    document.getElementById("choosesample").innerHTML=document.getElementById("choosesample").innerHTML+`
        <img src="${localStorage.getItem("image"+i)}" class="sampleimage" draggable="false">
    `
}

document.addEventListener("keydown",function(event){
    if(event.ctrlKey&&event.key=="z"){ event.preventDefault();undo() }
    if(event.ctrlKey&&event.shiftKey&&event.key=="z"){ event.preventDefault();redo() }
    if(event.ctrlKey&&event.key=="s"){ event.preventDefault();save() }
    if(event.key=="Escape"){ event.preventDefault();location.reload() } 

})

document.querySelectorAll(".button").forEach(function(event){
    event.onclick=function(){
        mod=event.id
        document.querySelectorAll(".button").forEach(function(event){
            if(event.id==mod){ event.classList.add("selectbutton") }
            else{ event.classList.remove("selectbutton") }
        })
        if(mod=="select"){
            removealllistener()
            canva.addEventListener("pointerdown",selectdown)
            canva.addEventListener("pointermove",selectmove)
            canva.addEventListener("pointerup",selectup)
        }else if(mod=="paint"){
            removealllistener()
            canva.addEventListener("pointerdown",paintdown)
            canva.addEventListener("pointermove",paintmove)
            canva.addEventListener("pointerup",paintup)
        }else if(mod=="bucket"){
            removealllistener()
            canva.addEventListener("pointerdown",bucket)
        }else if(mod=="sample"){
            removealllistener()
            document.getElementById("samplelightbox").style.display="block"
            document.querySelectorAll(".sampleimage").forEach(function(event){
                if(sampleselect!=""){
                    if(event.src==sampleselect){
                        event.style.border="1px yellow solid"
                    }
                }
                event.onclick=function(){
                    document.querySelectorAll(".sampleimage").forEach(function(event){
                        event.style.border="1px black solid"
                    })
                    event.style.border="1px yellow solid"
                }
            })
            canva.addEventListener("pointerdown",sampledown)
            canva.addEventListener("pointermove",samplemove)
            canva.addEventListener("pointerup",sampleup)
        }else if(mod=="setcanva"){
            removealllistener()
        }else{
            removealllistener()
        }
    }
    if(event.id==mod){ event.classList.add("selectbutton") }
    else{ event.classList.remove("selectbutton") }
})

document.querySelectorAll(".color").forEach(function(event){
    event.style.width=getComputedStyle(event).getPropertyValue("height")
    event.style.backgroundColor=event.id
    event.onclick=function(){
        document.querySelectorAll(".color").forEach(function(event2){
            event2.style.borderColor="black"
        })
        document.getElementById("rainbow").style.borderColor="black"
        this.style.borderColor="yellow"
        color=this.id
        if(mod=="setcanva"){
            canva.style.backgroundColor=color
            localStorage.setItem("backgroundcolor",color)
        }
    }
})

document.getElementById("rainbow").onchange=function(){
    color=this.value
    document.querySelectorAll(".color").forEach(function(event2){
        event2.style.borderColor="black"
    })
    this.style.borderColor="yellow"
    if(mod=="setcanva"){
        canva.style.backgroundColor=color
        localStorage.setItem("backgroundcolor",color)
    }
}

document.getElementById("thick").onchange=function(){ thick=parseInt(this.value) }

document.getElementById("newlayer").onclick=function(){
    canvacount=canvacount+1
    let tr=document.createElement("tr")
    tr.classList.add("layer")
    tr.id="layertr"+canvacount
    tr.draggable=true
    document.getElementById("layer").appendChild(tr)
    let tdname=document.createElement("td")
    tdname.classList.add("layername")
    tdname.innerHTML=`
        圖層${canvacount}
    `
    document.getElementById("layertr"+canvacount).appendChild(tdname)
    let tddef=document.createElement("td")
    tddef.classList.add("layerdef")
    tddef.innerHTML=`
        <input type="button" class="layeredit" value="編輯">
        <input type="button" class="layerdel" data-id="${canvacount}" value="刪除">
    `
    document.getElementById("layertr"+canvacount).appendChild(tddef)
    let tdmove=document.createElement("td")
    tdmove.classList.add("layermove")
    document.getElementById("layertr"+canvacount).appendChild(tdmove)
    let canvas=document.createElement("canvas")
    canvas.classList.add("canva")
    canvas.id="canva"+canvacount
    document.getElementById("main").appendChild(canvas)
    document.querySelectorAll(".layerdel").forEach(function(event){
        event.onclick=function(){
            let id=this.getAttribute("data-id")
            document.getElementById("layertr"+id).innerHTML=``
            document.getElementById("canva"+id).style.display="none"
        }
    })
}

document.querySelectorAll(".layerdel").forEach(function(event){
    event.onclick=function(){
        let id=this.getAttribute("data-id")
        document.getElementById("layertr"+id).innerHTML=``
        document.getElementById("canva"+id).style.display="none"
    }
})

document.getElementById("uplaodsample").onclick=function(){ document.getElementById("samplefile").click() }

document.getElementById("samplefile").onchange=function(event){
    let file=event.target.files[0]
    let reader=new FileReader()
    reader.onload=function(){
        let count=parseInt(localStorage.getItem("count"))
        localStorage.setItem("image"+(count+1),reader.result)
        localStorage.setItem("count",count+1)
    }
    reader.readAsDataURL(file)
    location.reload()
}

document.getElementById("samplesubmit").onclick=function(){
    document.querySelectorAll(".sampleimage").forEach(function(event){
        if(event.style.border=="1px solid yellow"){
            if(document.getElementById("mainimage")){ document.getElementById("mainimage").remove() }
            sampleselect=event.src
            img=document.createElement("img")
            img.src=sampleselect
            img.id="mainimage"
            img.style.position="absolute"
            img.style.opacity=0.5
            document.getElementById("main").appendChild(img)
        }
        document.getElementById("samplelightbox").style.display="none"
    })
}

document.getElementById("close").onclick=function(){ document.getElementById("samplelightbox").style.display="none" }

document.addEventListener("pointerup",function(){ if(isdrawing){ isdrawing=false } })

document.getElementById("submit").onclick=function(){
    let width=document.getElementById("width").value
    let height=document.getElementById("height").value
    if(/^[0-9]+$/.test(width)&&/^[0-9]+$/.test(height)){
        location.href="edit.html"
        localStorage.setItem("width",width)
        localStorage.setItem("height",height)
    }else{ alert("長寬要是整數") }
}