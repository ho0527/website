let none=document.getElementById("none")
let yesno=document.getElementById("yesno")
let single=document.getElementById("single")
let multi=document.getElementById("multi")
let question=document.getElementById("question")
let all=[none,yesno,single,multi,question]

all.foreach(function(event){
    event.addeventListener("onchange",onchange)
})


function onchange(){



}