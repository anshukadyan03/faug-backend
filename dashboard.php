<?php 
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
include "config.php";

$uid = $_SESSION['user_id'];
$res = mysqli_query($conn,"SELECT * FROM users WHERE id='$uid'");
$user = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
<title>FAUG Global Dashboard</title>
<link rel="icon" type="image/png" href="assets/favicon.png">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap" rel="stylesheet">

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Orbitron',sans-serif;}
body{background:#050505;color:white;overflow-x:hidden;}

/* SIDEBAR */
.sidebar{
position:fixed;left:0;top:0;width:240px;height:100vh;
background:#070707;border-right:2px solid #f5c400;padding-top:25px;
transition:0.3s;
z-index:1000;
}
.sidebar.hide{left:-260px;}

.logo{color:#f5c400;font-size:24px;text-align:center;margin-bottom:25px;}

.sidebar a{
display:block;padding:14px 20px;color:white;text-decoration:none;
border-left:3px solid transparent;
}
.sidebar a:hover{background:#111;border-left:3px solid #f5c400;color:#f5c400}

/* TOP BAR */
.topbar{
display:none;
position:fixed;top:0;left:0;width:100%;
background:#070707;border-bottom:2px solid #f5c400;
padding:12px 15px;
z-index:900;
}
.menu-btn{
font-size:26px;color:#f5c400;cursor:pointer;
}

/* OVERLAY */
.overlay{
display:none;
position:fixed;top:0;left:0;width:100%;height:100%;
background:rgba(0,0,0,0.7);
z-index:800;
}
.overlay.show{display:block;}

/* MAIN */
.main{margin-left:240px;padding:25px;padding-top:25px;}

/* CARDS */
.card{
background:#0c0c0c;border-radius:14px;padding:20px;margin-bottom:20px;
border:1px solid #222;
box-shadow:0 0 15px rgba(245,196,0,0.5);
}

/* PROFILE */
.profile{display:flex;align-items:center;gap:20px;flex-wrap:wrap;}
.profile img{
width:100px;height:100px;border-radius:50%;
border:3px solid #f5c400;object-fit:cover;
box-shadow:0 0 15px #f5c400;
}

h1{color:#f5c400;}
.small{color:#aaa;font-size:14px}

/* HERO */
.hero{
border:2px solid #f5c400;
padding:25px;border-radius:18px;
text-align:center;
box-shadow:0 0 25px #f5c400;
}
.hero h2{color:#f5c400;margin-bottom:10px;}
.hero p{color:#ccc}

/* MOBILE */
@media(max-width:900px){
.sidebar{left:-260px}
.sidebar.show{left:0}
.main{margin-left:0;padding-top:70px;}
.topbar{display:block;}
}
</style>

</head>

<body>

<div class="topbar">
<span class="menu-btn" onclick="openMenu()">☰</span>
</div>

<div class="overlay" id="overlay" onclick="closeMenu()"></div>

<div class="sidebar" id="sidebar">
<div class="logo">FAUG Global</div>
<a href="dashboard.php">🏠 Home</a>
<a href="#">⬇ Downloads</a>
<a href="#">🛒 Store</a>
<a href="#">🎮 Profile</a>
<a href="logout.php">🚪 Logout</a>
</div>

<div class="main">

<div class="card profile">
<img src="<?php echo $user['avatar'] ? $user['avatar'] : 'default.png'; ?>">
<div>
<h1><?php echo $user['username']; ?></h1>
<p class="small"><?php echo $user['email']; ?></p>
<p>Gender: <?php echo $user['gender']; ?></p>
<p>Country: <?php echo $user['country']; ?></p>
<p>Coins: 💰 <?php echo $user['coins']; ?></p>
</div>
</div>

<div class="hero">
<h2>🔥 FAUG GLOBAL DASHBOARD</h2>
<p>Welcome soldier, your profile is now connected with FAUG Global servers.</p>
</div>

</div>

<script>
function openMenu(){
document.getElementById("sidebar").classList.add("show");
document.getElementById("overlay").classList.add("show");
}
function closeMenu(){
document.getElementById("sidebar").classList.remove("show");
document.getElementById("overlay").classList.remove("show");
}
</script>

</body>

</html>
