function end(){
    docgeid("game").style.display="none"
    docgetid("end").style.display="block"

    if(result){
    }else{}

    docgetid("restart").onclick=function(){
        weblsset("53grandmaster2stagemodulecnickname",null)
        location.reload()
    }
}