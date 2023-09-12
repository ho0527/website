function statetest(state){
    if(state=="SUCCESS"){
        return "green"
    }else if(state=="FAILED"){
        return "red"
    }else if(state=="N/A"||state=="subjective"){
        return "gray"
    }else{
        return "white"
    }
}

function linktest(link,title){
    if(link["link"]!=""&&link["link"]!=undefined&&link["state"]!="N/A"&&link["state"]!="subjective"){
        return "<a href='"+link["link"]+"' class='a'>"+title+"</a>"
    }else{
        return title
    }
}

let ajax=new XMLHttpRequest()

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)["data"]
    for(let i=0;i<data.length;i=i+1){
        let title=data[i]["title"]
        let list=data[i]["data"]
        let listdata=""
        if(data[i]["ps"]=="list"){
            for(let j=0;j<list.length;j=j+1){
                let listdata2=""
                for(let k=0;k<list[j]["data"].length;k=k+1){
                    let questiondata=""
                    let question=list[j]["data"][k]["data"]

                    for(let l=0;l<question.length;l=l+1){
                        let descriptiondata=""
                        for(let m=0;m<question[l]["data"].length;m=m+1){
                            descriptiondata=descriptiondata+`
                                <div class="descriptiondiv">
                                    <div class="no">-</div>
                                    <div class="title m5">${question[l]["data"][m]["description"]}</div>
                                    <div class="dot">............</div>
                                    <div class="state" style="color: ${statetest(question[l]["data"][m]["state"])}">${question[l]["data"][m]["state"]}</div>
                                </div>
                            `
                        }
                        questiondata=questiondata+`
                            <div class="questiondiv">
                                <div class="no">no.${question[l]["no"]}</div>
                                <div class="title m5">${linktest(question[l],question[l]["description"])}</div>
                                <div class="dot">............</div>
                                <div class="state" style="color: ${statetest(question[l]["state"])}">${question[l]["state"]}</div>
                            </div>
                            <div class="list3">${descriptiondata}</div>
                        `
                    }

                    listdata2=listdata2+`
                        <div class="listdiv">
                            <div class="title">項目: ${list[j]["data"][k]["list"]}-${list[j]["data"][k]["description"]}</div>
                            <div class="dot">............</div>
                            <div class="state" style="color: ${statetest(list[j]["data"][k]["state"])}">${list[j]["data"][k]["state"]}</div>
                        </div>
                        <div class="list2">${questiondata}</div>
                    `
                }

                listdata=listdata+`
                    <div class="listdiv">
                        <div class="title">${linktest(list[j],list[j]["title"])}</div>
                        <div class="dot">............</div>
                        <div class="state" style="color: ${statetest(list[j]["state"])}">${list[j]["state"]}</div>
                        <div class="cdate">createdate: ${list[j]["createdate"]}</div>
                        <div class="udate">updatedate: ${list[j]["updatedate"]}</div>
                    </div>
                    <div class="list2">${listdata2}</div>
                `
            }
        }else if(data[i]["ps"]=="question"){
            for(let j=0;j<list.length;j=j+1){
                let questiondata=""

                for(let k=0;k<list[j]["data"].length;k=k+1){
                    let question=list[j]["data"]
                    let descriptiondata=""

                    for(let l=0;l<question[k]["data"].length;l=l+1){
                        descriptiondata=descriptiondata+`
                            <div class="descriptiondiv">
                                <div class="no">-</div>
                                <div class="title m5">${question[k]["description"]}</div>
                                <div class="dot">............</div>
                                <div class="state" style="color: ${statetest(question[k]["state"])}">${question[k]["state"]}</div>
                            </div>
                        `
                    }

                    questiondata=questiondata+`
                        <div class="questiondiv">
                            <div class="no">no.${question[k]["no"]}</div>
                            <div class="title m5">${question[k]["description"]}</div>
                            <div class="dot">............</div>
                            <div class="state" style="color: ${statetest(question[k]["state"])}">${question[k]["state"]}</div>
                        </div>
                        <div class="list3">${descriptiondata}</div>
                    `
                }

                listdata=listdata+`
                    <div class="listdiv">
                        <div class="title">項目: ${list[j]["list"]}-${list[j]["description"]}</div>
                        <div class="dot">............</div>
                        <div class="state" style="color: ${statetest(list[j]["state"])}">${list[j]["state"]}</div>
                    </div>
                    <div class="list2">${questiondata}</div>
                `
            }
        }

        document.getElementById("body").innerHTML=document.getElementById("body").innerHTML+`
            <div class="subjectdiv">
                <div class="subject">
                    <div class="title">${linktest(data[i],title)}</div>
                    .......
                    <div class="state" style="color: ${statetest(data[i]["state"])}">${data[i]["state"]}</div>
                    <div class="cdate">createdate: ${data[i]["createdate"]}</div>
                    <div class="udate">updatedate: ${data[i]["updatedate"]}</div>
                </div>
                <div class="list1">${listdata}</div>
            <div>
        `
    }
}

