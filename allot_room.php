<?php
session_start();
if(!isset($_SESSION['admin'])) { 
    header("Location: admin_login.php"); 
    exit(); 
}
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Allocation | Maverix</title>
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

    <div class="container" style="max-width: 600px; margin: 40px auto; padding: 40px; background: rgba(255,255,255,0.03); backdrop-filter: blur(20px); border-radius: 30px; border: 1px solid rgba(255,255,255,0.1);">
        <h2 style="color: var(--primary-accent); margin-bottom: 30px; letter-spacing: 2px; text-align: center; text-transform: uppercase; font-weight: 800;">Assign Room to Resident</h2>

        <?php
        if(isset($_POST['allot'])) {
            $aid = $_POST['aid']; 
            $sid = $_POST['sid']; 
            $rid = $_POST['rid']; 
            $date = date('Y-m-d');
            
            try {
                $q = "INSERT INTO allotment (allot_id, student_id, room_id, allot_date, amount, status) 
                      VALUES ('$aid', '$sid', '$rid', '$date', '15000', 'Pending')";
                
                if(mysqli_query($conn, $q)) {
                    echo "<div style='background: rgba(34, 197, 94, 0.2); border: 1px solid #22c55e; color: #fff; padding: 15px; border-radius: 10px; text-align:center; margin-bottom: 20px;'>&#9989; Room Allotted Successfully</div>";
                }
            } catch (mysqli_sql_exception $e) {
                $error = $e->getMessage();
                echo "<div style='background: rgba(255, 68, 68, 0.2); border: 1px solid #ff4444; color: #fff; padding: 15px; border-radius: 10px; text-align:center; margin-bottom: 20px;'>&#10060; $error</div>";
            }
        }
        ?>

        <form method="post" style="display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; flex-direction: column;">
                <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Allotment Reference ID</label>
                <input type="number" name="aid" required placeholder="Enter ID (e.g. 101)" style="padding: 14px; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; outline: none;">
            </div>

            <div style="display: flex; flex-direction: column;">
                <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Student ID</label>
                <input type="number" name="sid" required placeholder="Enter Student ID" style="padding: 14px; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; outline: none;">
            </div>

            <div style="display: flex; flex-direction: column;">
                <label style="font-size: 11px; color: var(--text-dim); margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;">Select Room</label>
                <select name="rid" required style="padding: 14px; background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1); border-radius: 12px; color: #fff; outline: none; cursor: pointer;">
                    <option value="" style="background: #1a1a1a;">-- Browse Rooms --</option>
                    <?php
                    $q2 = "SELECT r.room_id, r.room_no, r.capacity, 
                           (SELECT COUNT(*) FROM allotment a WHERE a.room_id = r.room_id) AS used 
                           FROM room r";
                    
                    $res = mysqli_query($conn, $q2);
                    while($row = mysqli_fetch_assoc($res)) {
                        $isFull = ($row['used'] >= $row['capacity']);
                        $statusText = $isFull ? " [FULL]" : " (Slots: " . ($row['capacity'] - $row['used']) . ")";
                        echo "<option value='{$row['room_id']}' style='background: #1a1a1a;'>
                                Room {$row['room_no']} $statusText
                              </option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" name="allot" class="btn" style="width: 100%; margin-top: 10px; cursor: pointer; padding: 16px; font-weight: 800; letter-spacing: 1px;">
                CONFIRM ALLOCATION
            </button>
        </form>
    </div>
</body>
</html>
