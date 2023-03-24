let mod=document.getElementById("change")
let buttons=document.querySelectorAll('button')
let output=document.getElementById("output")
let a="twodecimals"
//訂定變數

output.value=""//將output清空

//變換value
mod.onclick=function(){
	if(mod.value=="全部模式"){
		mod.value="後兩位模式"
		a="twodecimals"
	}else{
		mod.value="全部模式"
		a="all"
	}
}

document.querySelectorAll(".calckey").forEach(function(event){
	event.addEventListener("click",function(){
		console.log("inini")
		console.log(this)
		console.log(this.id)
		if(this.id=="c"){
			output.value=""//將output清空
		}else if(this.id=="calc="){
			console.log("eq"+a)
			if(a=="twodecimals"){//判斷a是否為twodecimals
				let result=eval(output.value)
				output.value=Math.round(result * 100) / 100;//四捨五入
			}else{
				output.value=eval(output.value)//印出結果
			}
		}else{
			output.value=output.value+this.value//加字串
		}
	})
})