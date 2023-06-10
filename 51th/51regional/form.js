console.log(row)

function checknull(data){
    if(data==null||data==undefined||data==""){ return true }
    else{ return false }
}

function pregmatch(context,data){ return context.test(data) }

function newquestion(){
    questionrow.push([(count+1).toString(),"","false","none","",false,""])
    console.log(questionrow[count])
    maincount=maincount+1
    count=count+1
    document.getElementById("maindiv").innerHTML=document.getElementById("maindiv").innerHTML+`
    <div class="grid" id="${count}">
        <div class="order">
            <div class="questiondel" data-id="${count}">X</div>
            <div id="count${count}">${count}</div>
        </div>
        <div class="newform">
            <input type="radio" class="radio none select${count}" value="none" checked>未設定
            <input type="radio" class="radio yesno select${count}" value="yesno">是非題
            <input type="radio" class="radio single select${count}" value="single">單選題
            <input type="radio" class="radio multi select${count}" value="multi">多選題
            <input type="radio" class="radio qa select${count}" value="qa">問答題
        </div>
        <div class="output">
            <div class="questiondiv" id="output${count}"></div>
        </div>
    </div>
    `
    document.getElementById("count").value=count
    sort(".grid","grid","#maindiv")
}

function tempsave(){
    questionrow=[]
    for(let i=0;i<count;i=i+1){
        let mod
        document.querySelectorAll(".select"+i).forEach(function(event){
            if(event.checked==true){ mod=event.value }
        })
        let desciption=""
        let required=false
        let option=""
        let showmultimorerespond=false
        if(mod!="none"){
            desciption=document.querySelectorAll(".desciption")[i].value
            required=document.querySelectorAll(".required")[i].checked
            option=""
            if(mod=="single"||mod=="multi"){
                document.querySelectorAll(".option"+i).forEach(function(event){
                    if(!checknull(event.value)){
                        if(event.value!="|&|"){ option=option+event.value+"|&|" }
                        else{ alert("選項禁止輸入|&| 位於第"+i+"欄，故選項不儲存") }
                    }
                })
            }
            showmultimorerespond=false
            if(document.querySelectorAll(".showmultimorerespond")[0].checked==true){ showmultimorerespond=true }
        }
        questionrow.push([i+1,desciption,required,mod,option,showmultimorerespond,""])
    }
    console.log(questionrow)
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
    tempsave()
    insertdata.push(questionrow)
    fetch("newform.php",{
        method:"POST",
        body:JSON.stringify(insertdata),
        headers:{ "Content-Type":"application/json" },
    }).then(function(response){ return response.text() })
    .catch(function(event){ console.error("Error:",event) })
    .then(function(){ alert("儲存成功");location.reload() })
}

