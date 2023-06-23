let data=[]

document.getElementById("submit").onclick=function(){
    let file=new FileReader()
    file.onload=function(event){
        file=event.target.result.split("\n")
        console.log("file="+file)
    }
    file.readAsText(document.getElementById("inputfileans").files[0])
}