function check(){
    let fileInput=document.getElementById("file")
    let file=fileInput.files[0]
    let reader=new FileReader()
    reader.onload=function(event){
        let contents=event.target.result
        document.getElementById("div").innerHTML=contents
    }
    reader.readAsText(file)
}