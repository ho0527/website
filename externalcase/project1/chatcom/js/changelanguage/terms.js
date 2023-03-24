let languagelogin={
    zhtw:{
        termstitle:"CHATCOM'S 服務條款",
        title1:"大綱",
        depiction1:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore quisquam debitis perferendis iusto labore?",
    },
    en:{
        termstitle:"CHATCOM'S TERMS OF SERVICE",
        title1:"main",
        depiction1:"Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore quisquam debitis perferendis iusto labore?",
    },
}


// 語言切換功能
function switchlanguage(language){
    // 更改文本內容
    document.getElementById("termstitle").innerHTML=language.termstitle
    document.getElementById("title1").innerHTML=language.title1
    document.getElementById("depiction1").innerHTML=language.depiction1
}

// 切換到預設語言
switchlanguage(languagelogin[defaultlanguage]);