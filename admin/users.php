<?php
$page_title = "Users";
require_once '../config/database.php';
require_once 'header.php';

// Delete user
if (isset($_GET['delete'])) {
    $del_id = (int)$_GET['delete'];
    // Remove bookings for user first to avoid FK issues
    mysqli_query($conn, "DELETE FROM bookings WHERE user_id = $del_id");
    mysqli_query($conn, "DELETE FROM users WHERE id = $del_id");
    header("Location: users.php?msg=deleted");
    exit();
}

$msg = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') $msg = '<div class="alert alert-danger">User and their bookings deleted.</div>';
}

$users = mysqli_query($conn, "SELECT u.*, COUNT(b.id) AS booking_count FROM users u LEFT JOIN bookings b ON b.user_id = u.id GROUP BY u.id ORDER BY u.created_at DESC");
?>

<?php echo $msg; ?>

<div class="card">
    <div class="card-header">
        <h2>All Users</h2>
        <span class="badge"><?php echo mysqli_num_rows($users); ?> Total</span>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Bookings</th>
                <th>Joined</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($users) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td>
                        <span style="background: #EFF6FF; color: #2563EB; border: 1px solid #DBEAFE; padding: 2px 8px; border-radius: 6px; font-size: 12px; font-weight: 500;">
                            <?php echo $row['booking_count']; ?>
                        </span>
                    </td>
                    <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <a href="users.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this user and all their bookings?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center; color:#64748b;">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once 'footer.php'; ?>
