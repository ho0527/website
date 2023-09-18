let admin=true

let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=JSON.parse(ajax.responseText)
    if(!(data["success"]=="true"&&data["permission"]=="admin")){
        location.href="login.html"
    }
}

// docgetid("download").onclick=function(){
//     newajax("GET","api.php?download=true").onload=function(){
//         let data=JSON.parse(ajax.responseText)
//         if(data["success"]=="true"){
//             let a=doccreate("a")
//             a.href="api.php?download=true"
//         }
//     }
// }

startmacossection()