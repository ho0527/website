let input=document.getElementById("input")

input.addEventListener("focus",function(){
    input.addEventListener("keydown",function(event){
        if(event.key=="Tab"){
            event.preventDefault()
            input.innerHTML=input.innerHTML+"    "
            show.innerHTML=show.innerHTML+"    "
        }
    })
})

input.addEventListener("input",function(event){
    let show=document.getElementById("show")
    show.innerHTML=document.getElementById("input").innerHTML
    console.log("document.getElementById(\"input\").innerHTML="+document.getElementById("input").innerHTML)
    console.log(document.getElementById("input"))
    console.log(event)
})