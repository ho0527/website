let key=location.href.split("?key=")[1]

if(key=="signin"){
    docgetid("navigationbartitle2").innerHTML=`(Sign In)`
}else if(key=="signup"){
    docgetid("navigationbartitle2").innerHTML=`(Sign Up)`
}else{ alert("key error");location.href="index.html" }

docgetid(key).classList.add("navigationbarselect")
docgetid("submit").value=`${key}`

