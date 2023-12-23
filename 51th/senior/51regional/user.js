let id=row[0]
let insertdata=[]
let questionrownotnone=[]
let maxlen=row[3]
let page=0
let maxpage

/*
questionrow:
questionid,description,required,mod,option,showmultimoreresponse,ps
*/

function checknull(data){
    if(data==null||data==undefined||data==""){ return true }
    else{ return false }
}

function pregmatch(context,data){ return context.test(data) }

function tempsave(){
    let success=true
    let tempdata=[]

    docgetall(".questionmain").forEach(function(event){
        let id=event.id
        let no=event.querySelector(".order>.count").innerHTML // questionrownotnone[i][0]
        let tempmod=event.dataset.mod //questionrownotnone[i][3]
        let desciption=event.dataset.desciption
        let required=event.dataset.required
        let showmultimoreresponse=""
        let response=null
        let mod=""

        if(tempmod=="yesno"){
            if(docgetid(id+"yes").checked){
                response=true
            }else if(docgetid(id+"no").checked){
                response=false
            }
            mod="yesno"
        }else if(tempmod=="single"){
            let option=[]
            for(let j=0;j<6;j=j+1){
                if(docgetid(id+"option"+j)){
                    if(docgetid(id+"option"+j).checked){
                        option.push(docgetid(id+"option"+j).value)
                    }
                }
            }
            if(option.length>0){
                response=option.join("|&|")
            }
            mod="single"
        }else if(tempmod=="multi"){
            let option=[]
            for(let j=0;j<6;j=j+1){
                if(docgetid(id+"option"+j)){
                    if(docgetid(id+"option"+j).checked){
                        option.push(docgetid(id+"option"+j).value)
                    }
                }
            }
            if(option.length>0){
                response=option.join("|&|")
            }
            mod="multi"
        }else{
            if(docgetid("qa"+id).value!=""){
                response=docgetid("qa"+id).value
            }
            mod="qa"
        }

        if(required){
            if(response==null){
                alert("第"+no+"題為必填但未填寫")
                success=false
                return
            }
        }

        if(docgetid("showmultimoreresponse"+i)){
            showmultimoreresponse=docgetid("showmultimoreresponse"+i).innerHTML
        }

        tempdata.push([no,desciption,required,mod,response,showmultimoreresponse,""])
    })

    if(success){
        for(let i=0;i<insertdata.length;i=i+1){
            let check=false
            for(let j=0;j<tempdata.length;j=j+1){
                if(insertdata[i][0]==tempdata[j][0]){
                    insertdata[i]=tempdata[j]
                    check=true
                }
            }
            if(!check){
                insertdata.push(tempdata[j])
            }
        }
    }
}

function save(){
    if(page.length==maxpage-1){
        let success=true

        for(let i=0;i<questionrownotnone.length;i=i+1){
            let id=questionrownotnone[i][0]
            let mod=questionrownotnone[i][3]
            let desciption=questionrownotnone[i][1]
            let required=questionrownotnone[i][2]
            let showmultimoreresponse=""
            let response=null

            if(mod=="yesno"){
                if(docgetid(i+"yes").checked){
                    response=true
                }else if(docgetid(i+"no").checked){
                    response=false
                }
            }else if(mod=="single"||mod=="multi"){
                let option=[]
                for(let j=0;j<6;j=j+1){
                    if(docgetid(i+"option"+j)){
                        if(docgetid(i+"option"+j).checked){
                            option.push(docgetid(i+"option"+j).value)
                        }
                    }
                }
                if(option.length>0){
                    response=option.join("|&|")
                }
            }else{
                if(docgetid("qa"+i).value!=""){
                    response=docgetid("qa"+i).value
                }
            }

            if(required){
                if(response==null){
                    alert("第"+id+"題為必填但未填寫")
                    success=false
                    break
                }
            }

            if(docgetid("showmultimoreresponse"+i)){
                showmultimoreresponse=docgetid("showmultimoreresponse"+i).innerHTML
            }

            // console.log([id,desciption,required,mod,response,showmultimoreresponse,""])
            insertdata.push([id,desciption,required,mod,response,showmultimoreresponse,""])
        }

        if(success){
            // 送出資料
            ajax("POST","api/newresponse.php",function(event){
                let data=JSON.parse(event.responseText)
                if(data["success"]){
                    alert("新增成功")
                    location.href="index.php"
                }
            },JSON.stringify({
                "userid": userid,
                "questionid": row[0],
                "response": insertdata
            }))
        }
    }else{
        alert("請先翻到最後一再送出")
    }
}

