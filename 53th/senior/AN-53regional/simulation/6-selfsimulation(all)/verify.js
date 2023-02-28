let ver=document.querySelectorAll(".verifytd")

ver.forEach(function(e){
    e.style.backgroundColor="white"
    e.addEventListener("click",function(){
        if(e.style.backgroundColor=="white"){
            e.style.backgroundColor="black"
        }else{
            e.style.backgroundColor="white"
        }
    })
})

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(){
    if(ver[0].style.backgroundColor==ver[1].style.backgroundColor&&ver[1].style.backgroundColor=="black") pass()
    else if(ver[2].style.backgroundColor==ver[3].style.backgroundColor&&ver[3].style.backgroundColor=="black") pass()
    else if(ver[0].style.backgroundColor==ver[2].style.backgroundColor&&ver[2].style.backgroundColor=="black") pass()
    else if(ver[3].style.backgroundColor==ver[1].style.backgroundColor&&ver[1].style.backgroundColor=="black") pass()
    else alert("驗證碼有誤")
}
