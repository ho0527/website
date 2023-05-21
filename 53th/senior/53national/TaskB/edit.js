let width=localStorage.getItem("width")
let height=localStorage.getItem("height")
let mod="select"
let canva=document.getElementById("canva")
let undohistory=[]
let redohistory=[]
let isdrawing=false
let x=0
let y=0
let ctx=canva.getContext("2d")
let color="black"
let thick=1
let paintstin=1

canva.width=width
canva.height=height
document.getElementById("undo").disabled=true
document.getElementById("redo").disabled=true

function undo(){
    if(undohistory.length==0){ return }

    redohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    ctx.putImageData(undohistory.pop(),0,0)
    if(undohistory.length==0){ document.getElementById("undo").disabled=true }
    else{ document.getElementById("undo").disabled=false }
}

function redo(){
    if(redohistory.length==0){ return }

    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    ctx.putImageData(redohistory.pop(),0,0)
    if(redohistory.length==0){ document.getElementById("redo").disabled=true }
    else{ document.getElementById("redo").disabled=false }
}

function save(){
    // TODO: Implement save functionality
}

function savesample(){
    // TODO: Implement savesample functionality
}

function upload(){
    // TODO: Implement upload functionality
}

function drawline(canvactx,strokestyle,linewidth,x0,y0,x1,y1){
    canvactx.beginPath()
    canvactx.strokeStyle=strokestyle
    canvactx.lineWidth=linewidth
    canvactx.moveTo(x0,y0)
    canvactx.lineTo(x1,y1)
    canvactx.stroke()
}

function paintdown(event){
    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    redohistory.length=0
    document.getElementById("redo").disabled=true
    document.getElementById("undo").disabled=false
    x=event.offsetX
    y=event.offsetY
    isdrawing=true
}

function paintmove(event){
    if(isdrawing){
        drawline(ctx,color,thick,x,y,event.offsetX,event.offsetY)
        x=event.offsetX
        y=event.offsetY
    }
}

function paintup(event){
    if(isdrawing){
        drawline(ctx,color,thick,x,y,event.offsetX,event.offsetY)
        x=0
        y=0
        isdrawing=false
    }
}

function bucket(event){
    undohistory.push(ctx.getImageData(0,0,canva.width,canva.height))
    redohistory.length=0
    document.getElementById("redo").disabled=true
    document.getElementById("undo").disabled=false
    x=event.offsetX
    y=event.offsetY
    fillBucket(ctx,color,x,y)
}

function removealllistener(){
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
document.getElementById("savesample").onclick=function(){ savesample() }
document.getElementById("upload").onclick=function(){ upload() }
document.getElementById("black").style.borderColor="yellow"

document.getElementById("canva").addEventListener("keydown",function(event){
    if(event.ctrlKey&&event.key=="Z"){ undo() }
    if(event.ctrlKey&&event.shiftKey&&event.key=="Z"){ redo() }
})

document.querySelectorAll(".button").forEach(function(event){
    event.onclick=function(){
        mod=event.id
        document.querySelectorAll(".button").forEach(function(event){
            if(event.id==mod){ event.classList.add("selectbutton") }
            else{ event.classList.remove("selectbutton") }
        })

        if(mod=="paint"){
            removealllistener()
            canva.addEventListener("pointerdown",paintdown)
            canva.addEventListener("pointermove",paintmove)
            canva.addEventListener("pointerup",paintup)
        }else if(mod=="bucket"){
            removealllistener()
            canva.addEventListener("pointerdown",bucket)
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
        this.style.borderColor="yellow"
        color=this.id
    }
})

document.getElementById("thick").addEventListener("change",function(){
    thick=parseInt(this.value)
})

document.getElementById("rainbow").onclick=function(){

}