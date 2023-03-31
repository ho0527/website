let file=document.getElementById("file")
let cropdownloadbutton=document.getElementById("cropdownloadbutton")
let imagediv=document.getElementById("imagediv")
let image
let filename
let drawing=false
let div=document.getElementById("cropdiv")

file.addEventListener("change",function(event){
	filename=event.target.files[0].name
})

// 當按下提交按鈕後，禁用提交按鈕並啟用重整按鈕
document.getElementById("submit").addEventListener("click",function(){
	let reader=new FileReader()
	reader.onload=function(){
		image=new Image()
		image.src=reader.result
		image.name=filename
		image.onload=function(){
			document.getElementById("image").src=image.src
		}
	}
	reader.readAsDataURL(file.files[0])
	document.getElementById("submit").disabled=true
	cropdownloadbutton.disabled=false
	setTimeout(function(){
		let img=document.getElementById("image")
		let x
		let y
		div.style.display="block"
		img.addEventListener("pointerdown",function(event){
			x=event.pageX
			y=event.pageY
			div.style.left=x+"px"
			div.style.top=y+"px"
			drawing=true
		})
		
		img.addEventListener("pointermove",function(event){
			if(drawing){
				let x2=event.pageX
				let y2=event.pageY
				div.style.width=x2-x-5+"px"
				div.style.height=y2-y-5+"px"
			}
		})
		
		img.addEventListener("pointerup",function(event){
			drawing=false
		})
	},1000)
})

cropdownloadbutton.addEventListener("",function(){
	let a
	let alink
	if(cropdownloadbutton.value=="crop"){
		let canvas=document.createElement("canvas")
		let crop=document.getElementById("imagediv")
		let w=crop.offsetWidth
		let h=crop.offsetHeight
		let ctx=canvas.getContext("2d")
		canvas.width=w
		canvas.height=h
		// canvas.getContext("2d").drawImage(document.getElementById("image"),crop.offsetLeft,crop.offsetTop,w,h,0,0,w,h)
		ctx.drawImage(document.getElementById("image"),crop.offsetLeft,crop.offsetTop,w,h,0,0,w,h)
		canvas.toBlob(function(blob){
			a=document.createElement("a")
			a.href=URL.createObjectURL(blob)
			a.download="crop_"+image.name
			a.id="a"
			// alink=document.getElementById("a")
			console.log(a)
			// console.log(alink)
		})
		console.log(a)
		console.log(alink)
		cropdownloadbutton.value="download"
	}else{
		let alink=document.getElementById("a")
		// alink.click()
		// console.log(alink)
	}
})

// 當按下重整按鈕後，重新載入頁面
document.getElementById("reflashbutton").onclick=function(){
	location.reload()
}