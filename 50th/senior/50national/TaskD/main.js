let username=weblsget("name")
let difficulty=weblsget("difficulty")
let mainarray=[]
let score=0
let topstarcount=0
let starcount

if(difficulty=="easy"){
    starcount=10
}else if(difficulty=="normal"){
    starcount=8
}else{
    starcount=6
}

/*
mainarray 內容:
0=牆
1=道路
2=豆子
3=星星
4=門
*/

docgetid("difficulty").innerHTML=difficulty // 拿到難易度並顯示
docgetid("name").innerHTML=username // 拿到名稱並顯示

let ajax=newajax("GET","map.txt") // start ajsx

ajax.onload=function(){
    let data=ajax.responseText.split("\r\n") // 分隔及讀取檔案
    let tempstartcount=starcount
    let maininnerhtml=`
        <div class="center">
            <div class="position">
    `

    // 產出檔案
    for(let i=0;i<data.length;i=i+1){
        let row=data[i].split(",")
        mainarray.push([])
        maininnerhtml=`
            ${maininnerhtml}
            <div class="row">
        `
        for(let j=0;j<row.length;j=j+1){
            if(row[j]==0){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="wall"></div>
                `
                mainarray[i].push(0)
            }else if(row[j]==1){
                let roadinnerhtml
                console.log("((i+1)/2)="+((i+1)/2))
                console.log("((i+1)/2)<=15="+((i+1)/2)<=15)
                if((((i+1)/2)<=7.5&&Math.random()>=0.95&&tempstartcount>0&&topstarcount<(starcount/2))||(((i+1)/2)>=7.5&&Math.random()>=0.95&&tempstartcount>0)){
                    roadinnerhtml=`
                        <div class="star center">&#9733;</div>
                    `
                    mainarray[i].push(3)
                    tempstartcount=tempstartcount-1
                    if((i+1/2)<=15){
                        topstarcount=topstarcount+1
                    }
                }else{
                    roadinnerhtml=`
                        <div class="dot center"></div>
                    `
                    mainarray[i].push(2)
                }
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="road">
                        ${roadinnerhtml}
                    </div>
                `
            }else if(row[j]==2){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="ghostrespawn"></div>
                `
                mainarray[i].push(1)
            }else if(row[j]==3){
                maininnerhtml=`
                    ${maininnerhtml}
                    <div class="door"></div>
                `
                mainarray[i].push(4)
            }else{ console.log("error") }
        }
        maininnerhtml=`
                ${maininnerhtml}
            </div>
        `
    }

    docgetid("app").innerHTML=`
                ${maininnerhtml}
            </div>
        </div>
    `

    console.log(mainarray)
}

startmacossection()