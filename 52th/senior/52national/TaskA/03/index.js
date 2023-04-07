let buttons=document.querySelectorAll('button')
let output=document.getElementById("output")
let a="twodecimals"
//訂定變數

output.value=""//將output清空

document.querySelectorAll(".calckey").forEach(function(event){
	event.addEventListener("click",function(){
		if(this.value=="c"){
			output.value=""//將output清空
		}else if(this.value=="calc="){
			if(a=="twodecimals"){//判斷a是否為twodecimals
				let result=eval(output.value)
				output.value=Math.round(result*100)/100;//四捨五入
			}else{
				output.value=eval(output.value)//印出結果
			}
		}else{
			output.value=output.value+this.value//加字串
		}
	})
})