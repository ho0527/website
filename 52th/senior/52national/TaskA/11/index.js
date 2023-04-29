document.getElementById("submit").onclick=function(){
    let csvdata=[]
    let county1=[]
    let county2=[]
    let total=[]
    let countytotaltemp=[]
    let countytotal=[]
    let largestnumber
    let reader=new FileReader()
    reader.onload=function(event){
        const lines=event.target.result.split("\n")
        let ans=""
        for(let i=0;i<lines.length;i=i+1){
            let line=lines[i].split(",")
            csvdata.push(line)
            ans=ans+"<br>"+line
        }
        console.log(csvdata)
        for(let i=1;i<lines.length;i=i+1){
            console.log(csvdata[i])
            county1.push(csvdata[i][0])
            county2.push(csvdata[i][1])
            countytotaltemp.push([csvdata[i][0]])
            let totalsum=parseInt(csvdata[i][2])+parseInt(csvdata[i][3])
            total.push(totalsum)
            countytotaltemp[i-1].push(totalsum)
        }
        console.log("countytotaltemp="+countytotaltemp)
        for(let i=0;i<countytotaltemp.length;i=i+1){
            
        }
        county1=[...new Set(county1)]
        console.log("county1="+county1)
        for(let i=0;i<countytotaltemp.length;i=i+1){
            if(countytotaltemp[i][0]==county1){
            }
        }
        document.getElementById("log").innerHTML=ans
        console.log(total)
        console.log(county1)
        console.log(county2)
    }
    reader.readAsText(document.getElementById("inputfile").files[0])
    setTimeout(function(){
        let temptotal=total
        temptotal.sort(function(a,b){
            return b-a
        })
        largestnumber=temptotal[0]
        console.log(largestnumber)
        let x=Math.ceil(largestnumber/1000)*1000
        let ex=x/100
        for(i=0;i<county1.length;i=i+1){
            let tr=document.createElement("tr")
            tr.classList.add("tr")
            document.getElementById("table").appendChild(tr)
            let td=document.createElement("td")
            td.classList.add("td")
            td.classList.add("tdtitle")
            td.id=i
            td.innerHTML=`${county1[i]}`
            document.querySelectorAll(".tr")[i].appendChild(td)
            let td2=document.createElement("td")
            td2.classList.add("td")
            td2.classList.add("tdshow")
            td2.id=i+"2"
            td2.innerHTML=`
                <div class=""></div>
            `
            document.querySelectorAll(".tr")[i].appendChild(td2)
            let td3=document.createElement("td")
            td3.classList.add("td")
            td3.classList.add("tdnumber")
            td3.id=i+"3"
            td3.innerHTML=`${countytotal[i]}`
            document.querySelectorAll(".tr")[i].appendChild(td3)
        }
    },100)
}

document.getElementById("reflashbutton").onclick=function(){
    location.reload()
}