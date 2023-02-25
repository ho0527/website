let languagelogin={
    zhtw:{
        signup:"註冊",
        name:"姓名",
        email:"信箱",
        password:"密碼",
        signupbutton:"註冊",
        logintext:"已經有帳號?",
        loginlink:"登入",
    },
    en:{
        signup:"signup",
        name:"name",
        email:"Email",
        password:"Password",
        signupbutton:"signup",
        logintext:"have an account?",
        loginlink:"login",
    },
}


// 語言切換功能
function switchlanguage(language){
    // 更改文本內容
    document.getElementById("signupheader").innerHTML=language.signup
    document.getElementById("name").innerHTML=language.name
    document.getElementById("email").innerHTML=language.email
    document.getElementById("password").innerHTML=language.password
    document.getElementById("signupbutton").value=language.signupbutton
    document.getElementById("logintext").innerHTML=language.logintext
    document.getElementById("loginlink").innerHTML=language.loginlink
}

// 切換到預設語言
switchlanguage(languagelogin[defaultlanguage]);

// 語言切換按鈕事件
// document.getElementById("switchlanguagebutton").addEventListener("click",function(){
//     // 切換語言
//     if(defaultlanguage=="en"){
//         defaultlanguage="zn"
//     }else{
//         defaultlanguage="en"
//     }
//     switchlanguage(languagelogin[defaultlanguage])
// })