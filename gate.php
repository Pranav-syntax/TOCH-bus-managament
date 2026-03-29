<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maverix | Entry Gateway</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;500;800&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="hero"></div>
    <div class="container" style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; padding: 20px;">
        
        <h1 style="color: var(--primary-accent); letter-spacing: 10px; margin-bottom: 10px; font-weight: 800; text-align: center;">MAVERIX</h1>
        <p style="color: var(--text-dim); letter-spacing: 4px; margin-bottom: 50px; font-size: 12px; text-transform: uppercase;">Select Your Portal</p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; width: 100%; max-width: 800px;">
            
            <div class="card" style="padding: 50px 30px;">
                <h2 style="color: #fff; margin-bottom: 15px; letter-spacing: 2px;">STUDENT</h2>
                <p style="color: var(--text-dim); font-size: 13px; margin-bottom: 30px; line-height: 1.6;">Access your room details, pay fees, and manage your hostel stay status.</p>
                <a href="student_login.php" class="btn" style="width: 100%;">ENTER RESIDENT HUB</a>
            </div>

            <div class="card" style="padding: 50px 30px; border-color: rgba(255, 68, 68, 0.2);">
                <h2 style="color: #ff4444; margin-bottom: 15px; letter-spacing: 2px;">WARDEN</h2>
                <p style="color: var(--text-dim); font-size: 13px; margin-bottom: 30px; line-height: 1.6;">Manage registrations, room allotments, and view financial residency reports.</p>
                <a href="admin_login.php" class="btn" style="background: #ff4444; width: 100%;">ACCESS COMMAND CENTER</a>
            </div>

        </div>
    </div>
</body>
</html>
