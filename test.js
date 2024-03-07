function rangeslider(target=null,value=null,step=null,set=null,range=false,scale=true,labels=true,tooltip=true,disabled=false,style="roundstyle",width=null,onchangecallback=null){
	let input
	let inputdisplay
	let slider
	let sliderwidth
	let sliderleft
	let pointerwidth
	let pointerr
	let pointerl
	let activepointer
	let selecte
	let scale1
	let step1
	let tipl
	let tipr
	let timeout
	let values={
		start: null,
		end: null
	}

	// function START
	function drag(event){
		let dir=event.target.getAttribute("data-dir")

		event.preventDefault()

		if(!disabled){
			if(dir=="left"){
				activepointer=pointerl
			}
			if(dir=="right"){
				activepointer=pointerr
			}

			slider.classList.add("sliding")
		}else{
			return
		}
	}

	function move(event){
		if(activepointer&&!disabled){
			let coordx
			let index

			if(event.type=="touchmove"){
				coordx=event.touches[0].clientX
			}else{
				coordx=event.pageX
			}

			index=Math.round((coordx-sliderleft-(pointerwidth/2))/step1);

			if(index<=0){
				index=0
			}

			if(index>value.length-1){
				index=value.length-1
			}

			if(range){
				if(activepointer==pointerl){
					values.start=index
					if(values.start>=values.end){
						values.start=values.end-1
					}
				}
				if(activepointer==pointerr){
					values.end=index
				}
			}else{
				values.end=index
			}

			setvalue()
		}
	}

	function drop(){
		activepointer=null
	}

	function setvalue(start,end){
		let activepointer


		if(range){
			activepointer="start"
		}else{
			activepointer="end"
		}

		if(start&&value.indexOf(start)>-1){
			values[activepointer]=value.indexOf(start)
		}

		if(end&&value.indexOf(end)>-1){
			values.end=value.indexOf(end)
		}

		if(range&&values.start>=values.end){
			values.end=values.start+1
		}

		pointerl.style.left=(values[activepointer]*step1-(pointerwidth/2))+"px";

		if(range){
			if(tooltip){
				tipl.innerHTML=value[values.start]
				tipr.innerHTML=value[values.end]
			}
			input.value=value[values.start]+","+value[values.end]
			pointerr.style.left=(values.end*step1-(pointerwidth/2))+"px"
		}else{
			if(tooltip){
				tipl.innerHTML=value[values.end];
			}
			input.value=value[values.end];
		}

		if(values.end>value.length-1){
			values.end=value.length-1
		}

		if(values.start<0){
			values.start=0
		}

		selecte.style.width=(values.end-values.start)*step1+"px";
		selecte.style.left=values.start*step1+"px";

		change()
	}

	function change(){
		if(timeout) clearTimeout(timeout);

		timeout=setTimeout(function(){
			if(onchangecallback&&typeof onchangecallback=="function"){
				return onchangecallback(input.value);
			}
		},500)
	}

	function disable(data){
		disabled=data
		if(disabled){
			slider.classList.add("disabled")
		}else{
			slider.classList.remove("disabled")
		}
	}

	function getvalue(){
		return [value[values.start],value[values.end]]
	}

	function destroy(){
		input.style.display=inputdisplay
		slider.remove()
		return null
	}

	function createElement(el,cls,dataAttr){
		var element=document.createElement(el)
		console.log(cls)
		if(cls) element.className=cls
		if(dataAttr&&dataAttr.length==2){
			element.setAttribute("data-"+dataAttr[0],dataAttr[1])
		}

		return element
	}
	// function END

	// 獲取input DOM
	if(typeof target=="object"){
		input=target
	}else{
		input=document.getElementById(target.replace("#",""))
	}

	if(input){
		inputdisplay=getComputedStyle(input,null).display
		input.style.display="none"
		if((value instanceof Array)||(value["min"]!=undefined&&value["max"]!=undefined)){
			// init END

			slider=createElement("div","rangecontainer")
			slider.innerHTML=`<div class="rangebackground"></div>`
			selecte=createElement("div","rangeselected")
			pointerl=createElement("div","rangepointer",["dir","left"])
			scale1=createElement("div","rangescale")

			if(tooltip){
				tipl=createElement("div","rangetooltip")
				tipr=createElement("div","rangetooltip")
				pointerl.appendChild(tipl)
			}
			slider.appendChild(selecte)
			slider.appendChild(scale1)
			slider.appendChild(pointerl)

			if(range){
				pointerr=createElement("div","rangepointer",["dir","right"])
				if(tooltip){
					pointerr.appendChild(tipr)
				}
				slider.appendChild(pointerr)
			}

			slider.classList.add(style)

			input.parentNode.insertBefore(slider,input.nextSibling)


			if(width){
				slider.style.width=parseInt(width)+"px"
			}
			sliderleft=slider.getBoundingClientRect().left
			sliderwidth=slider.clientWidth
			pointerwidth=pointerl.clientWidth

			if(!scale){
				slider.classList.add("rangenoscale")
			}

			if(disabled){
				slider.classList.add("disabled")
			}else{
				slider.classList.remove("disabled")
			}

			if(!(value instanceof Array)){

				let min=value.min
				let max=value.max
				let range=max-min

				value=[]

				if(step){
					for(let i=0;i<(range/step);i=i+1){
						value.push(min+(i*step))
					}

					if(value.indexOf(max)<0){
						value.push(max)
					}
				}else{
					console.warn("[WARNING]function rangeslider warn: no step defined")
					value=[value.min,value.max]
				}
			}


			values.start=0
			if(range){
				values.end=value.length-1
			}else{
				values.end=0
			}

			if(
				set&&
				set.length&&
				set.length>=1&&
				value.indexOf(set[0])>=0&&
				(!range||(range&&set.length>=2&&value.indexOf(set[1])>=0))
			){
				if(range){
					values.start=value.indexOf(set[0])
					if(set[1]){
						values["end"]=value.indexOf(set[1])
					}else{
						values["end"]=null
					}
				}else{
					values.end=value.indexOf(set[0])
				}
			}

			step1=sliderwidth/(value.length-1);

			for(let i=0;i<value.length;i=i+1){
				var span=createElement("span")
				let ins=createElement("div")

				span.appendChild(ins)
				scale1.appendChild(span)

				if(i==value.length-1){
					span.style.width="0px"
				}else{
					span.style.width=step1+"px"
				}

				if(!labels){
					if(i==0||i==value.length-1){
						ins.innerHTML=value[i]
					}
				}else{
					ins.innerHTML=value[i]
				}

				ins.style.marginLeft=(ins.clientWidth/2)*-1+"px";
			}

			setvalue()

			slider.querySelectorAll(".rangepointer").forEach(function(event){
				event.onmousedown=function(event){
					drag(event)
				}
				event.ontouchstart=function(event){
					drag(event)
				}
			})

			slider.querySelectorAll("span").forEach(function(event){
				event.onclick=function(event){
					if(!disabled){
						let index=Math.round((event.clientX-sliderleft)/step1)

						if(index>value.length-1){
							index=value.length-1
						}

						if(index<0){
							index=0
						}

						if(range){
							if(index-values.start<=values.end-index){
								values.start=index
							}else{
								values.end=index
							}
						}else{
							values.end=index
						}

						slider.classList.remove("sliding")

						setvalue()
					}else{
						return
					}
				}
			})

			document.onmousemove=function(event){
				move(event)
			}

			document.ontouchmove=function(event){
				move(event)
			}

			document.onmouseup=function(event){
				drop(event)
			}

			document.ontouchend=function(event){
				drop(event)
			}

			document.ontouchcancel=function(event){
				drop(event)
			}

			window.onresize=function(){
				sliderleft=slider.getBoundingClientRect().left
				sliderwidth=slider.clientWidth
				step1=sliderwidth/(value.length-1)

				slider.querySelectorAll("span").forEach(function(event){
					event.style.width=step1+"px"
				})

				setvalue()
			}

			return{
				getvalue: getvalue,
				destroy: destroy,
				disabled: disabled
			}
		}else{
			throw "[KEYTYPEIN_ERROR]function rangeslider error: data missing min or max value"
		}
	}else{
		throw "[DOMNOTFOUND_ERROR]function rangetslider error: target element not find"
	}
}

let rangeslider1=rangeslider(
target="#test"
,value={
	min: 50,
	max: 500
}
,step=10
,set=[150,200]
,range=true
,scale=true
,labels=true
,tooltip=true
,disabled=false
,style="roundstyle"
,onchangecallback=null
,width=null
)