ajax.open("GET","list.json")
ajax.send()

let ajax2=new XMLHttpRequest()

ajax2.onload=function(){
    let data=JSON.parse(ajax2.responseText)["data"]
    for(let i=0;i<data.length;i=i+1){
        let title=data[i]["title"]
        let list=data[i]["data"]
        let listdata=""
        if(data[i]["ps"]=="list"){
            for(let j=0;j<list.length;j=j+1){
                let listdata2=""
                for(let k=0;k<list[j]["data"].length;k=k+1){
                    let questiondata=""
                    let question=list[j]["data"][k]["data"]

                    for(let l=0;l<question.length;l=l+1){
                        let descriptiondata=""
                        for(let m=0;m<question[l]["data"].length;m=m+1){
                            descriptiondata=descriptiondata+`
                                <div class="descriptiondiv">
                                    <div class="no">-</div>
                                    <div class="title m5">${question[l]["data"][m]["description"]}</div>
                                    <div class="dot">............</div>
                                    <div class="state" style="color: ${statetest(question[l]["data"][m]["state"])}">${question[l]["data"][m]["state"]}</div>
                                </div>
                            `
                        }
                        questiondata=questiondata+`
                            <div class="questiondiv">
                                <div class="no">no.${question[l]["no"]}</div>
                                <div class="title m5">${linktest(question[l],question[l]["description"])}</div>
                                <div class="dot">............</div>
                                <div class="state" style="color: ${statetest(question[l]["state"])}">${question[l]["state"]}</div>
                            </div>
                            <div class="list3">${descriptiondata}</div>
                        `
                    }

                    listdata2=listdata2+`
                        <div class="listdiv">
                            <div class="title">項目: ${list[j]["data"][k]["list"]}-${list[j]["data"][k]["description"]}</div>
                            <div class="dot">............</div>
                            <div class="state" style="color: ${statetest(list[j]["data"][k]["state"])}">${list[j]["data"][k]["state"]}</div>
                        </div>
                        <div class="list2">${questiondata}</div>
                    `
                }

                listdata=listdata+`
                    <div class="listdiv">
                        <div class="title">${linktest(list[j],list[j]["title"])}</div>
                        <div class="dot">............</div>
                        <div class="state" style="color: ${statetest(list[j]["state"])}">${list[j]["state"]}</div>
                        <div class="cdate">createdate: ${list[j]["createdate"]}</div>
                        <div class="udate">updatedate: ${list[j]["updatedate"]}</div>
                    </div>
                    <div class="list2">${listdata2}</div>
                `
            }
        }else if(data[i]["ps"]=="question"){
            for(let j=0;j<list.length;j=j+1){
                let questiondata=""

                for(let k=0;k<list[j]["data"].length;k=k+1){
                    let question=list[j]["data"]
                    let descriptiondata=""

                    for(let l=0;l<question[k]["data"].length;l=l+1){
                        descriptiondata=descriptiondata+`
                            <div class="descriptiondiv">
                                <div class="no">-</div>
                                <div class="title m5">${question[k]["description"]}</div>
                                <div class="dot">............</div>
                                <div class="state" style="color: ${statetest(question[k]["state"])}">${question[k]["state"]}</div>
                            </div>
                        `
                    }

                    questiondata=questiondata+`
                        <div class="questiondiv">
                            <div class="no">no.${question[k]["no"]}</div>
                            <div class="title m5">${question[k]["description"]}</div>
                            <div class="dot">............</div>
                            <div class="state" style="color: ${statetest(question[k]["state"])}">${question[k]["state"]}</div>
                        </div>
                        <div class="list3">${descriptiondata}</div>
                    `
                }

                listdata=listdata+`
                    <div class="listdiv">
                        <div class="title">項目: ${list[j]["list"]}-${list[j]["description"]}</div>
                        <div class="dot">............</div>
                        <div class="state" style="color: ${statetest(list[j]["state"])}">${list[j]["state"]}</div>
                    </div>
                    <div class="list2">${questiondata}</div>
                `
            }
        }

        document.getElementById("body").innerHTML=document.getElementById("body").innerHTML+`
            <div class="subjectdiv">
                <div class="subject">
                    <div class="title">${linktest(data[i],title)}</div>
                    .......
                    <div class="state" style="color: ${statetest(data[i]["state"])}">${data[i]["state"]}</div>
                    <div class="cdate">createdate: ${data[i]["createdate"]}</div>
                    <div class="udate">updatedate: ${data[i]["updatedate"]}</div>
                </div>
                <div class="list1">${listdata}</div>
            <div>
        `
    }
}

ajax2.open("GET","listmyself.json")
ajax2.send()

startmacossection()