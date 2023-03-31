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
			if(drawing==true){
				drawing=false
			}else{
				x=event.pageX
				y=event.pageY
				div.style.left=x+"px"
				div.style.top=y+"px"
				drawing=true
			}
		})

		img.addEventListener("pointermove",function(event){
			if(drawing==true){
				let x2=event.pageX
				let y2=event.pageY
				div.style.width=x2-x-5+"px"
				div.style.height=y2-y-5+"px"
			}
		})

		img.addEventListener("pointerup",function(){
			if(drawing==true){
				drawing=false
			}
		})
	},1000)
})

let iscrop
cropdownloadbutton.onclick=function(){
	if(cropdownloadbutton.value=="crop"){
		let canvas=document.createElement("canvas")
		let crop=document.getElementById("imagediv")
		let width=crop.offsetWidth
		let height=crop.offsetHeight
		canvas.width=width
		canvas.height=height
		let pos=crop.getBoundingClientRect()
		canvas.getContext("2d").drawImage(document.getElementById("image"),pos.left,pos.top,width,height,0,0,width,height)
		let a=document.createElement("a")
		a.href=canvas.toDataURL()
		a.download="crop_"+image.name
		iscrop=a
		cropdownloadbutton.value="download"
	}else{
		iscrop.click()
	}
}

// 當按下重整按鈕後，重新載入頁面
document.getElementById("reflashbutton").onclick=function(){
	location.reload()
}