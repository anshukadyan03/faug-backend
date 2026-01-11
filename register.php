<!DOCTYPE html>
<html>
<head>
<title>FAUG Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body{
margin:0;background:#050505;font-family:Arial;
display:flex;justify-content:center;align-items:center;
height:100vh;color:white;
}
.box{
background:#0c0c0c;padding:25px;width:340px;
border-radius:12px;box-shadow:0 0 20px #00ffcc;
}
h2{color:#00ffcc;text-align:center;}
input,select{
width:100%;padding:12px;margin-top:10px;
background:#111;border:none;color:white;border-radius:6px;
}
button{
width:100%;padding:12px;background:#00ffcc;
border:none;margin-top:15px;font-size:16px;cursor:pointer;
}
.msg{text-align:center;margin-top:10px;font-size:14px;}
.flag-box{display:flex;align-items:center;gap:10px;margin-top:10px;}
.flag-box img{width:32px;height:22px;border:1px solid #333;}
.avatar-preview{text-align:center;margin-top:10px;}
.avatar-preview img{
width:80px;height:80px;border-radius:50%;
border:2px solid #00ffcc;object-fit:cover;
}
</style>
</head>

<body>

<div class="box">
<h2>FAUG REGISTER</h2>

<form id="regForm" enctype="multipart/form-data">

<input type="text" id="username" name="username" placeholder="Username" required>
<input type="email" id="email" name="email" placeholder="Email" required>

<input type="password" id="password" name="password" placeholder="Password" required>
<input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>

<select id="gender" name="gender" required>
<option value="">Select Gender</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>

<div class="flag-box">
<select id="country" name="country" required>
<option value="">Select Country</option>
<option value="IN" data-flag="https://flagcdn.com/w40/in.png">India</option>
<option value="US" data-flag="https://flagcdn.com/w40/us.png">USA</option>
<option value="GB" data-flag="https://flagcdn.com/w40/gb.png">UK</option>
<option value="AE" data-flag="https://flagcdn.com/w40/ae.png">UAE</option>
</select>
<img id="flag">
</div>

<input type="file" id="avatar" name="avatar" accept="image/*" required>

<div class="avatar-preview">
<img id="preview">
</div>

<button type="submit">REGISTER</button>
</form>

<div class="msg" id="msg"></div>
</div>

<script>
const country = document.getElementById("country");
const flag = document.getElementById("flag");
const avatar = document.getElementById("avatar");
const preview = document.getElementById("preview");
const msg = document.getElementById("msg");

country.addEventListener("change",()=>{
 let opt = country.options[country.selectedIndex];
 flag.src = opt.getAttribute("data-flag");
});

avatar.addEventListener("change",()=>{
 preview.src = URL.createObjectURL(avatar.files[0]);
});

document.getElementById("regForm").addEventListener("submit",function(e){
 e.preventDefault();

 if(password.value !== cpassword.value){
   msg.innerHTML="❌ Password not matched";
   msg.style.color="red";
   return;
 }

 msg.innerHTML = "Registering...";
 msg.style.color = "#00ffcc";

 let form = new FormData(this);

fetch("api_register_clean.php", {
   method: "POST",
   body: form
})

 .then(r=>r.json())
 .then(d=>{
    msg.innerHTML = d.message;
    msg.style.color = d.status=="success" ? "#0f0" : "red";

    if(d.status=="success"){
        setTimeout(()=>{
            window.location = "verify.php";   // ✅ email verify page
        },800);
    }
 });
});
</script>

</body>
</html>

