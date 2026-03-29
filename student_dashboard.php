<?php
session_start();
if(!isset($_SESSION['student_id'])) { 
    header("Location: login.php"); 
    exit(); 
}
include "db.php";

$sid = $_SESSION['student_id'];

$q = "SELECT s.*, r.room_no, r.floor, a.amount, a.status 
      FROM student s 
      LEFT JOIN allotment a ON s.student_id = a.student_id 
      LEFT JOIN room r ON a.room_id = r.room_id 
      WHERE s.student_id = '$sid'";
$res = mysqli_query($conn, $q);
$data = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Stay | Maverix</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { overflow-y: auto !important; height: auto !important; }
        .card { 
            opacity: 1 !important; 
            transition: 0.4s cubic-bezier(0.2, 0.8, 0.2, 1) !important; 
            background: rgba(255, 255, 255, 0.02) !important;
            backdrop-filter: blur(15px) saturate(160%) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        } 
        .card:hover { 
            transform: translateY(-10px) scale(1.01); 
            border-color: var(--primary-accent) !important; 
            background: rgba(34, 197, 94, 0.05) !important;
            box-shadow: 0 15px 30px rgba(0,0,0,0.5);
        }
        select, textarea, input[type="password"] {
            width: 100%;
            background: rgba(0, 0, 0, 0.3) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #fff !important;
            padding: 12px;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
        }
        select:focus, textarea:focus, input[type="password"]:focus {
            border-color: var(--primary-accent) !important;
            box-shadow: 0 0 15px rgba(34, 197, 94, 0.2);
        }
        option { background: #1a1a1a; color: #fff; }
    </style>
</head>
<body>
    <div class="hero"></div>
    
    <nav class="navbar">
        <div class="nav-links" style="margin-left: auto;">
            <a href="logout.php" style="color:#ff4444; font-weight: 800; letter-spacing: 1px;">LOGOUT</a>
        </div>
    </nav>

    <div class="container" style="max-width: 1000px; margin: 30px auto; padding: 20px;">
        
        <?php if(isset($_GET['payment']) && $_GET['payment'] == 'success'): ?>
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #fff; padding: 20px; border-radius: 15px; margin-bottom: 30px; text-align: center; backdrop-filter: blur(10px);">
                <strong style="color: #22c55e;">&#9989; PAYMENT SUCCESSFUL!</strong> Your stay status has been updated to PAID in the database.
            </div>
        <?php endif; ?>

        <?php if(isset($_GET['msg']) && $_GET['msg'] == 'complaint_sent'): ?>
            <div style="background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #fff; padding: 20px; border-radius: 15px; margin-bottom: 30px; text-align: center; backdrop-filter: blur(10px);">
                <strong style="color: #22c55e;">&#9989; GRIEVANCE FILED!</strong> The warden has been notified of your issue.
            </div>
        <?php endif; ?>

        <h2 style="color: var(--primary-accent); letter-spacing: 3px; text-transform: uppercase; margin-bottom: 40px; text-align: center; font-weight: 800;">
            Welcome, <?php echo $data['name']; ?>
        </h2>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px;">
            
            <div class="card" style="padding: 40px; text-align: left;">
                <h4 style="color: var(--primary-accent); margin-bottom: 25px; letter-spacing: 2px; text-transform: uppercase;">Accommodation</h4>
                <div style="line-height: 2.2;">
                    <p style="color: var(--text-dim); font-size: 14px;">Room No: <span style="color: #fff; font-weight: 800;"><?php echo $data['room_no'] ?? 'Unassigned'; ?></span></p>
                    <p style="color: var(--text-dim); font-size: 14px;">Level/Floor: <span style="color: #fff;"><?php echo $data['floor'] ?? 'N/A'; ?></span></p>
                    <p style="color: var(--text-dim); font-size: 14px;">Department: <span style="color: #fff;"><?php echo $data['branch']; ?></span></p>
                </div>
            </div>

            <div class="card" style="padding: 40px; text-align: left;">
                <h4 style="color: var(--primary-accent); margin-bottom: 25px; letter-spacing: 2px; text-transform: uppercase;">Mess & Stay Fees</h4>
                <div style="line-height: 2.2; margin-bottom: 25px;">
                    <p style="color: var(--text-dim); font-size: 14px;">Total Balance: <span style="color: #fff; font-size: 1.3rem; font-weight: 800;">&#8377;<?php echo number_format($data['amount'] ?? 0); ?></span></p>
                    <p style="color: var(--text-dim); font-size: 14px;">Status: 
                        <span style="color: <?php echo ($data['status'] == 'Paid') ? '#22c55e' : '#fbbf24'; ?>; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">
                            <?php echo $data['status'] ?? 'N/A'; ?>
                        </span>
                    </p>
                </div>

                <?php if($data['status'] == 'Pending'): ?>
                    <a href="payment_gateway.php" class="btn" style="width: 100%; text-align: center; background: #22c55e; color: #000; font-weight: 900; border-radius: 12px; padding: 15px;">
                        SETTLE BALANCE
                    </a>
                <?php else: ?>
                    <div style="text-align: center; padding: 15px; background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 12px; color: #22c55e; font-weight: 800; font-size: 12px;">
                        &#9989; ACCOUNT CLEARED
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-top: 25px;">
            
            <div class="card" style="padding: 35px; text-align: left;">
                <h4 style="color: var(--primary-accent); margin-bottom: 20px; letter-spacing: 2px; text-transform: uppercase;">Lodge a Complaint</h4>
                <form action="submit_complaint.php" method="POST">
                    <p style="font-size: 10px; color: var(--text-dim); text-transform: uppercase; margin-bottom: 8px; letter-spacing: 1px;">Issue Category</p>
                    <select name="category" required>
                        <option value="Maintenance">Maintenance / Repair</option>
                        <option value="Food">Mess / Food Quality</option>
                        <option value="Cleaning">Cleaning Services</option>
                        <option value="Other">Other Issues</option>
                    </select>
                    
                    <p style="font-size: 10px; color: var(--text-dim); text-transform: uppercase; margin: 15px 0 8px; letter-spacing: 1px;">Message Description</p>
                    <textarea name="message" placeholder="Provide details of the issue..." required></textarea>
                        
                    <button type="submit" class="btn" style="width: 100%; border: none; cursor: pointer; margin-top: 15px; padding: 15px; font-weight: 900;">
                        SUBMIT GRIEVANCE
                    </button>
                </form>
            </div>

            <div class="card" style="padding: 35px; text-align: left;">
                <h4 style="color: var(--primary-accent); margin-bottom: 20px; letter-spacing: 2px; text-transform: uppercase;">Security Settings</h4>
                <form action="update_password.php" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
                    <div>
                        <p style="font-size: 10px; color: var(--text-dim); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Update Access Password</p>
                        <input type="password" name="new_password" placeholder="Enter New Password" required>
                    </div>
                    <button type="submit" name="change_pass" class="btn" style="padding: 15px; background: var(--primary-accent); color: #000; font-weight: 900; border: none; cursor: pointer; margin-top: 5px;">
                        UPDATE SECURITY
                    </button>
                    <p style="font-size: 11px; color: #888; text-align: center; margin-top: 10px;">
                        Ensure your password is complex for better protection.
                    </p>
                </form>
            </div>
        </div>

    </div>
</body>
</html>
