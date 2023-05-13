console.log(row)
row=row[0]
let count=0
let id=row[0]

function newquestion(){
    questionrow.push({
        1:id,
        2:count,
        3:"",
        4:"false",
        5:"none",
        6:"",
        7:"false",
        8:"",
    })
    main()
    document.getElementById("count").value=count
}

function main(){
    count=0
    document.getElementById("maintable").innerHTML=``
    for(let i=0;i<parseInt(questionrow[2]);i=i+1){
        count=count+1
        let tr1=document.createElement("tr")
        tr1.classList.add("div"+i)
        tr1.id="tr1"+i
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
                let type=modkey[j];
                let checked="";
                if(type=="none"){
                    checked="checked";
                    check=1;
                }
                all=all+"<input type='radio' class='radio "+type+" select"+i+"' id='select"+i+"' data-id='"+type+" "+i+"' name='select"+i+"' value='"+type+"' "+checked+">"+mod[modkey[j]]
            }
        }else{
            for(let j=0;j<modkey.length;j=j+1){
                let type=modkey[j];
                let checked="";
                if(questionrow[i][5]==undefined){
                    if(type=="none"){
                        checked="checked";
                        check=1;
                    }
                }else{
                    if(type==questionrow[i][5]){
                        checked="checked";
                        check=1;
                    }
                }
                all=all+"<input type='radio' class='radio "+type+" select"+i+"' id='select"+i+"' data-id='"+type+" "+i+"' name='select"+i+"' value='"+type+"' "+checked+">"+mod[modkey[j]]
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
        if(questionrow==""||questionrow[i][5]==undefined||questionrow[i][5]=="none"){
            output="<div class='questiondiv' id='output"+i+"'></div>"
        }else{
            let option=questionrow[i][6].split("|&|")
            if(questionrow[i][4]=="true"){
                output=output+"必填<input type='checkbox' id='required"+i+"' checked><br>"
            }else{
                output=output+"必填<input type='checkbox' id='required"+i+"'><br>"
            }
            output=output+"題目說明:<input type='text' id='desciption"+i+"' class='directions' name='direction"+i+"' value='"+row[7][i][3]+"'><br>"
            if(questionrow[i][5]=="yesno"){
                output=output+"是<input type='radio' class='yesno' name='yesno' value='yes' disabled>否<input type='radio' name='yesno' value='no' disabled>"
            }else if(questionrow[i][5]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(option[j]!=undefined&&option[j]!=""){
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"single"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }else{
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"single"+(j+1)+"' class='forminputtext' value=''>")
                    }
                }
            }else if(questionrow[i][5]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(option[j]!=undefined&&option[j]!=""){
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"multi"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }else{
                        output=output+(j+1+".<input type='text' id='"+(i+"option"+j)+"' name='"+i+"multi"+(j+1)+"' class='forminputtext' value=''>")
                    }
                }
                if(questionrow[i][7]=="true"||questionrow[i][7]==undefined||questionrow[i][7]==""){
                    output=output+"<br>顯示其他選項<input type='checkbox' id='showauther"+i+"' checked>"
                }else{
                    output=output+"<br>顯示其他選項<input type='checkbox' id='showauther"+i+"'>"
                }
            }else if(questionrow[i][5]=="qa"){
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

function save(){
    let insertdata=[]
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
                for(let j=0;j<6;j=j+1){ option=option+document.getElementById(i+"option"+(j+1)).value+"|&|" }
            }else{ option="" }
            showmultimorerespond=true
            if(document.getElementById("showmultimorerespond")!=null&&document.getElementById("showmultimorerespond").checked==false){ showmultimorerespond=false }
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

main()

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
            output=document.getElementById("output"+data[1])
            if(data[0]=="yesno"){
                output.innerHTML=`
                    必填<input type="checkbox" id="required${data[1]}" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions" id="desciption${data[1]}" name="direction${data[1]}"><br>
                    是<input type="radio" name="yesno" value="yes" disabled>
                    否<input type="radio" name="yesno" value="no" disabled>
                `
            }else if(data[0]=="single"){
                output.innerHTML=`
                必填<input type="checkbox" id="required${data[1]}" name="required${data[1]}"><br>
                題目說明:<input type="text" class="directions" id="desciption${data[1]}" name="direction${data[1]}"><br>
                    1.<input type="text" id="${data[1]}option1" name="${data[1]}single1" name="single1" class="forminputtext">
                    2.<input type="text" id="${data[1]}option2" name="${data[1]}single2" name="single2" class="forminputtext">
                    3.<input type="text" id="${data[1]}option3" name="${data[1]}single3" name="single3" class="forminputtext">
                    4.<input type="text" id="${data[1]}option4" name="${data[1]}single4" name="single4" class="forminputtext">
                    5.<input type="text" id="${data[1]}option5" name="${data[1]}single5" name="single5" class="forminputtext">
                    6.<input type="text" id="${data[1]}option6" name="${data[1]}single6" name="single6" class="forminputtext">
                `
            }else if(data[0]=="multi"){
                output.innerHTML=`
                    必填<input type="checkbox" id="required${data[1]}" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions" id="desciption${data[1]}" name="direction${data[1]}"><br>
                    1.<input type="text" id="${data[1]}option1" name="${data[1]}multi1" class="forminputtext">
                    2.<input type="text" id="${data[1]}option2" name="${data[1]}multi2" class="forminputtext">
                    3.<input type="text" id="${data[1]}option3" name="${data[1]}multi3" class="forminputtext">
                    4.<input type="text" id="${data[1]}option4" name="${data[1]}multi4" class="forminputtext">
                    5.<input type="text" id="${data[1]}option5" name="${data[1]}multi5" class="forminputtext">
                    6.<input type="text" id="${data[1]}option6" name="${data[1]}multi6" class="forminputtext"><br>
                    顯示其他選項<input type="checkbox" name="showauther<?php echo($i) ?>" checked>
                `
            }else if(data[0]=="qa"){
                output.innerHTML=`
                    必填<input type="checkbox" id="required${data[1]}" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions" id="desciption${data[1]}" name="direction${data[1]}"><br>
                    <textarea cols="30" rows="5" placeholder="問答題" disabled></textarea>
                `
            }else{
                output.innerHTML=``
            }
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
            console.log("ihngjnekdi")
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
})