function main(){
    count=0
    document.getElementById("maindiv").innerHTML=``
    for(let i=0;i<maincount;i=i+1){
        console.log(questionrow[i])
        count=count+1
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
        let output=""
        if(questionrow==""||questionrow[i][3]==undefined||questionrow[i][3]=="none"){
            output="<input type='hidden' class='desciption required showmultimorerespond option"+i+"'>"
        }else{
            let option=questionrow[i][4].split("|&|")
            if(questionrow[i][2]==true){
                output=output+"必填<input type='checkbox' class='required' checked><br>"
            }else{
                output=output+"必填<input type='checkbox' class='required'><br>"
            }
            output=output+"題目說明:<input type='text' class='desciption' value='"+questionrow[i][1]+"'><br>"
            if(questionrow[i][3]=="yesno"){
                output=output+"是<input type='radio' class='yesno' name='yesno' value='yes' disabled>否<input type='radio' name='yesno' value='no' disabled><br><input type='hidden' class='showmultimorerespond option"+i+"'>"
            }else if(questionrow[i][3]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' class='option"+i+"' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' class='option"+i+"' value='"+option[j]+"'>")
                    }
                }
                output=output+"<br><input type='hidden' class='showmultimorerespond'>"
            }else if(questionrow[i][3]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' class='option"+i+"' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' class='option"+i+"' value='"+option[j]+"'>")
                    }
                }
                if(questionrow[i][5]==true||questionrow[i][5]==undefined){
                    output=output+"<br>顯示其他選項<input type='checkbox' class='showmultimorerespond' checked>"
                }else{
                    output=output+"<br>顯示其他選項<input type='checkbox' class='showmultimorerespond'>"
                }
            }else if(questionrow[i][3]=="qa"){
                output=output+"<textarea cols='30' rows='2' placeholder='問答題' disabled></textarea><br><input type='hidden' class='showmultimorerespond option"+i+"'>"
            }else{ sql001();location.href="admin.php" }
        }
        document.getElementById("maindiv").innerHTML=document.getElementById("maindiv").innerHTML+`
            <div class="grid" id="${i}">
                <div class="order">
                    <div class="questiondel" data-id="${i}">X</div>
                    <div id="count${i}">${i+1}</div>
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

editformnavigationbar(document.getElementById("htmlform"))
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
sort(".grid","grid","#maindiv")

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
                output=output+"必填<input type='checkbox' class='required' id='required"+data[1]+"' checked><br>"
            }else{
                output=output+"必填<input type='checkbox' class='required' id='required"+data[1]+"'><br>"
            }
            output=output+"題目說明:<input type='text' class='desciption' id='desciption"+data[1]+"' name='direction"+data[1]+"' value='"+questionrow[data[1]][1]+"'><br>"
            if(data[0]=="none"){
                output="<input type='hidden' class='desciption required showmultimorerespond option"+data[1]+"'>"
            }else if(data[0]=="yesno"){
                    output=output+"是<input type='radio' class='yesno' name='yesno' value='yes' disabled>否<input type='radio' name='yesno' value='no' disabled><br><input type='hidden' class='showmultimorerespond option"+data[1]+"'>"
            }else if(data[0]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' class='option"+data[1]+"' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' class='option"+data[1]+"' value='"+option[j]+"'>")
                    }
                }
                output=output+"<br><input type='hidden' class='showmultimorerespond'>"
            }else if(data[0]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(checknull(option[j])){
                        output=output+(j+1+".<input type='text' class='option"+data[1]+"' value=''>")
                    }else{
                        output=output+(j+1+".<input type='text' class='option"+data[1]+"' value='"+option[j]+"'>")
                    }
                }
                if(questionrow[data[1]][5]==true||questionrow[data[1]][5]==undefined){
                    output=output+"<br>顯示其他選項<input type='checkbox' class='showmultimorerespond' checked>"
                }else{
                    output=output+"<br>顯示其他選項<input type='checkbox' class='showmultimorerespond'>"
                }
            }else if(data[0]=="qa"){
                output=output+"<textarea cols='30' rows='2' placeholder='問答題' disabled></textarea><br><input type='hidden' class='showmultimorerespond option"+data[1]+"'>"
            }else{ sql001();location.href="admin.php" }
            document.getElementById("output"+data[1]).innerHTML=`
                ${output}
            `
        }
    })
})

document.querySelectorAll(".questiondel").forEach(function(event){
    event.onclick=function(){
        let id=parseInt(event.dataset.id("data-id"))
        document.getElementById(id).remove()
        for(let i=id;i<count-1;i=i+1){
            document.getElementById(i+1).id=i
            document.getElementById("count"+(i+1)).innerHTML=`${i+1}`
            document.getElementById("count"+(i+1)).id="count"+i
            document.getElementById("output"+(i+1)).id="output"+i
            document.querySelectorAll(".select"+i).forEach(function(event){
                event.classList.remove("select"+i)
                event.classList.add("select"+(i-1))
            })
            document.querySelectorAll(".option"+i).forEach(function(event){
                event.classList.remove("option"+i)
                event.classList.add("option"+(i-1))
            })
        }
        count=count-1
        tempsave()
    }
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