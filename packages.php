<?php
session_start();
require '../config/database.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM packages WHERE id = $id");
    header("Location: packages.php");
    exit;
}

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_package'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $price = $conn->real_escape_string($_POST['price']);
    $duration = $conn->real_escape_string($_POST['duration']);
    $description = $conn->real_escape_string($_POST['description']);
    
    // Simple photo url handle
    $photo_url = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
        $target_dir = "../photo/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $filename = time() . '_' . basename($_FILES["photo"]["name"]);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo_url = "photo/" . $filename;
        }
    }

    $conn->query("INSERT INTO packages (title, duration, description, price, photo_url) VALUES ('$title', '$duration', '$description', '$price', '$photo_url')");
    header("Location: packages.php");
    exit;
}

$packages = $conn->query("SELECT * FROM packages ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            color: #334155;
        }
        header {
            background-color: #ffffff;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
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
        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }
        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
            border: 1px solid #f1f5f9;
        }
        h2 {
            color: #1e293b;
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        h2::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 20px;
            background-color: #4F46E5;
            border-radius: 2px;
        }
        form.add-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group.full-width {
            grid-column: span 2;
        }
        .form-group label {
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #475569;
        }
        .form-group input, .form-group textarea {
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            transition: all 0.2s;
            background-color: #f8fafc;
        }
        .form-group input:focus, .form-group textarea:focus {
            border-color: #4F46E5;
            outline: none;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
        .btn {
            background-color: #4F46E5;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(79, 70, 229, 0.2);
        }
        .btn:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 10px;
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        table tr:last-child td {
            border-bottom: none;
        }
        table tr:hover td {
            background-color: #f1f5f9;
        }
        .action-btn {
            padding: 6px 12px;
            text-decoration: none;
            color: white;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        .btn-delete {
            background-color: #ef4444;
        }
        .btn-delete:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body>
    <header>
        <a href="#" class="logo">Atlas<span>Admin</span></a>
        <div class="nav-links">
            <a href="packages.php" class="active">Packages</a>
            <a href="bookings.php">Bookings</a>
        </div>
        <div class="header-actions">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <h2>Add New Package</h2>
            <form class="add-form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" required placeholder="e.g. Paris Getaway">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" required placeholder="e.g. $1200">
                </div>
                <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name="duration" required placeholder="e.g. 5 Days, 4 Nights">
                </div>
                <div class="form-group">
                    <label>Photo</label>
                    <input type="file" name="photo" accept="image/*">
                </div>
                <div class="form-group full-width">
                    <label>Description</label>
                    <textarea name="description" rows="4" placeholder="Enter package details..."></textarea>
                </div>
                <div class="form-group full-width" style="text-align: right;">
                    <button type="submit" name="add_package" class="btn">Add Package</button>
                </div>
            </form>
        </div>

        <div class="card">
            <h2>Existing Packages</h2>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $packages->fetch_assoc()): ?>
                    <tr>
                        <td style="font-weight: 500; color: #1e293b;"><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['price']) ?></td>
                        <td><?= htmlspecialchars($row['duration']) ?></td>
                        <td>
                            <a href="?delete=<?= $row['id'] ?>" class="action-btn btn-delete" onclick="return confirm('Are you sure you want to delete this package?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if ($packages->num_rows === 0): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: #64748b; padding: 30px;">No packages found. Add one above.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
