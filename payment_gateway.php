<?php
session_start();
if(!isset($_SESSION['student_id'])) { header("Location: student_login.php"); exit(); }
include "db.php";
$sid = $_SESSION['student_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Gateway | Maverix</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <style>
        .timer-box {
            font-size: 20px; font-weight: 800; color: #ff4444;
            background: rgba(255, 68, 68, 0.1); padding: 10px 20px;
            border-radius: 50px; display: inline-block; margin-bottom: 20px;
            border: 1px solid rgba(255, 68, 68, 0.3);
        }
    </style>
</head>
<body>
    <div class="hero"></div>
    <div class="container" style="display: flex; justify-content: center; align-items: center; min-height: 100vh;">
        <div class="card" style="max-width: 450px; text-align: center; padding: 40px;">
            <h2 style="color: var(--primary-accent); margin-bottom: 5px;">SECURE CHECKOUT</h2>
            <p style="color: var(--text-dim); font-size: 12px; margin-bottom: 20px;">TRANS ID: #MVX<?php echo time(); ?></p>
            
            <div class="timer-box">&#9201; <span id="timer">05:00</span></div>

            <div style="background: #fff; padding: 15px; border-radius: 15px; display: inline-block; margin-bottom: 25px; box-shadow: 0 0 30px rgba(34, 197, 94, 0.3);">
                <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=upi://pay?pa=hostel@upi%26pn=MAVERIX%20HOSTEL%26am=15000" 
                     alt="UPI QR Code" style="width: 200px; height: 200px; display: block;">
            </div>

            <h3 style="color: #fff; margin-bottom: 10px;">&#8377;15,000.00</h3>
            <p style="color: var(--text-dim); font-size: 11px; margin-bottom: 25px;">Scan with GPay or any UPI app. Do not close this window.</p>

            <form action="process_payment.php" method="POST">
                <button type="submit" class="btn" style="width: 100%; letter-spacing: 2px; cursor: pointer;">VERIFY TRANSACTION</button>
            </form>
            <a href="student_dashboard.php" style="color: #888; text-decoration: none; font-size: 11px; display: block; margin-top: 15px;">Cancel and Return</a>
        </div>
    </div>

    <script>
        let timeLeft = 300;
        const timerElement = document.getElementById('timer');
        const countdown = setInterval(() => {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            timerElement.innerHTML = `${minutes}:${seconds}`;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = "student_dashboard.php";
            }
            timeLeft--;
        }, 1000);
    </script>
</body>
</html>
