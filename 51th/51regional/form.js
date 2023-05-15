console.log(row)

function checknull(data){
    if(data==null||data==undefined||data==""){ return true }
    else{ return false }
}

function pregmatch(context,data){ return context.test(data) }

function newquestion(){
    questionrow.push([(count+1).toString(),"","false","none","",false,""])
    console.log(questionrow[count])
    let tr1=document.createElement("tr")
    tr1.classList.add("div"+count)
    tr1.id="tr1"+count
    tr1.draggable=true
    document.getElementById("maintable").appendChild(tr1)
    let td1=document.createElement("td")
    td1.rowSpan=2
    td1.classList.add("order")
    td1.innerHTML=`
        <div class="questiondel" id="${count}">X</div>
        <div id="count${count}">${count+1}</div>
    `
    let td2=document.createElement("td")
    td2.classList.add("newform")
    td2.innerHTML=`
        <input type="radio" class="radio none select${count}" data-id="none ${count}" name="select${count}" value="none" checked>未設定
        <input type="radio" class="radio yesno select${count}" data-id="yesno ${count}" name="select${count}" value="yesno">是非題
        <input type="radio" class="radio single select${count}" data-id="single ${count}" name="select${count}" value="single">單選題
        <input type="radio" class="radio multi select${count}" data-id="multi ${count}" name="select${count}" value="multi">多選題
        <input type="radio" class="radio qa select${count}" data-id="qa ${count}" name="select${count}" value="qa">問答題
    `
    document.getElementById("tr1"+count).appendChild(td1)
    document.getElementById("tr1"+count).appendChild(td2)
    let tr2=document.createElement("tr")
    tr2.classList.add("div"+count)
    tr2.id="tr2"+count
    document.getElementById("maintable").appendChild(tr2)
    let td3=document.createElement("td")
    td3.classList.add("output")
    td3.innerHTML=`
        <div class="questiondiv" id="output${count}"></div>
    `
    document.getElementById("tr2"+count).appendChild(td3)
    maincount=maincount+1
    count=count+1
    document.getElementById("count").value=count
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

function main(){
    count=0
    document.getElementById("maintable").innerHTML=``
    for(let i=0;i<maincount;i=i+1){
        console.log(questionrow[i])
        count=count+1
        let tr1=document.createElement("tr")
        tr1.classList.add("div"+i)
        tr1.id="tr1"+i
        tr1.draggable=true
        document.getElementById("maintable").appendChild(tr1)
        let td1=document.createElement("td")
        td1.rowSpan=2
        td1.classList.add("order")
        td1.innerHTML=`
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
        if(questionrow==""){
            for(let j=0;j<modkey.length;j=j+1){
                let type=modkey[j]
                let checked=""
                if(type=="none"){
                    checked="checked"
                    check=1
                }
                all=all+"<input type='radio' class='radio "+type+" select"+i+"' data-id='"+type+" "+i+"' name='select"+i+"' value='"+type+"' "+checked+">"+mod[modkey[j]]
            }
        }else{
            for(let j=0;j<modkey.length;j=j+1){
                let type=modkey[j];
                let checked="";
                if(questionrow[i][3]==undefined){
                    if(type=="none"){
                        checked="checked"
                        check=1
                    }
                }else{
                    if(type==questionrow[i][3]){
                        checked="checked"
                        check=1
                    }
                }
                all=all+"<input type='radio' class='radio "+type+" select"+i+"' data-id='"+type+" "+i+"' name='select"+i+"' value='"+type+"' "+checked+">"+mod[modkey[j]]
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
        if(questionrow==""||questionrow[i][3]==undefined||questionrow[i][3]=="none"){
            output=""
        }else{
            let option=questionrow[i][4].split("|&|")
            if(questionrow[i][2]==true){
                output=output+"必填<input type='checkbox' id='required"+i+"' checked><br>"
            }else{
                output=output+"必填<input type='checkbox' id='required"+i+"'><br>"
            }
            output=output+"題目說明:<input type='text' id='desciption"+i+"' class='directions' name='direction"+i+"' value='"+questionrow[i][1]+"'><br>"
            if(questionrow[i][3]=="yesno"){
                output=output+"是<input type='radio' class='yesno' name='yesno' value='yes' disabled>否<input type='radio' name='yesno' value='no' disabled>"
            }else if(questionrow[i][3]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"single"+(j+1)+"' class='forminputtext' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"single"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }
                }
            }else if(questionrow[i][3]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"multi"+(j+1)+"' class='forminputtext' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"multi"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }
                }
                if(questionrow[i][5]==true||questionrow[i][5]==undefined){
                    output=output+"<br>顯示其他選項<input type='checkbox' id='showmultimorerespond"+i+"' checked>"
                }else{
                    output=output+"<br>顯示其他選項<input type='checkbox' id='showmultimorerespond"+i+"'>"
                }
            }else if(questionrow[i][3]=="qa"){
                output=output+"<textarea cols='30' rows='5' placeholder='問答題' disabled></textarea>"
            }else{ sql001();location.href="admin.php" }
        }
        td3.innerHTML=`
            <div class="questiondiv" id="output${i}">
                ${output}
            </div>
        `
        document.getElementById("tr2"+i).appendChild(td3)
    }
}

editform(document.getElementById("htmlform"))
let count=0
let id=row[0]
let maincount

if(!checknull(questionrow)){
    questionrow=Object.values(JSON.parse(questionrow))
    maincount=questionrow.length
}else{
    maincount=parseInt(row[2])
}
let oldmaxcount=document.getElementById("maxcount").value
let oldpagelen=document.getElementById("pagelen").value

main()

document.getElementById("id").value=row[0]
document.getElementById("title").value=row[1]
document.getElementById("count").value=count
document.getElementById("pagelen").value=row[3]
document.getElementById("maxcount").value=row[6]

let none=document.querySelectorAll(".none")
let yesno=document.querySelectorAll(".yesno")
let single=document.querySelectorAll(".single")
let multi=document.querySelectorAll(".multi")
let qa=document.querySelectorAll(".qa")
let all=[none,yesno,single,multi,qa]

all.forEach(function(event){
    event.forEach(function(event){
        event.onclick=function(){
            let id=this.getAttribute("data-id")
            let data=id.split(" ")
            let option=questionrow[data[1]][4].split("|&|")
            let output=""
            if(questionrow[data[1]][2]==true){
                output=output+"必填<input type='checkbox' id='required"+data[1]+"' checked><br>"
            }else{
                output=output+"必填<input type='checkbox' id='required"+data[1]+"'><br>"
            }
            output=output+"題目說明:<input type='text' id='desciption"+data[1]+"' class='directions' name='direction"+data[1]+"' value='"+questionrow[data[1]][1]+"'><br>"
            if(data[0]==""){
                output=""
            }else if(data[0]=="yesno"){
                    output=output+"是<input type='radio' class='yesno' name='yesno' value='yes' disabled>否<input type='radio' name='yesno' value='no' disabled>"
            }else if(data[0]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' id='"+(data[1]+"option"+j)+"' name='"+data[1]+"single"+(j+1)+"' class='forminputtext' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' id='"+(data[1]+"option"+j)+"' name='"+data[1]+"single"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }
                }
            }else if(data[0]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' id='"+(data[1]+"option"+j)+"' name='"+data[1]+"multi"+(j+1)+"' class='forminputtext' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' id='"+(data[1]+"option"+j)+"' name='"+data[1]+"multi"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }
                }
                if(questionrow[data[1]][5]==true||questionrow[data[1]][5]==undefined){
                    output=output+"<br>顯示其他選項<input type='checkbox' id='showmultimorerespond"+data[1]+"' checked>"
                }else{
                    output=output+"<br>顯示其他選項<input type='checkbox' id='showmultimorerespond"+data[1]+"'>"
                }
            }else if(data[0]=="qa"){
                output=output+"<textarea cols='30' rows='5' placeholder='問答題' disabled></textarea>"
            }else{ sql001();location.href="admin.php" }
            document.getElementById("output"+data[1]).innerHTML=`
                ${output}
            `
        }
    })
})
document.querySelectorAll(".questiondel").forEach(function(event){
    event.onclick=function(){
        let id=parseInt(this.id)
        document.querySelectorAll(".div"+id).forEach(function(event2){
            event2.innerHTML=``
            event2.classList.remove("div"+id)
        })
        for(let i=id;i<count-1;i=i+1){
            document.getElementById("count"+(i+1)).innerHTML=`${i+1}`
            document.querySelectorAll(".div"+(i+1)).forEach(function(event2){
                event2.classList.remove("div"+(i+1))
                event2.classList.add("div"+i)
            })
            document.getElementById("count"+(i+1)).id="count"+i
        }
    }
})

document.querySelectorAll(".order").forEach(function(event){
    let mousecheck=false
    event.addEventListener("mousedown",function(){
        mousecheck=true
    })
    event.addEventListener("mousemove",function(){
        if(mousecheck==true){
        }
    })
    event.addEventListener("mouseup",function(){
        mousecheck=false
    })
})

document.addEventListener("keydown",function(event){
    if(event.key=="Escape"){
        location.href="api.php?cancel="
    }
    if(event.ctrlKey&&event.key=="s"){
        event.preventDefault()
        save()
    }
})
// alert("禁止連續輸入|&| 位於第"+<?php echo($order) ?>+"欄，故選項不儲存")