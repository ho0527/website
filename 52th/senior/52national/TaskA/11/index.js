document.getElementById("submit").onclick=function(){
    let csvdata=[]
    let county=[]
    let boy=[]
    let girl=[]
    let largestnumber
    let reader=new FileReader()
    reader.onload=function(event){
        const lines=event.target.result.split("\n")
        let ans=""
        for (let i=0;i<lines.length;i=i+1){
            csvdata.push(lines[i].split(","))
            ans=ans+"<br>"+lines[i].split(",")
        }
        console.log(csvdata)
        for(i=1;i<lines.length;i=i+1){
            console.log(csvdata[i])
            county.push(csvdata[i][0]+csvdata[i][1])
            boy.push(csvdata[i][2])
            girl.push(csvdata[i][3])
        }
        document.getElementById("log").innerHTML=ans
        console.log(county)
    }
    reader.readAsText(document.getElementById("inputfile").files[0])
    setTimeout(function(){
        let tempboy=boy
        let tempgirl=girl
        tempboy.sort(function(a,b){
            return b-a
        })
        tempgirl.sort(function(a,b){
            return b-a
        })
        if(tempboy[0]>tempgirl[0]) largestnumber=tempboy[0]
        else largestnumber=tempgirl[0]
        console.log(largestnumber)
        let x=Math.ceil(largestnumber/1000)*1000
        let ex=x/100
        // county[0][0]
        // county[0][1]
        // county[0][2]
        // county[0][3]h
        for(i=1;i<county.lengt;i=i+1){
        }
    },1000)
}

document.getElementById("reflashbutton").onclick=function(){
    location.reload()
}