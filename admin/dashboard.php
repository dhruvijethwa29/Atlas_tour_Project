<?php
$page_title = "Dashboard";
require_once '../config/database.php';
require_once 'header.php';

// Counts
$total_users     = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM users"))['cnt'];
$total_bookings  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM bookings"))['cnt'];
$total_packages  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM packages"))['cnt'];

// Recent bookings
$recent = mysqli_query($conn, "SELECT b.id, b.full_name, b.destination, b.booked_at FROM bookings b ORDER BY b.booked_at DESC LIMIT 5");
?>

<div class="stat-grid">
    <div class="stat-card red">
        <div class="stat-details">
            <div class="stat-value"><?php echo $total_bookings; ?></div>
            <div class="stat-label">Total Bookings</div>
        </div>
        <div class="stat-icon">📋</div>
    </div>
    <div class="stat-card blue">
        <div class="stat-details">
            <div class="stat-value"><?php echo $total_users; ?></div>
            <div class="stat-label">Registered Users</div>
        </div>
        <div class="stat-icon">👥</div>
    </div>
    <div class="stat-card green">
        <div class="stat-details">
            <div class="stat-value"><?php echo $total_packages; ?></div>
            <div class="stat-label">Tour Packages</div>
        </div>
        <div class="stat-icon">🌍</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>Recent Bookings</h2>
        <a href="bookings.php" class="btn btn-primary btn-sm">View All</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Customer Name</th>
                <th>Destination</th>
                <th>Booked At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($recent) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($recent)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo date('d M Y, h:i A', strtotime($row['booked_at'])); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" style="text-align:center; color:#64748b;">No bookings yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>
