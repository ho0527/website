document.querySelectorAll(".mainleftgrid").forEach(function(event){
    event.onclick=function(){
        location.href="list.php?id="+event.id
    }
})