let count=0

document.getElementById("input").onkeydown=function(event){
    if(event.key==" "){
        event.preventDefault()

        let li=document.createElement("li")
        li.classList.add("li")
        li.id=count
        li.innerHTML=`
            ${input.value}
            <input type="button" class="deletebutton" data-id="${count}" value="X">
        `
        document.getElementById("tag").appendChild(li)

        document.getElementById("input").value=""

        count=count+1
        
        document.querySelectorAll(".deletebutton").forEach(function(event){
            event.onclick=function(){
                document.getElementById(event.dataset.id).remove()
            }
        })
    }
}