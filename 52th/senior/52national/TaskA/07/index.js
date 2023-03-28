let canva

document.getElementById("file").addEventListener("change",function(event){
    let file=event.target.files[0]
    // 進一步處理使用者上傳的圖片
    canva=document.createElement("canvas")
    canva.width=file.width
    canva.height=file.height
    let ctx=canva.getContext("2d")
    let image=new Image()
    image.onload=function(){
        ctx.drawImage(image,0,0,canva.width,canva.height)
        // 在 canva 上繪製線條
        for (let x=0;x<canva.width;x=x+100){
            ctx.moveTo(x,0)
            ctx.lineTo(x,canva.height)
        }
        for (let y=0;y<canva.height;y=y+100){
            ctx.moveTo(0,y)
            ctx.lineTo(canva.width,y)
        }
        ctx.stroke()
    }
    image.src=URL.createObjectURL(file)
})

document.getElementById("reflashbutton").onclick=function(){
    location.reload()
}

document.getElementById("downloadbutton").onclick=function(){
    // let resultImg=new Image()
    console.log("in")
    // resultImg.onload=function(){
    // }
    let alink=document.createElement("a")
    alink.href=canva.toDataURL("image/jpeg")
    alink.download="result.jpg"
    alink.click()
}