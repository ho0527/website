function smoothscroll(id){
    if(document.getElementById(id)){
        document.getElementById(id).scrollIntoView({ behavior: "smooth" })
    }else{
        conlog("[ERROR]function smoothscroll id not found","red","12")
    }
}

function showall(id){
    if(document.getElementById(id)){
        document.getElementById(id).style.display="block"
        document.getElementById(id).style.height="0px"
        document.getElementById(id).style.transition="2s linear"
        setTimeout(function(){
            document.getElementById(id).style.height="100%"
        },20)
    }else{
        conlog("[ERROR]function showall id not found","red","12")
    }
}