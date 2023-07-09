let username=weblsget("name")
let difficulty=weblsget("difficulty")
let data=[]

docgetid("difficulty").innerHTML=difficulty // 拿到難易度並顯示
docgetid("name").innerHTML=username // 拿到名稱並顯示

let ajax=newajax("GET","map.txt")

ajax.onload=function(){
    tempdata=ajax.responseText.split("\r\n")
    for(let i=0;i<tempdata.length;i=i+1){
        data.push([])
        data[i].push(tempdata[i].split(","))
    }

    for(let i=0;i<data.length;i=i+1){
        for(let j=0;j<data[i].length;j=j+1){
            docgetid("app").innerHTML=docgetid("app").innerHTML+`
                ${data[i][j]}
            `
        }
        docgetid("app").innerHTML=docgetid("app").innerHTML+`
            <br>
        `
    }
}

startmacossection()