let imgcontainer=document.getElementById("imgcontainer")
let canva=document.getElementById("mycanvas")
let ctx=canva.getContext("2d")
let img=null

// function to draw the image on canva
function drawimageoncanva(image){
    canva.width=image.width
    canva.height=image.height
    ctx.drawImage(image,0,0)
}

// event listener for drag and drop
imgcontainer.addEventListener("dragover",function(event){
    event.preventDefault()
})

imgcontainer.addEventListener("drop",function(event){
    event.preventDefault()
    const file=event.dataTransfer.files[0]
    const reader=new FileReader()
    reader.onload=function(loadevent){
        img=new Image()
        img.onload=function(){
            imgcontainer.classList.add("is-drop")
            drawimageoncanva(img)
        }
        img.src=loadevent.target.result
    }
    reader.readAsDataURL(file)
})

// button click event listeners
document.querySelector(".fa-search-plus").addEventListener("click",function(){
    if(img){
        img.width *= 1.5
        drawimageoncanva(img)
    }else{
        alert("please upload picture first")
    }
})

document.querySelector(".fa-search-minus").addEventListener("click",function(){
    if(img){
        img.width /= 1.5
        drawimageoncanva(img)
    }else{
        alert("please upload picture first")
    }
})

document.querySelector(".fa-undo").addEventListener("click",function(){
    if(img){
        ctx.rotate(-90 * Math.PI / 180)
        drawimageoncanva(img)
    }else{
        alert("please upload picture first")
    }
})

document.querySelector(".fa-redo").addEventListener("click",function(){
    if(img){
        ctx.rotate(90 * Math.PI / 180)
        drawimageoncanva(img)
    }else{
        alert("please upload picture first")
    }
})

document.querySelector(".fa-arrows-alt-h").addEventListener("click",function(){
    if(img){
        ctx.scale(-1,1)
        drawimageoncanva(img)
    }else{
        alert("please upload picture first")
    }
})

document.querySelector(".fa-arrows-alt-v").addEventListener("click",function(){
    if(img){
        ctx.scale(1,-1)
        drawimageoncanva(img)
    }else{
        alert("please upload picture first")
    }
})

document.getElementById("trash").addEventListener("click",function(){
    location.reload()
})

document.getElementById("download").addEventListener("click",function(){
    if(img){
        const a=document.createElement("a")
        a.href=canva.toDataURL("image/jpeg")
        a.download="image.jpg"
        a.click()
    }else{
        alert("please upload picture first")
    }
})
