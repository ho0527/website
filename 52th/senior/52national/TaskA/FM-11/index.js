let input=document.getElementById("input")
let image=document.getElementById("image")

input.addEventListener("change",function(){
    image.src=URL.createObjectURL(input.files[0])
})

// 顯示顏色
image.addEventListener("mousemove",function(event){
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
    let magnifier=document.getElementById("canva")
    let x=0
    let y=0
    for(let i=0;i<x;i=i+1){
        for(let j=0;j<y;j=j+1){
    
        }
    }
    // let mctx=magnifier.getContext("2d")
    magnifier.style.left=(event.pageX+20)+"px"
    magnifier.style.top=(event.pageY+20)+"px"
})

document.getElementById("reflashbutton").onclick=function(){
    location.reload()
}