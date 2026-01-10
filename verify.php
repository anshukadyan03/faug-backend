<!DOCTYPE html>
<html>
<head>
<title>Email Verification</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
background:#050505;color:white;
display:flex;justify-content:center;align-items:center;height:100vh;
font-family:Arial;
}
.box{
background:#0c0c0c;padding:30px;width:300px;border-radius:12px;
box-shadow:0 0 20px #00ffcc;text-align:center;
}
input{width:100%;padding:12px;margin-top:12px;background:#111;border:none;color:white;border-radius:6px;}
button{width:100%;padding:12px;background:#00ffcc;border:none;margin-top:15px;font-size:16px;cursor:pointer;}
.msg{margin-top:10px}
</style>
</head>
<body>

<div class="box">
<h2>Verify Email</h2>
<p>Enter 6 digit code sent to your email</p>

<form id="verifyForm">
<input type="number" id="code" placeholder="Enter code" required>
<button>VERIFY</button>
</form>

<div class="msg" id="msg"></div>
</div>

<script>
const form = document.getElementById("verifyForm");
const msg = document.getElementById("msg");
const codeInput = document.getElementById("code");

form.addEventListener("submit", function(e){
    e.preventDefault();

    fetch("verify_action.php", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: "code=" + encodeURIComponent(codeInput.value)
    })
    .then(res => res.json())
    .then(d => {
        msg.innerHTML = d.message;

        if(d.status === "success"){
            msg.style.color = "#00ffcc";
            setTimeout(() => {
                window.location = "login.php";
            }, 1200);
        } else {
            msg.style.color = "red";
        }
    });
});
</script>


</body>
</html>
