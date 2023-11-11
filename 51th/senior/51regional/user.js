let count=0
let id=row[0]
let maincount

function checknull(data){
    if(data==null||data==undefined||data==""){ return true }
    else{ return false }
}

function pregmatch(context,data){ return context.test(data) }

function tempsave(){
    save()
}

function save(){
    let insertdata=[]
    // let maxcount=docgetid("count").value
    // let pagelen=docgetid("pagelen").value
    // if(!pregmatch(/[0-9]+/,maxcount)&&maxcount!=""){
    //     alert("最大長度只能是數字或空白")
    //     maxcount=oldmaxcount
    // }
    // if(!pregmatch(/[0-9]+/,pagelen)){
    //     alert("頁面長度只能是數字")
    //     pagelen=oldpagelen
    // }e
    // insertdata.push([id,docgetid("title").value,count,pagelen,maxcount])
    for(let i=0;i<count;i=i+1){
        let mod
        docgetall(".select"+i).forEach(function(event){
            if(event.checked==true){ mod=event.value }
        })
        let count
        let desciption
        let required
        let option
        let showmultimorerespond
        if(mod=="none"){
            count=docgetid("count"+i).innerHTML
            desciption=""
            required="false"
            option=""
            showmultimorerespond=false
        }else{
            count=docgetid("count"+i).innerHTML
            desciption=docgetid("desciption"+i).value
            required=docgetid("required"+i).checked
            option=""
            if(mod=="single"||mod=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(!checknull(docgetid(i+"option"+j).value)){
                        option=option+docgetid(i+"option"+j).value+"|&|"
                    }
                }
            }else{ option="" }
            showmultimorerespond=true
            if(docgetid("showmultimorerespond"+i)==null||docgetid("showmultimorerespond"+i).checked==false){ showmultimorerespond=false }
        }
        console.log(count)
        insertdata.push([count,desciption,required,mod,option,showmultimorerespond,""])
    }

    console.log(insertdata)
    // newajax("POST","newans.php",[
    //     "data",insertdata
    // ]).onload=function(){
    //     let data=JSON.parse(this.responseText)
    // }
}

function main(){
    count=0
    docgetid("maindiv").innerHTML=``
    for(let i=0;i<maincount;i=i+1){
        if(questionrow[i][3]!="none"){
            count=count+1
            let required=""
            if(questionrow[i][2]==true){
                required="<div class='required'>必填*</div>"
            }
            let mod={
                "none":"未設定",
                "yesno":"是非題",
                "single":"單選題",
                "multi":"多選題",
                "qa":"問答題",
            }
            let modkey=Object.keys(mod)
            let all=""
            let check=0
            for(let j=0;j<modkey.length;j=j+1){
                if(modkey[j]==questionrow[i][3]){
                    check=1
                    all=mod[modkey[j]]
                }
            }
            if(check!=1){ sql001();location.href="admin.php" }
            let output=""
            let option=questionrow[i][4].split("|&|")
            output=output+"題目說明: "+questionrow[i][1]+"<br>"

            if(questionrow[i][3]=="yesno"){
                output=`
                    ${output}
                    <label class="label" for="${i}yes">是</label>
                    <input type="radio" class="yesno radio" id="${i}yes" name="yesno" value="yes">
                    <label class="label" for="${i}no">否</label>
                    <input type="radio" class="radio" id="${i}no" name="yesno" value="no">
                `
            }else if(questionrow[i][3]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(!checknull(option[j])){
                        output=`
                            ${output}
                            <label class="label" for="${i+"option"+j}">${option[j]}</label>
                            <input type="radio" class="radio option${i}" id="${i+"option"+j}" name="single${i}" value="${option[j]}">
                        `
                    }
                }
            }else if(questionrow[i][3]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(!checknull(option[j])){
                        output=`
                            ${output}
                            <label class="label" for="${i+"option"+j}">${option[j]}</label>
                            <input type="checkbox" class="checkbox option${i}" id="${i+"option"+j}" value="${option[j]}">
                        `
                    }
                }
                if(questionrow[i][5]==true){
                    output=`
                    ${output}<br>
                    其他: <input type='text' class="forminputtext" id="multimorerespond"+i+"" name="multiauther"+i+"">
                `
                }
            }else if(questionrow[i][3]=="qa"){
                output=`
                    output
                    <textarea cols="30" rows="5" class="question" placeholder="問答題"></textarea>
                `
            }else{ sql001();location.href="admin.php" }
            docgetid("maindiv").innerHTML=docgetid("maindiv").innerHTML+`
                <div class="grid" id="${i}">
                    <div class="order">
                        ${required}
                        <div id="count${i}">${questionrow[i][0]}</div>
                    </div>
                    <div class="newform">
                        ${all}
                    </div>
                    <div class="output">
                        <div class="questiondiv" id="output${i}">
                            ${output}
                        </div>
                    </div>
                </div>
            `
        }
    }
}

docgetid("id").value=row[0]
docgetid("title").value=row[1]

if(userkey=="true"){
    questionrow=Object.values(JSON.parse(questionrow))
    maincount=questionrow.length
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