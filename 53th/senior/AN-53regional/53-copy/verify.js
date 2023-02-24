let tds=document.querySelectorAll(".verifytd")
console.log(tds);

tds.forEach(function(e){
    e.addEventListener("click",function(){
        console.log(e);
        if(e.style.backgroundColor=="black"){
            e.style.backgroundColor="white"
        }else{
            e.style.backgroundColor="black"
        }
    })
})

function pass(){
    alert("登入成功")
    location.href="main.php"
}

function check(){
    if((tds[0].style.backgroundColor==tds[1].style.backgroundColor)&&tds[1].style.backgroundColor=="black") pass()
    else if((tds[2].style.backgroundColor==tds[3].style.backgroundColor)&&tds[3].style.backgroundColor=="black") pass()
    else if((tds[2].style.backgroundColor==tds[0].style.backgroundColor)&&tds[2].style.backgroundColor=="black") pass()
    else if((tds[1].style.backgroundColor==tds[3].style.backgroundColor)&&tds[3].style.backgroundColor=="black") pass()
    else alert("驗證碼輸入錯誤")
}
