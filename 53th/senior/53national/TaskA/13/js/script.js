document.querySelectorAll(".card").forEach(function(card){
    let isdrag=false
    let x
    let y
    let offsetx=0
    let offsety=0

    card.addEventListener("pointerdown",function(event){
        isdrag=true
        x=event.clientX-offsetx
        y=event.clientY-offsety
        card.style.transform="rotate(15deg)"
    })

    document.addEventListener("pointermove",function(event){
        if(isdrag){
            offsetx=event.clientX-x
            offsety=event.clientY-y
            card.style.left=offsetx+"px"
            card.style.top=offsety+"px"
            document.querySelectorAll(".group").forEach(function(groupevent){
                groupevent.addEventListener("hover",function(){
                    console.log("in")
                })
            })
        }
    })

    document.addEventListener("pointerup",function(){
        if(isdrag){
            isdrag=false
            card.style.transform="rotate(0deg)"
        }
    })
})