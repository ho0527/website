console.log(row)
let count=0
let id=row[0]
let maincount

function checknull(data){
    if(data==null||data==undefined||data==""){ return true }
    else{ return false }
}

function pregmatch(context,data){ return context.test(data) }

function main(){
    count=0
    document.getElementById("maintable").innerHTML=``
    for(let i=0;i<maincount;i=i+1){
        console.log(questionrow[i])
        if(questionrow[i][3]!="none"){
            count=count+1
            let tr1=document.createElement("tr")
            tr1.classList.add("div"+i)
            tr1.id="tr1"+i
            document.getElementById("maintable").appendChild(tr1)
            let td1=document.createElement("td")
            td1.rowSpan=2
            td1.classList.add("order")
            let required=""
            if(questionrow[i][2]==true){
                required="<div class='required'>*必填</div>"
            }
            td1.innerHTML=`
                ${required}
                <div class="questiondel" id="${i}">X</div>
                <div id="count${i}">${i+1}</div>
            `
            let td2=document.createElement("td")
            td2.classList.add("newform")
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
            td2.innerHTML=`${all}`
            document.getElementById("tr1"+i).appendChild(td1)
            document.getElementById("tr1"+i).appendChild(td2)
            let tr2=document.createElement("tr")
            tr2.classList.add("div"+i)
            tr2.id="tr2"+i
            document.getElementById("maintable").appendChild(tr2)
            let td3=document.createElement("td")
            td3.classList.add("output")
            let output=""
            let option=questionrow[i][4].split("|&|")
            output=output+"題目說明:"+questionrow[i][1]+"<br>"
            if(questionrow[i][3]=="yesno"){
                output=output+"是<input type='radio' class='yesno' name='yesno' value='yes'>否<input type='radio' name='yesno' value='no'>"
            }else if(questionrow[i][3]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(!checknull(option[j])){
                        output=output+("  "+"<input type='radio' id='"+(i+"option"+j)+"' name='single"+i+"' class='forminputtext' value='"+option[j]+"'>"+option[j])
                    }
                }
            }else if(questionrow[i][3]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(!checknull(option[j])){
                        output=output+("  "+"<input type='checkbox' id='"+(i+"option"+j)+"' name='"+i+"multi"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>"+option[j])
                    }
                }
                if(questionrow[i][5]==true){
                    output=output+"<br><input type='text' id='multimorerespond"+i+"' name='multiauther"+i+"' class='forminputlongtext'>"
                }
            }else if(questionrow[i][3]=="qa"){
                output=output+"<textarea cols='30' rows='5' placeholder='問答題'></textarea>"
            }else{ sql001();location.href="admin.php" }
            td3.innerHTML=`
                <div class="questiondiv" id="output${i}">
                    ${output}
                </div>
            `
            document.getElementById("tr2"+i).appendChild(td3)
        }
    }
}

function save(){
    let insertdata=[]
    let maxcount=document.getElementById("maxcount").value
    let pagelen=document.getElementById("pagelen").value
    if(!pregmatch(/[0-9]+/,maxcount)&&maxcount!=""){
        alert("最大長度只能是數字或空白")
        maxcount=oldmaxcount
    }
    if(!pregmatch(/[0-9]+/,pagelen)){
        alert("頁面長度只能是數字")
        pagelen=oldpagelen
    }
    insertdata.push([id,document.getElementById("title").value,count,pagelen,maxcount])
    for(let i=0;i<count;i=i+1){
        let mod
        document.querySelectorAll(".select"+i).forEach(function(event){
            if(event.checked==true){ mod=event.value }
        })
        let count
        let desciption
        let required
        let option
        let showmultimorerespond
        if(mod=="none"){
            count=document.getElementById("count"+i).innerHTML
            desciption=""
            required="false"
            option=""
            showmultimorerespond=false
        }else{
            count=document.getElementById("count"+i).innerHTML
            desciption=document.getElementById("desciption"+i).value
            required=document.getElementById("required"+i).checked
            option=""
            if(mod=="single"||mod=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(!checknull(document.getElementById(i+"option"+j).value)){
                        option=option+document.getElementById(i+"option"+j).value+"|&|"
                    }
                }
            }else{ option="" }
            showmultimorerespond=true
            if(document.getElementById("showmultimorerespond"+i)==null||document.getElementById("showmultimorerespond"+i).checked==false){ showmultimorerespond=false }
        }
        insertdata.push([count,desciption,required,mod,option,showmultimorerespond,""])
    }
    fetch("newform.php",{
        method:"POST",
        body:JSON.stringify(insertdata),
        headers:{ "Content-Type":"application/json" },
    }).then(function(response){ return response.text() })
    .catch(function(event){ console.error("Error:",event) })
    .then(function(){ alert("儲存成功");location.href="form.php" })
}

document.getElementById("id").value=row[0]
document.getElementById("title").value=row[1]

if(userkey=="true"){
    questionrow=Object.values(JSON.parse(questionrow))
    maincount=questionrow.length
    main()
    document.getElementById("count").value=count
}

document.addEventListener("keydown",function(event){
    if(event.key=="Escape"){
        location.href="api.php?cancel="
    }
    if(event.ctrlKey&&event.key=="s"){
        event.preventDefault()
        save()
    }
})