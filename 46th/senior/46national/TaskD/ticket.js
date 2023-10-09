let traincodelist
let trainlist
let traindata
let trainid
let code

newajax("GET","api.php?traincodelist=").onload=function(){ traincodelist=JSON.parse(this.responseText) }
newajax("GET","/backend/46nationalmoduled/mangertrain/").onload=function(){ trainlist=JSON.parse(this.responseText) }

setTimeout(function(){
    let traincode="<option value=\"na\">車次代碼</option>"
    for(let i=0;i<traincodelist.length;i=i+1){
        traincode=traincode+`<option value="${i}">${traincodelist[i]}</option>`
    }

    docgetid("code").innerHTML=traincode

    docgetid("code").onchange=function(){
        if(this.value!="na"){
            let stopdata=""
            let count=1
            code=this.value

            trainid=trainlist["data"][0][code][0]

            for(let i=0;i<trainlist["data"][1].length;i=i+1){
                if(trainlist["data"][1][i][1]==trainid){
                    for(let j=0;j<trainlist["data"][2].length;j=j+1){
                        if(trainlist["data"][2][j][0]==trainlist["data"][1][i][2]){
                            stopdata=stopdata+"<option value=\""+trainlist["data"][2][j][0]+"\" data-id='"+j+"'>"+count+". "+trainlist["data"][2][j][2]+"</option>"
                            count=count+1
                        }
                    }
                }
            }

            docgetid("start").innerHTML="<option value=\"na\">起程站</option>"+stopdata
            docgetid("end").innerHTML="<option value=\"na\">終點站</option>"+stopdata
        }
    }
},100)

docgetid("submit").onclick=function(){
    let phone=docgetid("phone").value
    let date=docgetid("date").value
    let code=docgetid("code").value
    let start=docgetid("start").value
    let end=docgetid("end").value
    let count=docgetid("count").value
    let day=new Date(date).getDay()
    let success=true
    let error=[]
    let notwrite=""

    if(phone==""){
        notwrite=notwrite+"手機號碼 "
    }

    if(date==""){
        notwrite=notwrite+"乘車日期 "
    }

    if(code=="na"){
        notwrite=notwrite+"車次代碼 "
    }

    if(start=="na"){
        notwrite=notwrite+"起程站 "
    }

    if(end=="na"){
        notwrite=notwrite+"終點站 "
    }

    if(count==""){
        notwrite=notwrite+"車票張數 "
    }

    if(notwrite!=""){
        error.push(notwrite+"項目未填寫")
        success=false
    }

    if(isset(code)){
        if(day!=trainlist["data"][0][code][3]){
            console.log(trainlist["data"][0][code])
            error.push("列車日期錯誤 無此班列車")
            success=false
        }
    }

    if(!regexpmatch(count,"^[1-9]([0-9]{0,3})$")){
        error.push("訂票數量錯誤(1~1000)")
        success=false
    }

    if(false){
        error.push("該區間以無空位")
        success=false
    }

    if(date<=new Date()){
        error.push("發車時間已過")
        success=false
    }

    if(docgetid("start").dataset.id>=docgetid("end").dataset.id){
        error.push("起訖站相同或不正確")
        success=false
    }

    if(docgetid("check").style.backgroundColor!="green"){
        error.push("尚未通過驗證碼")
        success=false
    }

    if(success){
        let littleeng="abcdefghijklmnopqrstuvwxyz"
        let bigeng=littleeng.toUpperCase()
        let number="1234567890"
        let ticketcode=""

        for(let i=0;i<12;i=i+1){
            let key=parseInt(Math.random()*3)
            if(key==0){
                ticketcode=ticketcode+littleeng[parseInt(Math.random()*26)]
            }else if(key==1){
                ticketcode=ticketcode+bigeng[parseInt(Math.random()*26)]
            }else{
                ticketcode=ticketcode+number[parseInt(Math.random()*10)]
            }
        }

        docgetid("error").innerHTML=`` // 清空error區塊

        // 傳送資料
        newajax("POST","/backend/46nationalmoduled/newticket/",JSON.stringify({
            "trainid": trainid,
            "typeid": trainlist["data"][0][code][1],
            "startstationid": start,
            "endstationid": end,
            "code": ticketcode,
            "phone": phone,
            "count": count,
            "statu": "1",
            "getgodate": date
        }),[
            ["Content-Type","application/json"]
        ]).onload=function(){
            let data=JSON.parse(this.responseText)

            if(data["success"]){
                newajax("POST","api/ticketsms.php",formdata([
                    ["phone",phone],
                    ["code",ticketcode],
                    ["getgodate",date],
                    ["count",count],
                    ["startstation",data["data"]["startstation"]],
                    ["endstation",data["data"]["endstation"]],
                    ["traincode",data["data"]["traincode"]],
                    ["startstop",data["data"]["startstop"]],
                    ["total",data["data"]["total"]]
                ])).onload=function(){
                    let data2=JSON.parse(this.responseText)
                    if(data2["success"]){
                        lightbox(null,"lightbox",function(){
                            return `
                                <h1>訂票成功</h1>
                                <hr>
                                <div class='ticketlist'>
                                    詳細資料如下:<br>
                                    訂票編號: ${ticketcode}<br>
                                    手機號碼: ${phone}<br>
                                    發車時間: ${data["data"]["startstop"]}<br>
                                    車次代碼: ${data["data"]["traincode"]}<br>
                                    起程站: ${data["data"]["startstation"]}<br>
                                    終點站: ${data["data"]["endstation"]}<br>
                                    張數: ${count}<br>
                                    票價: ${data["data"]["price"]}<br>
                                    總價: ${data["data"]["total"]}<br>
                                </div>
                                <input type='button' class='button' onclick='location.reload()' value='返回'>
                            `
                        },clickcolse="none")
                    }
                }
            }else{
                alert(data["data"])
            }
        }
    }else{
        docgetid("error").innerHTML=`
            錯誤內容如下: <br>
            ${error.join(", ")}
        `
    }
}

docgetid("check").onclick=function(){
    docgetid("check").disabled="true"
    docgetid("check").style.backgroundColor="green"
    docgetid("check").style.color="black"
}

startmacossection()