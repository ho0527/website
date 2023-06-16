document.querySelectorAll(".item").forEach(function(event){
    event.onclick=function(){
        location.href="item.php?id="+event.id
    }
})