let traincodelist
let trainlist
let stationlist
let maxpage

function main(row){
    docgetid("table").innerHTML=`
        <tr>
            <td class="td">訂票編號</td>
            <td class="td">訂票時間</td>
            <td class="td">發車時間</td>
            <td class="td">車次</td>
            <td class="td">起站</td>
            <td class="td">訖站</td>
            <td class="td">張數</td>
            <td class="td">取消訂票</td>
        </tr>
    ` // 初始化

    if(row.length==0){
        docgetid("table").innerHTML=`
            <div class="warning">查無相關訂票，請重新搜尋</div>
        `
    }else{
        for(let i=0;i<row.length;i=i+1){
            let tr=doccreate("tr")
            tr.innerHTML=`
                <td class="td">${row[i]["code"]}</td>
                <td class="td">${row[i]["createdate"]}</td>
                <td class="td">${row[i]["arrivetime"]}</td>
                <td class="td">${row[i]["code"]}</td>
                <td class="td">${row[i]["startstation"]}</td>
                <td class="td">${row[i]["endstation"]}</td>
                <td class="td">${row[i]["count"]}</td>
                <td class="td">${row[i]["delinnerhtml"]}</td>
            `
            docappendchild("table",tr)
        }
    }

    docgetall(".cancel").forEach(function(event){
        event.onclick=function(){
            location.href="api.php?admincancelticket=&id="+event.id
        }
    })
}

if(!weblsget("46nationalmoduleduserid")){
    alert("請先登入")
    location.href="login.html"
}

if(!isset(weblsget("46nationalmoduledadminpage"))){ weblsset("46nationalmoduledadminpage",1) }

setTimeout(function(){
    newajax("GET","api/adminsearchticket.php?get=&page="+weblsget("46nationalmoduledadminpage")).onload=function(){
        let data=JSON.parse(this.responseText)
        if(data["success"]){
            maxpage=parseInt(data["maxtotal"]/5)+1
            main(data["data"])
        }
    }
},100);

docgetid("submit").onclick=function(){
    let field="code"
    let value=docgetid("code").value
    if(docgetid("phone").value!=""){
        field="phone"
        value=docgetid("phone").value
    }

    newajax("GET","api.php?ticket=&"+field+"="+value+"&page="+weblsget("46nationalmoduledadminpage")).onload=function(){
        let data=JSON.parse(this.responseText)
        if(data["success"]){
            maxpage=parseInt(data["maxtotal"]/5)+1
            main(data["data"])
        }
    }
}

docgetid("page").value=`頁數: ${weblsget("46nationalmoduledadminpage")}`

docgetid("prev").onclick=function(){
    if(weblsget("46nationalmoduledadminpage")>1){
        weblsset("46nationalmoduledadminpage",parseInt(weblsget("46nationalmoduledadminpage"))-1)

        let url="api/adminsearchticket.php?get=&page="+weblsget("46nationalmoduledadminpage")
        if(docgetid("phone").value!=""){
            url="api.php?ticket=&phone="+docgetid("phone").value+"&page="+weblsget("46nationalmoduledadminpage")
        }else if(docgetid("code").value!=""){
            url="api.php?ticket=&code="+docgetid("code").value+"&page="+weblsget("46nationalmoduledadminpage")
        }

        newajax("GET",url).onload=function(){
            let data=JSON.parse(this.responseText)
            if(data["success"]){
                let row=data["data"]
                main(row)
            }
        }

        docgetid("page").value=`頁數: ${weblsget("46nationalmoduledadminpage")}`
    }
}

docgetid("next").onclick=function(){
    if(weblsget("46nationalmoduledadminpage")<maxpage){
        weblsset("46nationalmoduledadminpage",parseInt(weblsget("46nationalmoduledadminpage"))+1)

        let url="api/adminsearchticket.php?get=&page="+weblsget("46nationalmoduledadminpage")
        if(docgetid("phone").value!=""){
            url="api.php?ticket=&phone="+docgetid("phone").value+"&page="+weblsget("46nationalmoduledadminpage")
        }else if(docgetid("code").value!=""){
            url="api.php?ticket=&code="+docgetid("code").value+"&page="+weblsget("46nationalmoduledadminpage")
        }

        newajax("GET",url).onload=function(){
            let data=JSON.parse(this.responseText)
            if(data["success"]){
                let row=data["data"]
                main(row)
            }
        }

        docgetid("page").value=`頁數: ${weblsget("46nationalmoduledadminpage")}`
    }
}