function main(){
    ajax("GET","api.php?getquestion=&id="+id+"&page="+page+"&maxlen="+maxlen,function(event){
        let data=JSON.parse(event.responseText)

        if(data["success"]){
            let row=data["data"]

            count=0
            maxpage=data["maxpage"]
            docgetid("maindiv").innerHTML=``
        
            // 輸出每一個題目 START
            for(let i=0;i<row.length;i=i+1){
                let required="false"
                let option=row[i][4].split("|&|")
                let output=""
                let requiredinnerhtml=""
                let modname
                
                if(row[i][2]==true){
                    requiredinnerhtml="<div class='required'>必填*</div>"
                    required="true"
                }
        
                output=output+"題目說明: "+row[i][1]+"<br>"
        
                if(row[i][3]=="yesno"){
                    output=`
                        ${output}
                        <label class="label" for="${i}yes">是</label>
                        <input type="radio" class="yesno radio" id="${i}yes" name="yesno" value="yes">
                        <label class="label" for="${i}no">否</label>
                        <input type="radio" class="radio" id="${i}no" name="yesno" value="no">
                    `
                    modname="是非題"
                }else if(row[i][3]=="single"){
                    for(let j=0;j<6;j=j+1){
                        if(!checknull(option[j])){
                            output=`
                                ${output}
                                <label class="label" for="${i+"option"+j}">${option[j]}</label>
                                <input type="radio" class="radio option${i}" id="${i+"option"+j}" name="single${i}" value="${option[j]}">
                            `
                        }
                    }
                    modname="單選題"
                }else if(row[i][3]=="multi"){
                    for(let j=0;j<6;j=j+1){
                        if(!checknull(option[j])){
                            output=`
                                ${output}
                                <label class="label" for="${i+"option"+j}">${option[j]}</label>
                                <input type="checkbox" class="checkbox option${i}" id="${i+"option"+j}" value="${option[j]}">
                            `
                        }
                    }
                    if(row[i][5]==true){
                        output=`
                            ${output}<br>
                            其他: <input type='text' class="forminputtext" id="multimoreresponse${i}" name="multiauther"+i+"">
                        `
                    }
                    modname="多選題"
                }else if(row[i][3]=="qa"){
                    output=`
                        ${output}
                        <textarea cols="30" rows="5" class="question" id="qa${i}" placeholder="問答題"></textarea>
                    `
                    modname="問答題"
                }else{ sql001();location.href="admin.php" }
        
                docgetid("maindiv").innerHTML=docgetid("maindiv").innerHTML+`
                    <div class="questionmain grid" id="${i}" data-required="${required}" data-mod="${row[i][3]}" data-description="${row[i][1]}">
                        <div class="order">
                            ${requiredinnerhtml}
                            <div class="count" id="count${i}">${row[i][0]}</div>
                        </div>
                        <div class="newform">
                            ${modname}
                        </div>
                        <div class="textcenter output">
                            <div class="questiondiv" id="output${i}">
                                ${output}
                            </div>
                        </div>
                    </div>
                `
            }
        }else{
            alert(data["data"])
            location.href="admin.php"
        }
    })
    // 輸出每一個題目 END
}

docgetid("id").value=row[0]
docgetid("title").value=row[1]
docgetid("count").value=row[2]

if(userkey=="true"){
    main()
}

docgetid("prev").onclick=function(){
    if(0<page){
        page=page-1
        docgetid("progress").style.width=parseInt((page/maxpage)*100)+"%"
        docgetid("progresstext").innerHTML=`${parseInt((page/maxpage)*100)}/100%`
        tempsave()
        main()
    }
}

docgetid("next").onclick=function(){
    if(page+1<maxpage){
        page=page+1
        docgetid("progress").style.width=parseInt((page/maxpage)*100)+"%"
        docgetid("progresstext").innerHTML=`${parseInt((page/maxpage)*100)}/100%`
        tempsave()
        main()
    }
}

document.onkeydown=function(event){
    if(event.key=="Escape"){
        location.href="api.php?cancel="
    }
    if(event.ctrlKey&&event.key=="s"){
        event.preventDefault()
        check()
    }
}

startmacossection()