<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maverix | Welcome</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    
    <style>
    /* Force hover movement for the index cards */
    .card {
        transition: 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) !important;
        cursor: pointer;
    }
    
    .card:hover {
        transform: translateY(-20px) scale(1.02) !important;
        border-color: #22c55e !important;
        background: rgba(34, 197, 94, 0.08) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.5) !important;
    }

    /* Keep branding consistent with the dashboard */
    .logo-text {
        font-weight: 900;
        letter-spacing: 15px;
        color: #22c55e;
        text-shadow: 0 0 15px rgba(34, 197, 94, 0.3);
    }
    </style>
</head>
<body>
<div class="hero"></div>

<div class="hero-content">
    <h1 class="logo-text">MAVERIX</h1>
    <p style="color: var(--text-dim); letter-spacing: 5px; margin-top: 10px;">HOSTEL MANAGEMENT SYSTEM</p>
</div>

<div class="dashboard" style="margin-top: -50px;">
    <div class="card" onclick="location.href='admin_login.php'">
        <h2 style="color: #fff; margin-bottom: 15px;">ADMIN PORTAL</h2>
        <p style="color: var(--text-dim); margin-bottom: 25px;">Warden & Staff Control Center</p>
        <a href="admin_login.php" class="btn">Login as Admin</a>
    </div>

    <div class="card" onclick="location.href='student_login.php'">
        <h2 style="color: #fff; margin-bottom: 15px;">STUDENT PORTAL</h2>
        <p style="color: var(--text-dim); margin-bottom: 25px;">Access your room & fee details</p>
        <a href="student_login.php" class="btn">Login as Student</a>
    </div>
</div>

</body>
</html>
