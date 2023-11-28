let id=row[0]
let insertdata=[]
let questionrownotnone=[]
let maxlen=row[3]

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

        insertdata.push([id,desciption,required,mod,response,showmultimoreresponse,""])
    }

    if(success){
        weblsset("51regionalresponse",insertdata)
    }
}

function save(){
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
        
        console.log("required="+required)
        if(required){
            console.log("response="+response)
            if(response==null){
                alert("第"+id+"題為必填但未填寫")
                success=false
                break
            }
        }

        if(docgetid("showmultimoreresponse"+i)){
            showmultimoreresponse=docgetid("showmultimoreresponse"+i).innerHTML
        }

        console.log([id,desciption,required,mod,response,showmultimoreresponse,""])
        insertdata.push([id,desciption,required,mod,response,showmultimoreresponse,""])
    }

    if(success){
        // 送出資料
        oldajax("POST","api/newresponse.php",JSON.stringify({
            "userid": userid,
            "questionid": row[0],
            "response": insertdata
        }),[]).onload=function(){
            let data=JSON.parse(this.responseText)
            if(data["success"]){
                alert("新增成功")
                location.href="index.php"
            }
        }
    }
}

function main(){
    count=0
    docgetid("maindiv").innerHTML=``

    for(let i=0;i<questionrow.length;i=i+1){
        if(questionrow[i][3]&&questionrow[i][3]!="none"){
            questionrownotnone.push(questionrow[i])
        }
    }

    console.log(questionrownotnone)

    // 輸出每一個題目 START
    for(let i=0;i<questionrownotnone.length;i=i+1){
        let option=questionrownotnone[i][4].split("|&|")
        let output=""
        let required=""
        let modname
        
        if(questionrownotnone[i][2]==true){
            required="<div class='required'>必填*</div>"
        }

        output=output+"題目說明: "+questionrownotnone[i][1]+"<br>"

        if(questionrownotnone[i][3]=="yesno"){
            output=`
                ${output}
                <label class="label" for="${i}yes">是</label>
                <input type="radio" class="yesno radio" id="${i}yes" name="yesno" value="yes">
                <label class="label" for="${i}no">否</label>
                <input type="radio" class="radio" id="${i}no" name="yesno" value="no">
            `
            modname="是非題"
        }else if(questionrownotnone[i][3]=="single"){
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
        }else if(questionrownotnone[i][3]=="multi"){
            for(let j=0;j<6;j=j+1){
                if(!checknull(option[j])){
                    output=`
                        ${output}
                        <label class="label" for="${i+"option"+j}">${option[j]}</label>
                        <input type="checkbox" class="checkbox option${i}" id="${i+"option"+j}" value="${option[j]}">
                    `
                }
            }
            if(questionrownotnone[i][5]==true){
                output=`
                    ${output}<br>
                    其他: <input type='text' class="forminputtext" id="multimoreresponse${i}" name="multiauther"+i+"">
                `
            }
            modname="多選題"
        }else if(questionrownotnone[i][3]=="qa"){
            output=`
                ${output}
                <textarea cols="30" rows="5" class="question" id="qa${i}" placeholder="問答題"></textarea>
            `
            modname="問答題"
        }else{ sql001();location.href="admin.php" }

        docgetid("maindiv").innerHTML=docgetid("maindiv").innerHTML+`
            <div class="questionmain grid" id="${i}">
                <div class="order">
                    ${required}
                    <div class="count" id="count${i}">${questionrownotnone[i][0]}</div>
                </div>
                <div class="newform">
                    ${modname}
                </div>
                <div class="output">
                    <div class="questiondiv" id="output${i}">
                        ${output}
                    </div>
                </div>
            </div>
        `
    }
    // 輸出每一個題目 END
}

docgetid("id").value=row[0]
docgetid("title").value=row[1]

if(userkey=="true"){
    main()
    docgetid("count").value=count
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