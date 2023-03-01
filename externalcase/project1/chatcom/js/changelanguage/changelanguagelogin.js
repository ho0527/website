let languagelogin={
    zhtw:{
        login:"登入",
        email:"信箱",
        password:"密碼",
        rememberme:"記住此帳號密碼",
        forgetpassword:"忘記密碼",
        loginbutton:"登入",
        signuptext:"還沒有帳號?",
        signuplink:"註冊",
    },
    en:{
        login:"LogIn",
        email:"Email",
        password:"Password",
        rememberme:"Remember Me",
        forgetpassword:"Forget Password",
        loginbutton:"Login",
        signuptext:"Don\'t have an account?",
        signuplink:"signup",
    },
}


// 語言切換功能
function switchlanguage(language){
    // 更改文本內容
    document.getElementById("loginheader").innerHTML=language.login
    document.getElementById("email").innerHTML=language.email
    document.getElementById("password").innerHTML=language.password
    document.getElementById("rememberme").innerHTML=language.rememberme
    document.getElementById("forgetpassword").innerHTML=language.forgetpassword
    document.getElementById("loginbutton").value=language.loginbutton
    document.getElementById("signuptext").innerHTML=language.signuptext
    document.getElementById("signuplink").innerHTML=language.signuplink
}

// 切換到預設語言
switchlanguage(languagelogin[defaultlanguage]);