let tds=document.querySelectorAll(".verifytd")

tds.forEach(function(e){
    e.addEventListener("click",function(){
        click(e)
    })
})

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(e){
    if(tds[0].style.backgroundColor==tds[1].style.backgroundColor&&tds[1].style.backgroundColor=="black") pass()
    else if(tds[2].style.backgroundColor==tds[3].style.backgroundColor&&tds[3].style.backgroundColor=="black") pass()
    else if(tds[0].style.backgroundColor==tds[2].style.backgroundColor&&tds[2].style.backgroundColor=="black") pass()
    else if(tds[3].style.backgroundColor==tds[1].style.backgroundColor&&tds[1].style.backgroundColor=="black") pass()
    else alert("驗證碼輸入錯誤")
}

function click(id){
    if(id.style.backgroundColor=="black"){ id.stye.backgroundColor="white" }else{ id.style.backgroundColor="black" }
}