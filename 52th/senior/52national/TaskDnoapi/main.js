document.getElementById("newpost").onclick=function(){ location.href="newpost.php" }

document.querySelectorAll(".save").forEach(function(event){ event.onclick=function(){ location.href="api.php?key=postsave&id="+this.dataset.id } })

document.querySelectorAll(".comment").forEach(function(event){ event.onclick=function(){ location.href="api.php?key=postsave&id="+this.dataset.id } })