let verifytd=document.querySelectorAll(".verifytd")

verifytd.forEach(function(td){
    td.addEventListener("click",function(){
        tdclick(this.id)
    })
})

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(){
    pass()
}

function showall(){
    
}

function tdclick(id){
    id=document.getElementById(id)
    if(id.style.backgroundColor==""||id.style.backgroundColor=="white"){
        id.style.backgroundColor="black"
    }else{
        id.style.backgroundColor="white"
    }
}
