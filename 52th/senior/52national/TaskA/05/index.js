let file=document.getElementById("file")
let cropdownloadbutton=document.getElementById("cropdownloadbutton")
let imagediv=document.getElementById("imagediv")
let image
let drawing=false
let div=document.getElementById("cropdiv")

// 當按下提交按鈕後，禁用提交按鈕並啟用重整按鈕
document.getElementById("submit").addEventListener("click",function(){
	let reader=new FileReader()
	reader.onload=function(){
		image=new Image() // 添加这行
		image.src=reader.result
		image.onload=function(){
			document.getElementById("image").src=image.src
		}
	}
	reader.readAsDataURL(file.files[0])
	document.getElementById("submit").disabled=true
	cropdownloadbutton.disabled=false
	setTimeout(function(){
		let img=document.getElementById("image")
		img.addEventListener("pointerdown",function(event){
			div.style.display="block"
			div.style.left=event.pageX+"px"
			div.style.top=event.pageY+"px"
			drawing=true
		})

		img.addEventListener("pointermove",function(event){
			if(drawing){
				div.style.width=event.pageX-img.offsetLeft+"px"
				div.style.height=event.pageY-img.offsetTop+"px"
			}
		})

		img.addEventListener("pointerup",function(){
			drawing=false
			console.log("in")
		})
	},1000);
})

cropdownloadbutton.addEventListener("click",function() {
	if(cropdownloadbutton.value=="crop"){
		let canvas=document.createElement("canvas")
		let crop=document.getElementById("imagediv")
		let w=crop.offsetWidth
		let h=crop.offsetHeight
		let ctx=canvas.getContext("2d")
		canvas.width=w
		canvas.height=h
		ctx.drawImage(document.getElementById("img"),crop.offsetLeft,crop.offsetTop,w,h,0,0,w,h)
		canvas.toBlob(function(blob){
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


function check(){
	drawing=false
	console.log("in1")
}