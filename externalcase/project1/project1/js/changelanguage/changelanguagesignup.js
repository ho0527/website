let languagesignup={
    zhtw:{//繁體中文
        signup:"註冊",
        name:"姓名",
        email:"信箱",
        password:"密碼",
        check:"我已同意",
        checklink:"此條款",
        signupbutton:"註冊",
        logintext:"已經有帳號?",
        loginlink:"登入",
        formal:"格式",
    },
    en:{//美式英文
        signup:"signup",
        name:"name",
        email:"Email",
        password:"Password",
        check:"I agree with",
        checklink:"this statment",
        signupbutton:"signup",
        logintext:"have an account?",
        loginlink:"login",
        formal:"formal",
    },
}


// 語言切換功能
function switchlanguage(language){
    // 更改文本內容
    document.getElementById("signupheader").innerHTML=language.signup
    document.getElementById("name").innerHTML=language.name
    document.getElementById("email").innerHTML=language.email
    document.getElementById("password").innerHTML=language.password
    document.getElementById("check").innerHTML=language.check
    document.getElementById("checklink").innerHTML=language.checklink
    document.getElementById("signupbutton").value=language.signupbutton
    document.getElementById("logintext").innerHTML=language.logintext
    document.getElementById("loginlink").innerHTML=language.loginlink
    document.getElementById("signupformal").innerHTML=language.formal
}

switchlanguage(languagesignup[defaultlanguage]);