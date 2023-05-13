console.log(row)
let count=0
let id=row[0][1]

function newquestion(){
    row.push({
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
    for(let i=0;i<row.length;i=i+1){
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
        for(let j=0;j<modkey.length;j=j+1){
            let type=modkey[j];
            let checked="";
            if(row[i][5]!=undefined){
                if(type==row[i][5]){
                    checked="checked";
                    check=1;
                }
            }else{
                if(type=="none"){
                    checked="checked";
                    check=1;
                }
            }
            all=all+"<input type='radio' class='radio "+type+"' id='"+type+" "+i+"' name='select"+i+"' value='"+type+"' "+checked+">"+mod[modkey[j]]
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
        let option=row[i][6].split("|&|")
        let output=""
        if(row[i][5]==undefined||row[i][5]=="none"){
            output="<div class='questiondiv' id='output"+i+"'></div>"
        }else{
            if(row[i][4]=="true"){
                output=output+"必填<input type='checkbox' name='required"+i+"' checked><br>"
            }else{
                output=output+"必填<input type='checkbox' name='required"+i+"'><br>"
            }
            output=output+"題目說明:<input type='text' class='directions' name='direction"+i+"' value='"+row[i][3]+"'><br>"
            if(row[i][5]=="yesno"){
                output=output+"是<input type='radio' class='yesno' name='yesno' value='yes' disabled>否<input type='radio' name='yesno' value='no' disabled>"
            }else if(row[i][5]=="single"){
                for(let j=0;j<6;j=j+1){
                    if(option[j]!=undefined&&option[j]!=""){
                        output=output+(j+1+".<input type='text' name='"+i+"single"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }else{
                        output=output+(j+1+".<input type='text' name='"+i+"single"+(j+1)+"' class='forminputtext' value=''>")
                    }
                }
            }else if(row[i][5]=="multi"){
                for(let j=0;j<6;j=j+1){
                    if(option[j]!=undefined&&option[j]!=""){
                        output=output+(j+1+".<input type='text' name='"+i+"multi"+(j+1)+"' class='forminputtext' value='"+option[j]+"'>")
                    }else{
                        output=output+(j+1+".<input type='text' name='"+i+"single"+(j+1)+"' class='forminputtext' value=''>")
                    }
                }
                if(row[i][7]=="true"||row[i][7]==undefined||row[i][7]==""){
                    output=output+"<br>顯示其他選項<input type='checkbox' name='showauther"+i+"' checked>"
                }else{
                    output=output+"<br>顯示其他選項<input type='checkbox' name='showauther"+i+"'>"
                }
            }else if(row[i][5]=="qa"){
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

main()

let none=document.querySelectorAll(".none")
let yesno=document.querySelectorAll(".yesno")
let single=document.querySelectorAll(".single")
let multi=document.querySelectorAll(".multi")
let qa=document.querySelectorAll(".qa")
let all=[none,yesno,single,multi,qa]

all.forEach(function(event){
    event.forEach(function(event){
        event.onclick=function onchange(){
            let id=this.id
            let data=id.split(" ")
            output=document.getElementById("output"+data[1])
            if(data[0]=="yesno"){
                output.innerHTML=`
                    必填<input type="checkbox" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions" name="direction${data[1]}"><br>
                    是<input type="radio" name="yesno" value="yes" disabled>
                    否<input type="radio" name="yesno" value="no" disabled>
                `
            }else if(data[0]=="single"){
                output.innerHTML=`
                    必填<input type="checkbox" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions"><br>
                    1.<input type="text" name="single1" class="forminputtext">
                    2.<input type="text" name="single2" class="forminputtext">
                    3.<input type="text" name="single3" class="forminputtext">
                    4.<input type="text" name="single4" class="forminputtext">
                    5.<input type="text" name="single5" class="forminputtext">
                    6.<input type="text" name="single6" class="forminputtext">
                `
            }else if(data[0]=="multi"){
                output.innerHTML=`
                    必填<input type="checkbox" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions"><br>
                    1.<input type="text" name="multi1" class="forminputtext">
                    2.<input type="text" name="multi2" class="forminputtext">
                    3.<input type="text" name="multi3" class="forminputtext">
                    4.<input type="text" name="multi4" class="forminputtext">
                    5.<input type="text" name="multi5" class="forminputtext">
                    6.<input type="text" name="multi6" class="forminputtext"><br>
                    顯示其他選項<input type="checkbox" name="showauther<?php echo($i) ?>" checked>
                `
            }else if(data[0]=="qa"){
                output.innerHTML=`
                    必填<input type="checkbox" name="required${data[1]}"><br>
                    題目說明:<input type="text" class="directions"><br>
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