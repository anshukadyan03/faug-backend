<!DOCTYPE html>
<html>
<head>
<title>FAUG Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
    margin:0;
    background:#050505;
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.box{
    background:#0c0c0c;
    padding:30px;
    width:320px;
    border-radius:12px;
    box-shadow:0 0 20px #f5c400;
}
h2{
    color:#f5c400;
    text-align:center;
}
input{
    width:100%;
    padding:12px;
    margin-top:12px;
    background:#111;
    border:none;
    color:white;
    border-radius:6px;
}
button{
    width:100%;
    padding:12px;
    background:#f5c400;
    border:none;
    margin-top:15px;
    font-size:16px;
    cursor:pointer;
}
a{color:#f5c400;text-decoration:none;}
.msg{margin-top:10px;color:#0f0;text-align:center;}
</style>
</head>
<body>

<div class="box">
<h2>FAUG LOGIN</h2>

<form id="loginForm">
<input type="email" id="email" placeholder="Email" required>
<input type="password" id="password" placeholder="Password" required>
<button type="submit">LOGIN</button>
</form>

<p style="text-align:center;margin-top:10px;">
No account? <a href="register.php">Register</a>
</p>

<div class="msg" id="msg"></div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit",function(e){
e.preventDefault();

fetch("api_login.php",{
    method:"POST",
    headers:{"Content-Type":"application/x-www-form-urlencoded"},
    body:`email=${email.value}&password=${password.value}`
})
.then(res=>res.json())
.then(data=>{
    if(data.status=="success"){
        window.location="dashboard.php";
    }else{
        document.getElementById("msg").innerHTML=data.message;
    }
});
});
</script>

</body>
</html>
