let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    if(!(data["success"]=="true"&&data["permission"]=="admin")){
        location.href="login.html"
    }
}

for(let i=0;i<35;i=i+1){
    let id=i+1

    if(id<10){ id="0"+id }

    let tr=doccreate("tr")


    tr.innerHTML=`
        <td class="td">1146${id}</td>
        <td class="td"><input type="number" class="input scoreinput" name="${i+1}" min="-1" max="150" value="-1" required></td>
    `

    docappendchild("maintable",tr)
}

startmacossection()