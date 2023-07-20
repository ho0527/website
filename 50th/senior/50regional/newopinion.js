docgetid("submit").onclick=function(){
    let title=document.getElementById("title").value
    let description=document.getElementById("description").value
    let file=document.getElementById("file").files[0]
    let extendlist=[]

    docgetall("#extend>.opiniondiv").forEach(function(event){
        extendlist.push(event.dataset.id)
    })

    let data=new FormData()
    data.append("title",title)
    data.append("description",description)
    data.append("file",file)
    data.append("extend",extendlist.join("|&|"))

    let ajax=newajax("POST","api/newopinion.php",data)

    ajax.onload=function(){
        let id=ajax.responseText
        alert("新增成功")
        location.href="../opinion.php?id="+id
    }
}

divsort("opiniondiv",".sort")