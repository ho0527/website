let page=0
let size=10
let sortby="title"
let sortdir="asc"

let ajax=newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games?page="+page+"&size="+size+"&sortBy="+sortby+"&sortDir="+sortdir)

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    console.log(data)
    if(data["status"]!="invalid"){
        let total=data["totalElements"]
        for(let i=0;i<data["content"].length;i=i+1){

        }
    }else{
        alert("get an error in request!")
        location.reload()
    }
}