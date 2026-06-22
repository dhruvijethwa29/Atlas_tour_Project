<?php
session_start();
require '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

$bookings = $conn->query("SELECT * FROM bookings ORDER BY booked_at DESC");
$bookingsData = [];
while ($row = $bookings->fetch_assoc()) {
    $bookingsData[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #334155;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #ffffff;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
            z-index: 10;
        }
        .logo {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo span {
            color: #4F46E5;
        }
        .nav-links {
            display: flex;
            gap: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: #64748b;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .nav-links a:hover {
            color: #1e293b;
            background-color: #f1f5f9;
        }
        .nav-links a.active {
            color: #4F46E5;
            background-color: #e0e7ff;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .logout-btn {
            color: #dc2626;
            background-color: #fee2e2;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        .logout-btn:hover {
            background-color: #fca5a5;
            color: #991b1b;
        }
        
        .main-content {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        /* Sidebar List */
        .booking-list {
            width: 350px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        .list-header {
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
            position: sticky;
            top: 0;
            z-index: 5;
        }
        .list-header h2 {
            margin: 0;
            font-size: 18px;
            color: #1e293b;
        }
        .booking-item {
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .booking-item:hover {
            background-color: #f8fafc;
        }
        .booking-item.active {
            background-color: #eef2ff;
            border-left: 4px solid #4F46E5;
        }
        .booking-item .name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 5px;
            font-size: 15px;
        }
        .booking-item .dest {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 8px;
        }
        .booking-item .date {
            font-size: 12px;
            color: #94a3b8;
        }

        /* Detail Pane */
        .booking-detail {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
            background-color: #f8fafc;
            display: flex;
            justify-content: center;
        }
        .detail-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            width: 100%;
            max-width: 800px;
            padding: 40px;
            border: 1px solid #f1f5f9;
            display: none; /* hidden by default until selected */
        }
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #94a3b8;
        }
        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 15px;
            color: #cbd5e1;
        }
        
        .detail-header {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .detail-header h2 {
            margin: 0 0 10px 0;
            color: #1e293b;
            font-size: 28px;
        }
        .badge {
            display: inline-block;
            background: #eef2ff;
            color: #4F46E5;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }
        .info-group {
            margin-bottom: 15px;
        }
        .info-label {
            font-size: 13px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            color: #1e293b;
            font-weight: 500;
        }
        .info-value.email { color: #4F46E5; }
        .full-width { grid-column: span 2; }
        
        .special-req {
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">Atlas<span>Admin</span></a>
        <div class="nav-links">
            <a href="packages.php">Packages</a>
            <a href="bookings.php" class="active">Bookings</a>
        </div>
        <div class="header-actions">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="main-content">
        <!-- Sidebar -->
        <div class="booking-list">
            <div class="list-header">
                <h2>Recent Bookings</h2>
            </div>
            <?php if (empty($bookingsData)): ?>
                <div style="padding: 20px; color: #64748b; text-align: center;">No bookings found.</div>
            <?php else: ?>
                <?php foreach ($bookingsData as $index => $bk): ?>
                    <div class="booking-item" onclick="showDetail(<?= $index ?>, this)">
                        <div class="name"><?= htmlspecialchars($bk['full_name']) ?></div>
                        <div class="dest">📍 <?= htmlspecialchars($bk['destination']) ?></div>
                        <div class="date"><?= date('M j, Y, g:i a', strtotime($bk['booked_at'])) ?></div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Detail Pane -->
        <div class="booking-detail">
            <div class="empty-state" id="emptyState">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                <p>Select a booking from the list to view details</p>
            </div>

            <div class="detail-card" id="detailCard">
                <div class="detail-header">
                    <h2 id="d-name">John Doe</h2>
                    <span class="badge" id="d-dest">Paris Getaway</span>
                </div>
                
                <div class="info-grid">
                    <div class="info-group">
                        <div class="info-label">Email Address</div>
                        <div class="info-value email" id="d-email">john@example.com</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Phone Number</div>
                        <div class="info-value" id="d-phone">+1 234 567 890</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Age</div>
                        <div class="info-value" id="d-age">30</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Travelers</div>
                        <div class="info-value" id="d-travelers">2</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Travel Type</div>
                        <div class="info-value" id="d-type">Luxury</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Payment Method</div>
                        <div class="info-value" id="d-payment">Credit Card</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Booking Date</div>
                        <div class="info-value" id="d-date">Oct 12, 2023</div>
                    </div>
                    
                    <div class="info-group full-width" id="d-req-container">
                        <div class="info-label">Special Requests</div>
                        <div class="special-req" id="d-req">None</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const bookingsData = <?= json_encode($bookingsData) ?>;

        function showDetail(index, element) {
            // Update active state in sidebar
            document.querySelectorAll('.booking-item').forEach(el => el.classList.remove('active'));
            element.classList.add('active');

            // Hide empty state, show card
            document.getElementById('emptyState').style.display = 'none';
            document.getElementById('detailCard').style.display = 'block';

            // Populate data
            const data = bookingsData[index];
            document.getElementById('d-name').textContent = data.full_name;
            document.getElementById('d-dest').textContent = data.destination;
            document.getElementById('d-email').textContent = data.email;
            document.getElementById('d-phone').textContent = data.phone;
            document.getElementById('d-age').textContent = data.age;
            document.getElementById('d-travelers').textContent = data.travelers;
            document.getElementById('d-type').textContent = data.travel_type;
            document.getElementById('d-payment').textContent = data.payment_method;
            
            // Format Date
            const dateObj = new Date(data.booked_at);
            document.getElementById('d-date').textContent = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' });

            // Special requests
            if (data.special_requests && data.special_requests.trim() !== '') {
                document.getElementById('d-req-container').style.display = 'block';
                document.getElementById('d-req').textContent = data.special_requests;
            } else {
                document.getElementById('d-req-container').style.display = 'none';
            }
        }
    </script>
</body>
</html>
