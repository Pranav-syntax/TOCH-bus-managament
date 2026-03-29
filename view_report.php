<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Occupancy Report | Maverix</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .report-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .report-table th {
            text-align: left; padding: 15px; color: var(--primary-accent);
            text-transform: uppercase; font-size: 11px; letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .report-table td { padding: 15px; color: var(--text-dim); border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 13px; }
        .report-table tr:hover { background: rgba(255,255,255,0.03); }
        
        .action-btn { text-decoration: none; font-size: 10px; font-weight: 800; padding: 6px 12px; border-radius: 6px; transition: 0.3s; letter-spacing: 1px; }
        .edit-btn { color: #3b82f6; border: 1px solid #3b82f6; margin-right: 5px; }
        .edit-btn:hover { background: #3b82f6; color: #fff; }
        .del-btn { color: #ff4444; border: 1px solid #ff4444; }
        .del-btn:hover { background: #ff4444; color: #fff; }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @media print {
            body * { visibility: hidden; }
            .table-container, .table-container * { visibility: visible; }
            .table-container { position: absolute; left: 0; top: 0; width: 100%; background: white !important; color: black !important; }
            .report-table th, .report-table td { color: black !important; border-bottom: 1px solid #ddd !important; }
            .print-header { display: block !important; text-align: center; margin-bottom: 20px; }
            .action-col { display: none; } 
        }
        .print-header { display: none; }
    </style>
</head>
<body>
    <div class="hero"></div>

    <?php if(isset($_GET['msg'])): ?>
        <div id="statusAlert" style="position: fixed; top: 30px; right: 30px; z-index: 9999; background: #22c55e; color: #fff; padding: 16px 32px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.4); font-weight: 800; display: flex; align-items: center; gap: 10px; animation: slideIn 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <span style="font-size: 20px;">
                <?php echo ($_GET['msg'] == 'deleted') ? '&#128465;' : '&#128221;'; ?>
            </span>
            <span>
                <?php 
                    if($_GET['msg'] == 'deleted') echo "RESIDENT REMOVED SUCCESSFULLY";
                    if($_GET['msg'] == 'updated') echo "RESIDENT DETAILS UPDATED";
                ?>
            </span>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('statusAlert');
                if(alert) {
                    alert.style.transition = 'all 0.5s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(50px)';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    <?php endif; ?>

    <nav class="navbar">
        <div class="logo">MAVERIX</div>
        <div class="nav-links">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="add_student.php">Students</a>
            <a href="allot_room.php">Rooms</a>
            <a href="view_report.php">Reports</a>
            <a href="logout.php" style="color: #ff4444; font-weight: bold;">Logout</a>
        </div>
    </nav>

    <div class="table-container" style="width: 95%; max-width: 1200px; margin: 40px auto; background: rgba(255,255,255,0.03); backdrop-filter: blur(25px); border-radius: 30px; border: 1px solid rgba(255,255,255,0.1); padding: 40px;">
        
        <div class="print-header">
            <h1>MAVERIX HOSTEL MANAGEMENT</h1>
            <p>Official Occupancy Report - <?php echo date('Y-m-d'); ?></p>
            <hr>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 20px;">
            <h2 style="color: var(--primary-accent); letter-spacing: 2px; text-transform: uppercase;">Occupancy Report</h2>
            
            <div style="display: flex; gap: 10px;">
                <form method="GET" style="display: flex; gap: 10px;">
                    <input type="text" name="search" placeholder="ID, Name, or Room..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" 
                           style="padding: 10px 20px; background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); border-radius: 50px; color: #fff; outline: none;">
                    <button type="submit" class="btn" style="padding: 10px 25px; font-size: 11px;">FILTER</button>
                </form>
                <button onclick="window.print()" class="btn" style="padding: 10px 25px; font-size: 11px; background: #3b82f6;">DOWNLOAD PDF</button>
            </div>
        </div>
        
        <table class="report-table">
            <thead>
                <tr>
                    <th>Student ID</th> 
                    <th>Resident Name</th>
                    <th>Branch</th>
                    <th>Room</th>
                    <th>Amount Due</th>
                    <th>Payment Status</th>
                    <th class="action-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
                
                $q = "SELECT s.student_id, s.name, s.branch, r.room_no, r.floor, a.amount, a.status 
                      FROM allotment a 
                      JOIN student s ON a.student_id = s.student_id 
                      JOIN room r ON a.room_id = r.room_id";
                
                if($searchTerm != "") {
                    $q .= " WHERE s.student_id LIKE '%$searchTerm%' OR s.name LIKE '%$searchTerm%' OR r.room_no LIKE '%$searchTerm%'";
                }

                $q .= " ORDER BY a.allot_id DESC";

                $res = mysqli_query($conn, $q);
                while($row = mysqli_fetch_assoc($res)) {
                    $statusColor = ($row['status'] == 'Paid') ? '#22c55e' : '#fbbf24';
                    echo "<tr>
                        <td style='font-family: monospace; letter-spacing: 1px;'>#{$row['student_id']}</td> 
                        <td><strong style='color:#fff;'>{$row['name']}</strong></td>
                        <td>{$row['branch']}</td>
                        <td>{$row['room_no']} (F-{$row['floor']})</td>
                        <td>&#8377;" . number_format($row['amount']) . "</td>
                        <td><span style='color: $statusColor; font-weight:800;'>&#9679; " . strtoupper($row['status']) . "</span></td>
                        <td class='action-col'>
                            <a href='edit_resident.php?id={$row['student_id']}' class='action-btn edit-btn'>EDIT</a>
                            <a href='delete_student.php?id={$row['student_id']}' class='action-btn del-btn' onclick='return confirm(\"Are you sure you want to remove this resident and their allotment?\")'>DELETE</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
