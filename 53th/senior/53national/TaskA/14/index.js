let tablemain=""

for(let i=0;i<16;i=i+1){
    tablemain=tablemain+"<tr class='tr' id='tr"+i+"'>"
    for(let j=0;j<16;j=j+1){
        tablemain=tablemain+"<td class='td' id='td"+j+"'>"+"</td>"
    }
    tablemain=tablemain+"</tr>"
}

document.getElementById("table").innerHTML=`
    ${tablemain}
`

setTimeout(function(){
    let color=false

    document.querySelectorAll(".td").forEach(function(event){
        event.style.height=getComputedStyle(event).getPropertyValue("width")
        event.onclick=function(){
            if(color!=false){
                this.style.backgroundColor=color
            }else{}
        }
    })

    document.querySelectorAll(".color").forEach(function(event){
        event.style.borderColor="black"
        event.style.width=getComputedStyle(event).getPropertyValue("height")
        event.style.backgroundColor=event.id
        event.onclick=function(){
            if(this.style.borderColor=="black"){
                document.querySelectorAll(".color").forEach(function(event2){
                    event2.style.borderColor="black"
                })
                this.style.borderColor="yellow"
                color=this.id
            }else{
                this.style.borderColor="black"
            }
        }
    })
},10)