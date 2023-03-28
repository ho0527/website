let imagecontainer=document.getElementById("imagecontainer")
let canva=document.getElementById("mycanvas")
let image=null
let scale=1
let rotate=0
let altx=false
let alty=false

function drawimage(image){
    canva.width=image.width*scale
    canva.height=image.height*scale
    canva.getContext("2d").drawImage(image,0,0,canva.width,canva.height)
}

imagecontainer.addEventListener("dragover",function(event){
    event.preventDefault()
})

imagecontainer.addEventListener("drop",function(event){
    event.preventDefault()
    let file=event.dataTransfer.files[0]
    if(file.type=="image/png"||file.type=="image/jpeg"){
        let reader=new FileReader()
        reader.onload=function(loadevent){
            image=new Image()
            image.onload=function(){
                imagecontainer.classList.add("is-drop")
                drawimage(image)
            }
            image.src=loadevent.target.result
        }
        reader.readAsDataURL(file)
    }else{
        alert("只能上傳jpg或png圖檔")
    }
})

document.getElementById("plus").onclick=function(){
    if(image){
        scale=scale+0.5
        drawimage(image)
    }else{
        alert("請先上傳圖片!")
    }
}

document.getElementById("minus").onclick=function(){
    if(image){
        if(scale>0) scale=scale-0.5
        else alert("scale 小於0")
        drawimage(image)
    }else{
        alert("請先上傳圖片!")
    }
}

document.getElementById("undo").onclick=function(){
    if(image){
        rotate=rotate-90
        canva.style.transform="rotate("+rotate+"deg)"
        drawimage(image)
    }else{
        alert("請先上傳圖片!")
    }
}

document.getElementById("redo").onclick=function(){
    if(image){
        rotate=rotate+90
        canva.style.transform="rotate("+rotate+"deg)"
        drawimage(image)
    }else{
        alert("請先上傳圖片!")
    }
}

document.getElementById("alth").onclick=function(){
    if(image){
        if(altx){
            canva.style.transform="scaleX(1)"
            altx=false
        }else{
            canva.style.transform="scaleX(-1)"
            altx=true
        }
        drawimage(image);
    }else{
        alert("請先上傳圖片!")
    }
}

document.getElementById("altv").onclick=function(){
    if(image){
        if(alty){
            canva.style.transform="scaleY(1)"
            alty=false
        }else{
            canva.style.transform="scaleY(-1)"
            alty=true
        }
        drawimage(image);
    }else{
        alert("請先上傳圖片!")
    }
}

document.getElementById("trash").onclick=function(){
    location.reload()
}

document.getElementById("download").onclick=function(){
    if(image){
        let alink=document.createElement("a")
        alink.href=canva.toDataURL("image/jpeg")
        alink.download="image.jpg"
        alink.click()
    }else{
        alert("請先上傳圖片!")
    }
}
