document.querySelectorAll(".radio").forEach(function(event){
    event.onclick=function(){
        if(this.value=="all"){
            location.href="?key=all"
        }else{
            location.href="?key=user"
        }
    }
})