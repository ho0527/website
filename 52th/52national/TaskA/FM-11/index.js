document.getElementById("color-display").style.display="none"
document.getElementById("magnifier").style.display="none"
//將放大鏡和顏色顯示區塊隱藏

// 讀取圖片
function loadImage(){
    let input=document.getElementById("image-input")
    let image=document.getElementById("image")
    image.src=URL.createObjectURL(input.files[0])//
    image.style.display="block"//將圖片顯示
}

// 顯示顏色
function showColor(event){
    document.getElementById("color-display").style.display="block"
    document.getElementById("magnifier").style.display="block"
    //將放大鏡和顏色顯示區塊顯示
    let image=document.getElementById("image")
    let canvas=document.createElement("canvas")//
    let ctx=canvas.getContext("2d")//
    canvas.width=image.width//
    canvas.height=image.height//
    ctx.drawImage(image,0,0,image.width,image.height)//
    let pixelData=ctx.getImageData(event.offsetX,event.offsetY,1,1).data//
    let color="rgb("+pixelData[0]+","+pixelData[1]+","+pixelData[2]+")"//訂定rgb
    let hex="#"+("000000"+((pixelData[0]<<16)|(pixelData[1]<<8)|pixelData[2]).toString(16)).slice(-6)//
    document.getElementById("color-display").innerHTML=`Color: ${color}<br>Hex: ${hex}`//印出...
    // 放大鏡功能
    let magnifier=document.getElementById("magnifier")
    let magCtx=magnifier.getContext("2d")
    magCtx.clearRect(0,0,100,100)
    magCtx.drawImage(image,event.offsetX-50,event.offsetY-50,100,100,0,0,100,100)
    magCtx.beginPath()
    magCtx.arc(50,50,7,0,2*Math.PI)
    magCtx.stroke()
    magnifier.style.display="block"
    magnifier.style.left=event.pageX+10+"px"
    magnifier.style.top=event.pageY+10+"px"
}