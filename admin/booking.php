<?php
$page_title = "Bookings";
require_once '../config/database.php';
require_once 'header.php';

// Delete booking
if (isset($_GET['delete'])) {
    $del_id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM bookings WHERE id = $del_id");
    header("Location: bookings.php?msg=deleted");
    exit();
}

$msg = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') $msg = '<div class="alert alert-danger">Booking deleted successfully.</div>';
}

$bookings = mysqli_query($conn, "SELECT * FROM bookings ORDER BY booked_at DESC");
?>

<?php echo $msg; ?>

<div class="card">
    <div class="card-header">
        <h2>All Bookings</h2>
        <span class="badge"><?php echo mysqli_num_rows($bookings); ?> Total</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Destination</th>
                <th>Travelers</th>
                <th>Travel Type</th>
                <th>Payment</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($bookings) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($bookings)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['destination']); ?></td>
                    <td><?php echo $row['travelers']; ?></td>
                    <td><?php echo htmlspecialchars($row['travel_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                    <td><?php echo date('d M Y', strtotime($row['booked_at'])); ?></td>
                    <td>
                        <a href="bookings.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this booking?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="10" style="text-align:center; color:#64748b;">No bookings found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>
