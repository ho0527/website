let item=document.querySelectorAll(".image")
let count=0

item[1].style.display="block"

let carousel=setInterval(function(){
    for(let i=0;i<item.length;i=i+1){
        item[i].style.display="none"
    }
    item[count].style.display="block"
    count=(count+1)%item.length
},1000)