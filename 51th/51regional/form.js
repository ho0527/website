let none=document.querySelectorAll(".none")
let yesno=document.querySelectorAll(".yesno")
let single=document.querySelectorAll(".single")
let multi=document.querySelectorAll(".multi")
let question=document.querySelectorAll(".question")
let all=[none,yesno,single,multi,question]

all.forEach(function(event){
    event.forEach(function(event){
        event.onclick=function onchange(){
            let id=event.target.id
            console.log("hi"+id)
        }
    })
})