// let ajax=newajax("GET","/api/logincheck")

// ajax.onload=function(){
//     let data=ajax.response
//     console.log("data="+data)
//     // if(data){
//     //     location.href="admin.html"
//     // }
// }
let ajax=newajax("GET","api.php?logincheck=")

ajax.onload=function(){
    let data=ajax.response
    if(data=="true"){
        location.href="admintype.html"
    }
}