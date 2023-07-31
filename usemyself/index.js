let dataarray=[
    ["","49regional","html css js php sql comp","../49th/senior/49regional/"],
    ["","50regional","html css js php sql comp","../50th/senior/50regional/"],
    ["","51regional","html css js php sql comp","../51th/senior/51regional/"],
    ["","52regional","html css js php sql comp","../52th/senior/52regional/52pdo/"],
    ["","53regional","html css js php sql comp","../53th/senior/53regional/"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","divsort","html css js plugin","../template/sort/"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","OOXX","html css js game","../anther/OOXX/"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","","","../"],
    ["","txt small to big","html css js tool","../anther/tool/txtsmalltobig/"],
    ["","clock","html css js tool","../anther/tool/clock/"],
    ["","speedtest精選","html css js php sql tool","../anther/tool/speedtest/"]
]

// img,title,tag,link

for(let i=0;i<dataarray.length;i=i+1){
    if(dataarray[i][1]!=""){
        let tag=dataarray[i][2].split(" ")
        let tagdiv=""
        for(let j=0;j<tag.length;j=j+1){
            tagdiv=tagdiv+"<div class=\"tag tag"+tag[j]+"\">"+tag[j]+"</div>"
        }
        let div=doccreate("div")
        div.classList.add("card")
        div.onclick=function(){
            location.href=dataarray[i][3]
        }
        div.innerHTML=`
            <img src="${dataarray[i][0]}" class="image">
            <div class="title">${dataarray[i][1]}</div>
            <div class="tagdiv">${tagdiv}</div>
        `
        docappendchild("right",div)
    }
}

startmacossection()