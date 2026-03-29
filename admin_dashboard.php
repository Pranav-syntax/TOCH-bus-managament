<?php
session_start();
if(!isset($_SESSION['admin'])) { 
    header("Location: admin_login.php"); 
    exit(); 
}
include "db.php";

$total_students = $conn->query("SELECT COUNT(*) as total FROM student")->fetch_assoc()['total'];
$total_rooms = $conn->query("SELECT COUNT(*) as total FROM room")->fetch_assoc()['total'];
$total_revenue = $conn->query("SELECT SUM(amount) as total FROM allotment WHERE status='Paid'")->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maverix | Warden Dashboard</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    
    <style>
    .hero-content {
        height: 45vh !important;
        margin-bottom: 20px;
    }

    .final-maverix {
        font-size: 100px !important;
        font-weight: 900 !important;
        letter-spacing: 25px !important;
        color: transparent !important;
        -webkit-text-stroke: 1px rgba(34, 197, 94, 0.4) !important;
        background: linear-gradient(135deg, #059669 0%, #22c55e 50%, #4ade80 100%) !important;
        background-repeat: no-repeat !important;
        -webkit-background-clip: text !important;
        background-size: 0% 100% !important;
        filter: drop-shadow(0 0 15px rgba(34, 197, 94, 0.3)) !important;
        display: block !important;
        margin: 0 auto !important;
        animation: moviePopFinal 4s cubic-bezier(0.2, 0.8, 0.2, 1) forwards !important;
    }

    .maverix-subtitle {
        letter-spacing: 10px !important;
        text-transform: uppercase !important;
        font-size: 14px !important;
        color: #22c55e !important;
        margin-top: 10px !important;
        opacity: 0;
        text-align: center;
        font-weight: 600 !important;
        animation: subtitleFadeIn 1s ease forwards 3.5s !important;
    }

    .stats-container {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-bottom: 50px;
        opacity: 0;
        animation: subtitleFadeIn 1s ease forwards 4s;
    }

    .stat-item {
        text-align: center;
        padding: 15px 30px;
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(34, 197, 94, 0.2);
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }

    .stat-value { font-size: 24px; font-weight: 800; color: #fff; }
    .stat-label { font-size: 10px; text-transform: uppercase; color: #22c55e; letter-spacing: 2px; }

    @keyframes moviePopFinal {
        0% { background-size: 0% 100%; transform: scale(1.6); filter: blur(15px); opacity: 0; }
        40% { opacity: 1; filter: blur(0px); background-size: 100% 100%; transform: scale(1.6); }
        100% { background-size: 100% 100%; transform: scale(1.0) translateY(-30px); -webkit-text-stroke: 0px; filter: drop-shadow(0 0 20px rgba(34, 197, 94, 0.5)); }
    }

    @keyframes subtitleFadeIn {
        to { opacity: 0.8; transform: translateY(-30px); }
    }

    .card { transition: 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) !important; cursor: pointer; }
    .card:hover {
        transform: translateY(-20px) scale(1.02) !important;
        border-color: #22c55e !important;
        background: rgba(34, 197, 94, 0.08) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.4) !important;
    }
    .card {
        background: rgba(255, 255, 255, 0.05) !important;
        backdrop-filter: blur(10px) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
    }
    </style>
</head>
<body>
<div class="hero"></div>

<nav class="navbar">
    <div class="nav-links" style="margin-left: auto;"> 
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="add_student.php">Students</a>
        <a href="allot_room.php">Rooms</a>
        <a href="view_report.php">Reports</a>
        <a href="logout.php" style="color: #ff4444; font-weight: bold;">Logout</a>
    </div>
</nav>

<div class="hero-content" style="display: flex; align-items: center; justify-content: center;">
    <div class="title-wrapper">
        <h1 class="final-maverix">MAVERIX</h1>
        <p class="maverix-subtitle">SYSTEM COMMAND &bull; WARDEN PORTAL</p>
    </div>
</div>

<div class="stats-container">
    <div class="stat-item">
        <div class="stat-value"><?php echo $total_students; ?></div>
        <div class="stat-label">Total Residents</div>
    </div>
    <div class="stat-item">
        <div class="stat-value"><?php echo $total_rooms; ?></div>
        <div class="stat-label">Hostel Rooms</div>
    </div>
    <div class="stat-item">
        <div class="stat-value">&#8377;<?php echo number_format($total_revenue); ?></div>
        <div class="stat-label">Revenue Collected</div>
    </div>
</div>

<div class="dashboard">
    <div class="card" onclick="location.href='add_student.php'">
        <h3 style="color: #fff; margin-bottom: 10px;">User Management</h3>
        <p style="color: var(--text-dim); margin-bottom: 20px; font-size: 13px;">Register and manage residents.</p>
        <a href="add_student.php" class="btn">Add Student</a>
    </div>
    <div class="card" onclick="location.href='allot_room.php'">
        <h3 style="color: #fff; margin-bottom: 10px;">Room Allocation</h3>
        <p style="color: var(--text-dim); margin-bottom: 20px; font-size: 13px;">Assign rooms and track occupancy.</p>
        <a href="allot_room.php" class="btn">Allot Room</a>
    </div>
    <div class="card" onclick="location.href='view_report.php'">
        <h3 style="color: #fff; margin-bottom: 10px;">System Analytics</h3>
        <p style="color: var(--text-dim); margin-bottom: 20px; font-size: 13px;">View occupancy and financial reports.</p>
        <a href="view_report.php" class="btn">View Reports</a>
    </div>
</div>

</body>
</html>
