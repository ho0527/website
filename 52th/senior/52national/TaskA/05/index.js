// let input=document.getElementById("input")
// let imagediv=document.getElementById("imagediv")
// let cropdownloadbutton=document.getElementById("cropdownloadbutton")
// let img,canvas,ctx,startX,startY,endX,endY
// let filename
// canvas=document.createElement("canvas")
// ctx=canvas.getContext("2d")

// // 監聽上傳按鈕，上傳圖像
// document.getElementById("form").addEventListener("submit",function(event){
// 	console.log("in")
// 	event.preventDefault()
// 	let file=input.files[0]
// 	if(!file){
// 		alert("請上傳圖片!")
// 	}else{
// 		let reader=new FileReader()
// 		reader.onload=function(event){
// 			img=new Image()
// 			console.log(img)
// 			img.onload=function(){
// 				imagediv.innerHTML=""
// 				imagediv.appendChild(canvas)
// 				canvas.width=img.width
// 				canvas.height=img.height
// 				ctx.drawImage(img,0,0)
// 				canvas.addEventListener("mousedown",function(event){
// 					startX=event.offsetX
// 					startY=event.offsetY
// 					endX=event.offsetX
// 					endY=event.offsetY
// 					console.log("offsetX="+startX)
// 					console.log("offsetY="+startY)
// 					drawRect(startX, startY, endX, endY)
// 				})
// 				canvas.addEventListener("mousemove",function(event){
// 					endX=event.offsetX
// 					endY=event.offsetY
// 					drawRect(startX,startY,endX,endY)
// 				})
// 				canvas.addEventListener("mouseup",function(event){
// 					endX=event.offsetX
// 					endY=event.offsetY
// 					drawRect(startX,startY,endX,endY)
// 					canvas.removeEventListener("mousemove",function(event){
// 						endX=event.offsetX
// 						endY=event.offsetY
// 						drawRect(startX, startY, endX, endY)
// 					})
// 					cropdownloadbutton.disabled=false
// 				})
// 			}
// 			img.src=event.target.result
// 		}
// 		reader.readAsDataURL(file)
// 	}
// })

// // 畫選框
// function drawRect(startX,startY,endX,endY){
// 	ctx.clearRect(0,0,canvas.width,canvas.height)
// 	ctx.drawImage(img,0,0)
// 	ctx.strokeStyle="#FF0000"
// 	ctx.setLineDash([5])
// 	ctx.strokeRect(startX,startY,endX - startX,endY - startY)
// }

// // 監聽下載按鈕，下載圖像
// cropdownloadbutton.onclick=function(){
// 	if(cropdownloadbutton.value=="crop"){
// 		let croppedCanvas=document.createElement("canvas")
// 		croppedCanvas.width=endX - startX
// 		croppedCanvas.height=endY - startY
// 		let croppedCtx=croppedCanvas.getContext("2d")
// 		croppedCtx.drawImage(img,startX,startY,endX - startX,endY - startY,0,0,endX - startX,endY - startY)
// 		filename="crop_" + input.files[0].name
// 		cropdownloadbutton.value=`download`
// 	}else{
// 		let link=document.createElement("a")
// 		link.download=filename
// 		link.href=canvas.toDataURL()
// 		link.click()
// 	}
// }

let cropdownloadbutton=document.getElementById("cropdownloadbutton")

let image={
  file: null,
  name: ""
}

let iscrop=false

document.getElementById("crop").addEventListener("resize", function() {})
document.getElementById("crop").addEventListener("drag", function() {})

document.getElementById("file").addEventListener("change", function(e) {
	image.name=e.target.files[0].name
	const reader=new FileReader()
	reader.onload=() => {
		image.file=reader.result
	}
	reader.readAsDataURL(e.target.files[0])
})

document.getElementById("submit").addEventListener("click", function() {
	document.getElementById("img").setAttribute("src", image.file)
	document.getElementById("container").style.width=document.getElementById("img").width + "px"
	document.getElementById("container").style.height=document.getElementById("img").height + "px"
	iscrop=false
	document.getElementById("cropbtn").value="Crop"
})

cropdownloadbutton.addEventListener("click", function() {
	if(cropdownloadbutton.value=="crop"){
		const canvas=document.createElement("canvas")
		const crop=document.getElementById("crop")
		const w=crop.offsetWidth
		const h=crop.offsetHeight
		canvas.width=w
		canvas.height=h
		const ctx=canvas.getContext("2d")
		const pos={
			left: crop.offsetLeft,
			top: crop.offsetTop
		}
		ctx.drawImage(document.getElementById("img"), pos.left, pos.top, w, h, 0, 0, w, h)
		const a=document.createElement("a")
		a.href=canvas.toDataURL()
		document.getElementById("img").setAttribute("src", canvas.toDataURL())
		a.download=`crop_${image.name}`
		iscrop=a
		cropdownloadbutton.value="download"
	}else{
		iscrop.click()
	}
})

document.getElementById("reflashbutton").onclick=function(){
	location.reload()
}