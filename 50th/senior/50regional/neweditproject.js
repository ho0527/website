if(key=="new"){
    let facingcount=1
    
    docgetid("newfacing").onclick=function(){
        if(facingcount>=10){
            let div=doccreate("div")
            div.classList.add("facingdiv")
            div.innerHTML=`
                <div class="facing grid">
                    <input type="text" class="input2 facingname" placeholder="面向名稱">
                    <input type="text" class="input2 facingdesciption" placeholder="面向說明">
                    <input type="button" class="noborderbutton facingdelect" value="X">
                </div>
            `
            docgetid("productfacing").appendChild(div)
            facingcount=facingcount+1
        }else{ alert("以到面向上限") }
    
        for(let i=0;i<docgetall(".facingdelect").length;i=i+1){
            docgetall(".facingdelect")[i].onclick=function(){
                docgetall(".facing")[i].remove()
                facingcount=facingcount-1
            }
        }
    }
    
    docgetall(".facingdelect")[0].onclick=function(){
        docgetall(".facing")[0].remove()
        facingcount=facingcount-1
    }
    
    docgetid("submit").onclick=function(){
        let data=[]
        let productname=docgetid("name").value
        let productdesciption=docgetid("desciption").value
        let leader="" // didnt make it
        let member=[] // didnt make it
        let facingname=[]
        let facingdesciption=[]
        docgetall(".facingname").forEach(function(evnet){
            facingname.push(evnet.value)
        })
        docgetall(".facingdesciption").forEach(function(evnet){
            facingdesciption.push(evnet.value)
        })
        data.push(productname,productdesciption,leader,member,facingname,facingdesciption)
        fetch("api/newproject.php",{
            method:"POST",
            body:JSON.stringify(data),
            headers:{ "Content-Type":"application/json" },
        }).then(function(response){ return response.text() })
        .catch(function(event){ console.error("[ERROR]",event) })
        .then(function(){ alert("儲存成功");location.reload() })
        conlog(data)
    }
    
    divsort("user",".sort")
}else{
    let facingcount=1
    
    docgetid("newfacing").onclick=function(){
        if(facingcount>=10){
            let div=doccreate("div")
            div.classList.add("facingdiv")
            div.innerHTML=`
                <div class="facing grid">
                    <input type="text" class="input2 facingname" placeholder="面向名稱">
                    <input type="text" class="input2 facingdesciption" placeholder="面向說明">
                    <input type="button" class="noborderbutton facingdelect" value="X">
                </div>
            `
            docgetid("productfacing").appendChild(div)
            facingcount=facingcount+1
        }else{ alert("以到面向上限") }
    
        for(let i=0;i<docgetall(".facingdelect").length;i=i+1){
            docgetall(".facingdelect")[i].onclick=function(){
                docgetall(".facing")[i].remove()
                facingcount=facingcount-1
            }
        }
    }
    
    docgetall(".facingdelect")[0].onclick=function(){
        docgetall(".facing")[0].remove()
        facingcount=facingcount-1
    }
    
    docgetid("submit").onclick=function(){
        let data=[]
        let productname=docgetid("name").value
        let productdesciption=docgetid("desciption").value
        let leader="" // didnt make it
        let member=[] // didnt make it
        let facingname=[]
        let facingdesciption=[]
        docgetall(".facingname").forEach(function(evnet){
            facingname.push(evnet.value)
        })
        docgetall(".facingdesciption").forEach(function(evnet){
            facingdesciption.push(evnet.value)
        })
        data.push(productname,productdesciption,leader,member,facingname,facingdesciption)
        fetch("api/newproject.php",{
            method:"POST",
            body:JSON.stringify(data),
            headers:{ "Content-Type":"application/json" },
        }).then(function(response){ return response.text() })
        .catch(function(event){ console.error("[ERROR]",event) })
        .then(function(){ alert("儲存成功");location.reload() })
        conlog(data)
    }
    
    divsort("user",".sort")
}