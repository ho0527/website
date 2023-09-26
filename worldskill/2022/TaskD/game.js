newajax("GET","https://hiiamchris.ddns.net:444/website/worldskill/2022/module_c_solution/public/api/v1/games/"+location.href.split("?game=")[1]).onload=function(){
    let data=JSON.parse(this.responseText)
    docgetid("navigationbartitle2").innerHTML=`
        (Game: ${data["title"]})
    `
    console.log(data)
}