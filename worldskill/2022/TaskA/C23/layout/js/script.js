function rangeslider(sliderelement,min,max,step=1,display,defaultmin,defaultmax,displaytext=""){
    if(!defaultmin){ defaultmin=min }
    if(!defaultmax){ defaultmax=max }

    domgetid(sliderelement).style.height="10px"
    domgetid(sliderelement).style.backgroundColor="#d8cef5"
    domgetid(sliderelement).style.borderRadius="50rem"
    domgetid(sliderelement).style.position="relative"
    domgetid(sliderelement).style.cursor="pointer"
    domgetid(sliderelement).style.marginBottom="20px"
    domgetid(sliderelement).innerHTML=`
        <div class="bar" style="left:40%; width:20%;">
            <div class="circle circle-left" id="rangesliderleft"></div>
            <div class="circle circle-right" id="rangesliderright"></div>
        </div>
    `

    if(domgetid(display)){
        domgetid(display).innerHTML=`
            <div class="cost cost-left">
                ${displaytext}${defaultmin}
            </div>
            <div class="cost cost-right">
                ${displaytext}${defaultmax}
            </div>
        `
    }

    onmouseover("#rangesliderleft",function(element,event){

    })
}

rangeslider("slider",0,1000,50,"display",400,600,"$")