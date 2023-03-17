let table=document.querySelectorAll(".ctable")
let val




function check(href){
    if(val==undefined) location.href=href+"?val=no"
    else location.href=href+"?val="+val
}