let nickname=weblsget("53grandmaster2stagemodulecnickname")
let stage=1
let score=0

// 初始化 START
docgetid("gamestage").innerHTML=`
    stage-${stage}
`

docgetid("gamenickname").innerHTML=`
    ${nickname}
`

docgetid("gamescore").innerHTML=`
    ${score}
`
// 初始化 END