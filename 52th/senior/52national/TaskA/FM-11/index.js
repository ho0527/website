// 讀取圖片
document.getElementById("input").addEventListener("change",function(event){
    let input=document.getElementById("input")
    let image=document.getElementById("image")
    image.src=URL.createObjectURL(input.files[0])
    image.style.display="block"
})

// 顯示顏色
document.getElementById("image").addEventListener("mousemove",function(event){
    let image=document.getElementById("image")
    let canvas=document.createElement("canvas")
    let ctx=canvas.getContext("2d")
    canvas.width=image.width
    canvas.height=image.height
    ctx.drawImage(image,0,0,image.width,image.height)
    let pixelData=ctx.getImageData(event.offsetX,event.offsetY,1,1).data
    let color="rgb("+pixelData[0]+","+pixelData[1]+","+pixelData[2]+")"
    let hex="#"+("000000"+((pixelData[0]<<16)|(pixelData[1]<<8)|pixelData[2]).toString(16)).slice(-6)
    document.getElementById("colorrgb").innerHTML=`
        RGB: ${color}
    `
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