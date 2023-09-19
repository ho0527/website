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
            let div=doccreate("div")
            div.classList.add("game")
            div.id=(page*10)+i
            div.innerHTML=`
                <div class="title">${data["content"][i]["title"]}</div>
            `
            docappendchild("main",div)
        }
        docgetid("gamecount").innerHTML=`${total}`
    }else{
        alert("get an error in request!")
        location.reload()
    }
}

startmacossection()