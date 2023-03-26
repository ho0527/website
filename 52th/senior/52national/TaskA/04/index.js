let imagecontainer=document.getElementById("imagecontainer")
let canva=document.getElementById("mycanvas")
let ctx=canva.getContext("2d")
let image=null
let scale=1

// function to draw the image on canva
function drawimageoncanva(image){
    canva.width=image.width*scale
    canva.height=image.height*scale
    ctx.drawImage(image,0,0,canva.width,canva.height)
}

// event listener for drag and drop
imagecontainer.addEventListener("dragover",function(event){
    event.preventDefault()
})

imagecontainer.addEventListener("drop",function(event){
    event.preventDefault()
    const file=event.dataTransfer.files[0]
    // 检查文件类型
    if (file.type=="image/png"||file.type=="image/jpeg") {
        const reader=new FileReader()
        reader.onload=function(loadevent){
            image=new Image()
            image.onload=function(){
                imagecontainer.classList.add("is-drop")
                drawimageoncanva(image)
            }
            image.src=loadevent.target.result
        }
        reader.readAsDataURL(file)
    } else {
        alert("只能上傳jpg或png圖檔")
    }
})

// button click event listeners
document.getElementById("plus").onclick=function(){
    if(image){
        scale=scale+0.5
        drawimageoncanva(image)
    }else{
        alert("please upload picture first")
    }
}

document.getElementById("minus").onclick=function(){
    if(image){
        if(scale>0) scale=scale-0.5
        else alert("scale 小於0")
        drawimageoncanva(image)
    }else{
        alert("please upload picture first")
    }
}

document.getElementById("undo").onclick=function(){
    if(image){
        ctx.rotate(-90 * Math.PI / 180)
        drawimageoncanva(image)
    }else{
        alert("please upload picture first")
    }
}

document.getElementById("redo").onclick=function(){
    if(image){
        ctx.rotate(90 * Math.PI / 180)
        drawimageoncanva(image)
    }else{
        alert("please upload picture first")
    }
}

document.getElementById("alth").onclick=function(){
    if(image){
        ctx.scale(-1,1)
        drawimageoncanva(image)
    }else{
        alert("please upload picture first")
    }
}

document.getElementById("altv").onclick=function(){
    if(image){
        ctx.scale(1,-1)
        drawimageoncanva(image)
    }else{
        alert("please upload picture first")
    }
}

document.getElementById("trash").onclick=function(){
    location.reload()
}

document.getElementById("download").onclick=function(){
    if(image){
        const a=document.createElement("a")
        a.href=canva.toDataURL("image/jpeg")
        a.download="image.jpg"
        a.click()
    }else{
        alert("please upload picture first")
    }
}
