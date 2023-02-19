let version=document.querySelectorAll(".maintable")
let val
let index=document.getElementById("index")
let input=document.getElementById("input")
let perview=document.getElementById("perview")
let submit=document.getElementById("submit")
let indexdiv=document.getElementById("indexdiv")
let inputdiv=document.getElementById("inputdiv")
let perviewdiv=document.getElementById("perviewdiv")
let submitdiv=document.getElementById("submitdiv")

function clear(){
    indexdiv.style.display="none"
    inputdiv.style.display="none"
    perviewdiv.style.display="none"
    submitdiv.style.display="none"
    index.classList.remove("selectbut")
    input.classList.remove("selectbut")
    perview.classList.remove("selectbut")
    submit.classList.remove("selectbut")
}

function no(){
    alert("請先填寫資料")
}

window.onload=function(){
    clear()
    indexdiv.style.display="block"
    index.classList.add("selectbut")
    version.forEach(e => {
        e.style.backgroundColor="gray"
        e.addEventListener("click",function(){
            version.forEach(function(e2){
                e2.style.backgroundColor="gray"
            })
            this.style.backgroundColor="yellow"
            val=this.id
        })
    })
    input.onclick=function(){
        clear()
        inputdiv.style.display="block"
        input.classList.add("selectbut")
        data()
    }
}

index.onclick=function(){
    clear()
    indexdiv.style.display="block"
    index.classList.add("selectbut")
    version.forEach(e => {
        e.style.backgroundColor="gray"
        e.addEventListener("click",function(){
            version.forEach(function(e2){
                e2.style.backgroundColor="gray"
            })
            this.style.backgroundColor="yellow"
            val=this.id
        })
    })
    input.onclick=function(){
        data()
    }
}


function data(){
    if(val!=undefined){
        location.href="productindex.php?val="+val[7]
        setTimeout(function(){
            clear()
            inputdiv.style.display="block"
            input.classList.add("selectbut")
        },200)
    }else{
        no()
        location.reload()
    }
}