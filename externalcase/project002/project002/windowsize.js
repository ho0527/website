// console.log(screen.width)
// console.log(screen.height)
let weblocation=location.href.split("/")
let filename=(weblocation[weblocation.length-1]).split(".")[0]
console.log(weblocation)

setInterval(function(){
    if(screen.width<=900&&weblocation[weblocation.length-2]!="phone"){
        location.href="phone/"+filename+".php"
    }
    if(screen.width>900&&weblocation[weblocation.length-2]=="phone"){
        location.href="../"+filename+".php"
    }
},50);