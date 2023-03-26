let fileInput=document.getElementById("file")
let submitButton=document.getElementById("submit")
let reflashButton=document.getElementById("reflashbutton")
let cropdownloadbutton=document.getElementById("cropdownloadbutton")
let imageDiv=document.getElementById("imagediv")
let image

let isDrawing=false
let crop=document.createElement("div")
crop.id="crop"
crop.style.border="1px dashed #333"
crop.style.position="absolute"
crop.style.zIndex="1"
imageDiv.appendChild(crop)

imageDiv.addEventListener("mousedown", function (event) {
  crop.style.left=event.pageX - imageDiv.offsetLeft + "px"
  crop.style.top=event.pageY - imageDiv.offsetTop + "px"
  crop.style.width="0"
  crop.style.height="0"
  isDrawing=true
})

imageDiv.addEventListener("mousemove", function (event) {
  if (isDrawing) {
    crop.style.width=event.pageX - imageDiv.offsetLeft - crop.offsetLeft + "px"
    crop.style.height=event.pageY - imageDiv.offsetTop - crop.offsetTop + "px"
  }
})

imageDiv.addEventListener("mouseup", function () {
  isDrawing=false
})

// 當選擇文件後觸發，讀取文件並顯示在畫面上
fileInput.addEventListener("change", function () {
	const reader=new FileReader()
	reader.onload=function () {
		image=new Image() // 添加这行
		image.src=reader.result
		image.onload=function () {
		imageDiv.innerHTML=`<canvas id="canvas"></canvas>`
		const canvas=document.getElementById("canvas")
		canvas.width=image.width
		canvas.height=image.height
		const ctx=canvas.getContext("2d")
		ctx.drawImage(image, 0, 0)
		}
	}
	reader.readAsDataURL(fileInput.files[0])
})

// 當按下提交按鈕後，禁用提交按鈕並啟用重整按鈕
submitButton.addEventListener("click", function () {
	submitButton.disabled=true
	cropdownloadbutton.disabled=false
})

cropdownloadbutton.addEventListener("click", function() {
	if(cropdownloadbutton.value=="crop"){
		const canvas=document.createElement("canvas")
		const crop=document.getElementById("imagediv")
		const w=crop.offsetWidth
		const h=crop.offsetHeight
		const ctx=canvas.getContext("2d")
		canvas.width=w
		canvas.height=h
		ctx.drawImage(document.getElementById("img"), crop.offsetLeft, crop.offsetTop, w, h, 0, 0, w, h)
		canvas.toBlob(function(blob) {
			const alink=document.createElement("a")
			alink.href=URL.createObjectURL(blob)
			alink.download="crop_"+image.name
		})
		cropdownloadbutton.value="download"
	}else{
		alink.click()
	}
})

// 當按下重整按鈕後，重新載入頁面
document.getElementById("reflashbutton").onclick=function(){
	location.reload()
}