let split=location.href.split("=")
let key=split[split.length-1]
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



if(key=="yangmingshan"||key=="sheipa"){
    let ajax=new XMLHttpRequest()

    ajax.onload=function(){
        document.getElementById("context").innerHTML=this.responseText
    }

    ajax.open("GET","park/"+key+".html",true)
    ajax.send()
}
