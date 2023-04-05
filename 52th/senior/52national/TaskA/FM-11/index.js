let image=document.getElementById("image")

document.getElementById("input").addEventListener("change",function(){
    image.src=URL.createObjectURL(document.getElementById("input").files[0])
})

// 顯示顏色
document.getElementById("image").addEventListener("mousemove",function(event){
    let canvas=document.createElement("canvas")
    let ctx=canvas.getContext("2d")
    canvas.width=image.width
    canvas.height=image.height
    ctx.drawImage(image,0,0,image.width,image.height)
    let rgbdata=ctx.getImageData(event.offsetX,event.offsetY,1,1).data
    let rgb="rgb("+rgbdata[0]+", "+rgbdata[1]+", "+rgbdata[2]+")"
    document.getElementById("colorrgbtext").innerHTML=`
        RGB: ${rgb}
    `
    document.getElementById("colorshow").style.backgroundColor=rgb
    // 放大鏡功能
    let magnifier2=document.getElementById("magnifier")
    let magnifier=document.getElementById("canva")
    let magCtx=magnifier.getContext("2d")
    magCtx.clearRect(0,0,100,100)
    magCtx.drawImage(image,event.offsetX-50,event.offsetY-50,100,100,0,0,100,100)
    magCtx.beginPath()
    magCtx.arc(50,50,7,0,2*Math.PI)
    magCtx.stroke()
    magnifier.style.display="block"
    magnifier.style.left=event.offsetX+10+"px"
    magnifier.style.top=event.offsetY+10+"px"
})

document.getElementById("reflashbutton").onclick=function(){
    location.reload()
}