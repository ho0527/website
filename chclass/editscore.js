let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    if(!(data["success"]=="true"&&data["permission"]=="admin")){
        location.href="login.html"
    }
}

let ajax2=newajax("GET","api.php?editscorelist="+(location.href.split("scoreid="))[1])

ajax2.onload=function(){
    let data=JSON.parse(ajax2.responseText)
    console.log(data)
    for(let i=0;i<data.length;i=i+1){
        let id=i+1

        if(id<10){ id="0"+id }

        let tr=doccreate("tr")

        tr.innerHTML=`
            <td class="td">${data[i][2]}</td>
            <td class="td">
                <input type="number" class="input scoreinput" id="${data[i][0]}" min="-1" max="150" requested value="${data[i][3]}">
            </td>
        `

        docappendchild("maintable",tr)
    }
}

docgetid("submit").onclick=function(){
    let data=[]

    docgetall(".scoreinput").forEach(function(event){
        data.push([event.id,event.value])
    })

    let ajax=newajax("POST","api/editscore.php",formdata([
        ["success",true],
        ["data",JSON.stringify(data)]
    ]))

    ajax.onload=function(){
        let data=JSON.parse(ajax.responseText)
        if(data["success"]){
            alert("修改成功")
            location.href="admin.html"
        }else{
            location.href="login.html"
        }
    }
}

startmacossection()