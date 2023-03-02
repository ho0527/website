let td=document.querySelectorAll(".verifytd")

td.forEach(function(e){
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
    if(td[0].style.backgroundColor==td[1].style.backgroundColor&&td[1].style.backgroundColor=="black") pass()
    else if(td[2].style.backgroundColor==td[3].style.backgroundColor&&td[3].style.backgroundColor=="black") pass()
    else if(td[0].style.backgroundColor==td[2].style.backgroundColor&&td[2].style.backgroundColor=="black") pass()
    else if(td[3].style.backgroundColor==td[1].style.backgroundColor&&td[1].style.backgroundColor=="black") pass()
    else alert("驗證碼輸入錯誤")
}