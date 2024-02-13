function rangeslider(sliderelement,min=0,max=100,step=1,display,defaultmin,defaultmax,displaytext=""){
    let clickid=""
    let mouseclick=false
    let stepdestion=(domgetid(sliderelement).offsetWidth/(max-min))*step

    // 初始化 START
    if(!defaultmin){ defaultmin=min }
    if(!defaultmax){ defaultmax=max }
    if(max-min>0){
        domgetid(sliderelement).style.height="10px"
        domgetid(sliderelement).style.backgroundColor="#d8cef5"
        domgetid(sliderelement).style.borderRadius="50rem"
        domgetid(sliderelement).style.position="relative"
        domgetid(sliderelement).style.cursor="pointer"
        domgetid(sliderelement).style.marginBottom="20px"
        domgetid(sliderelement).innerHTML=`
            <div class="bar" id="bar" style="left:40%; width:20%;">
                <div class="circle circle-left rangeslider" id="rangesliderleft"></div>
                <div class="circle circle-right rangeslider" id="rangesliderright"></div>
            </div>
        `

        if(domgetid(display)){
            domgetid(display).innerHTML=`
                <div class="cost" id="rangeslidercostmin">
                    ${displaytext}${defaultmin}
                </div>
                <div class="cost" id="rangeslidercostmax">
                    ${displaytext}${defaultmax}
                </div>
            `
        }
        // 初始化 END

        onmousedown(".rangeslider",function(element,event){
            if(!mouseclick){
                mouseclick=true
                clickid=element.id
            }
        })

        document.onmousemove=function(event){
            if(mouseclick){
                domgetid("bar").style.left="40%"
                domgetid("bar").style.width=event.offsetX+"px"
            }
        }

        document.onmouseup=function(event){
            mouseclick=false
        }
    }else{
        console.error("[KEY_TYPE_IN ERROR]function rangeslider error: max can't lesser then min")
    }
}

rangeslider("slider",0,1000,50,"display",400,600,"$")