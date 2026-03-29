<?php
session_start();
if(!isset($_SESSION['admin'])) { 
    header("Location: admin_login.php"); 
    exit(); 
}
include "db.php";

$message = "";

if(isset($_POST['save'])) {
    $id = $_POST['id']; 
    $name = $_POST['name'];
    $branch = $_POST['branch']; 
    $year = $_POST['year'];
    $phone = $_POST['phone']; 
    $email = $_POST['email'];
    $custom_pass = $_POST['password']; 

    $stmt = $conn->prepare("INSERT INTO student VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $id, $name, $branch, $year, $phone, $email, $custom_pass);

    if($stmt->execute()) {
        $message = "<p style='background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #fff; padding: 15px; border-radius: 10px; text-align:center;'>&#9989; Student Registered Successfully</p>";
    } else {
        $message = "<p style='background: rgba(255, 68, 68, 0.2); border: 1px solid #ff4444; color: #fff; padding: 15px; border-radius: 10px; text-align:center;'>&#10060; Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration | Maverix</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="hero"></div>

    <nav class="navbar">
        <div class="logo">MAVERIX</div>
        <div class="nav-links">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="add_student.php">Students</a>
            <a href="allot_room.php">Rooms</a>
            <a href="view_report.php">Reports</a>
            <a href="logout.php" class="logout" style="color: #ff4444; font-weight: bold;">Logout</a>
        </div>
    </nav>

    <div class="container" style="max-width: 650px; margin: 40px auto; padding: 40px; background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border-radius: 30px; border: 1px solid rgba(255,255,255,0.1);">
        <h2 style="color: var(--primary-accent); margin-bottom: 30px; letter-spacing: 2px; text-align: center; text-transform: uppercase; font-weight: 800;">Register New Resident</h2>
        
        <?php echo $message; ?>

        <form method="post" style="display: flex; flex-direction: column; gap: 20px; margin-top: 20px;">
            
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 15px;">
                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Student ID</label>
                    <input type="number" name="id" required placeholder="Ex: 52" style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; outline: none;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Full Name</label>
                    <input type="text" name="name" required placeholder="Enter resident name" style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; outline: none;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Branch</label>
                    <input type="text" name="branch" required placeholder="Ex: CSE" style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; outline: none;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Year</label>
                    <input type="number" name="year" required min="1" max="4" placeholder="1-4" style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; outline: none;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Phone Number</label>
                    <input type="text" name="phone" required placeholder="Phone no." style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; outline: none;">
                </div>
                <div style="display: flex; flex-direction: column;">
                    <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Email Address</label>
                    <input type="email" name="email" required placeholder="email@gmail.com" style="padding: 12px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; color: #fff; outline: none;">
                </div>
            </div>

            <div style="display: flex; flex-direction: column;">
                <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 5px; text-transform: uppercase;">Account Password</label>
                <input type="password" name="password" required placeholder="Set initial student password" 
                       style="padding: 12px; background: rgba(34, 197, 94, 0.05); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 10px; color: #fff; outline: none;">
            </div>

            <input type="submit" name="save" value="SAVE NEW STUDENT" class="btn" style="width: 100%; margin-top: 10px; cursor: pointer; padding: 16px; font-weight: 800; letter-spacing: 2px;">
        </form>
    </div>
</body>
</html>
