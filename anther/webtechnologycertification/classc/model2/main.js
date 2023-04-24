console.log("inininin: ")

document.querySelectorAll(".contextpng").forEach(function(event){
    console.log("onclick: ")
    event.onclick=function(){
        if(this.id=="png1"){
            document.getElementById("mainpng").src="material/0202A.png"
        }else if(this.id=="png2"){
            document.getElementById("mainpng").src="material/0203A.png"
        }else if(this.id=="png3"){
            document.getElementById("mainpng").src="material/0204A.png"
        }else if(this.id=="png4"){
            document.getElementById("mainpng").src="material/0205A.png"
        }else{
            console.log("[ERROR]unknown image")
        }
    }
})