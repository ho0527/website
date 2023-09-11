function statetest(state){
    if(state=="SUCCESS"){
        return "green"
    }else if(state=="FAILED"){
        return "red"
    }else if(state=="N/A"){
        return "gray"
    }else{
        return "white"
    }
}


let ajax=new XMLHttpRequest()

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    for(let i=0;i<data["data"].length;i=i+1){
        if(data["data"][i]["ps"]=="list"){
            let title=data["data"][i]["title"]
            let list=data["data"][i]["data"]
            let listdata=""
            let statecolor=""

            for(let j=0;j<list.length;j=j+1){
                let liststatecolor=""
                let listlinkdata=""
                if(list[j]["state"]=="SUCCESS"){
                    liststatecolor="green"
                    listlinkdata="<a href='"+list[j]["link"]+"' class='a'>"+list[j]["title"]+"</a>"
                }else if(list[j]["state"]=="FAILED"){
                    liststatecolor="red"
                    listlinkdata="<a href='"+list[j]["link"]+"' class='a'>"+list[j]["title"]+"</a>"
                }else if(list[j]["state"]=="N/A"){
                    liststatecolor="gray"
                    listlinkdata=list[j]["title"]
                }else{
                    liststatecolor="white"
                    listlinkdata="<a href='"+list[j]["link"]+"' class='a'>"+list[j]["title"]+"</a>"
                }
                listdata=listdata+`
                    <div class="listdiv">
                        <div class="title">${listlinkdata}</div>
                        ............
                        <div class="state" style="color: ${liststatecolor}">${list[j]["state"]}</div>
                        <div class="cdate">createdate: ${list[j]["createdate"]}</div>
                        <div class="udate">updatedate: ${list[j]["updatedate"]}</div>
                        <div class="edate">enddate: ${list[j]["enddate"]}</div>
                    </div>
                `
            }

            document.getElementById("body").innerHTML=document.getElementById("body").innerHTML+`
                <div class="subjectdiv">
                    <div class="subject">
                        <div class="title"><a href="${data["data"][i]["link"]}" class="a">${title}</a></div>
                        .......
                        <div class="state" style="color: ${statetest(data["data"][i]["state"])}">${data["data"][i]["state"]}</div>
                        <div class="cdate">createdate: ${data["data"][i]["createdate"]}</div>
                        <div class="udate">updatedate: ${data["data"][i]["updatedate"]}</div>
                        <div class="edate">enddate: ${data["data"][i]["enddate"]}</div>
                    </div>
                    <div class="list">${listdata}</div>
                <div>
            `
        }else if(data["data"][i]["ps"]=="question"){
            let title=data["data"][i]["title"]
            let list=data["data"][i]["data"]
            let listdata=""

            for(let j=0;j<list.length;j=j+1){
                let questiondata=""

                console.log(list[j]["data"])
                for(let k=0;k<list[j]["data"].length;k=k+1){
                    let question=list[j]["data"]

                    questiondata=questiondata+`
                        <div class="questiondiv">
                            <div class="no">no.${question[k]["no"]}</div>
                            <div class="title m5">${question[k]["description"]}</div>
                            ............
                            <div class="state" style="color: ${statetest(question[k]["state"])}">${question[k]["state"]}</div>
                        </div>
                    `
                }

                listdata=listdata+`
                    <div class="listdiv">
                        <div class="title">項目: ${list[j]["list"]}-${list[j]["description"]}</div>
                        ............
                        <div class="state" style="color: ${statetest(list[j]["state"])}">${list[j]["state"]}</div>
                    </div>
                    <div class="list2">
                        ${questiondata}
                    </div>
                `
            }

            document.getElementById("body").innerHTML=document.getElementById("body").innerHTML+`
                <div class="subjectdiv">
                    <div class="subject">
                        <div class="title"><a href="${data["data"][i]["link"]}" class="a">${title}</a></div>
                        .......
                        <div class="state" style="color: ${statetest(data["data"][i]["state"])}">${data["data"][i]["state"]}</div>
                        <div class="cdate">createdate: ${data["data"][i]["createdate"]}</div>
                        <div class="udate">updatedate: ${data["data"][i]["updatedate"]}</div>
                        <div class="edate">enddate: ${data["data"][i]["enddate"]}</div>
                    </div>
                    <div class="list">${listdata}</div>
                <div>
            `
        }

    }
}

ajax.open("GET","list.json")
ajax.send()