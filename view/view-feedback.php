<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['user']['account_type'] != 'admin') {
    header('location: login.html');
}

$con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');
$sql = "SELECT * FROM feedback ORDER BY created_at ASC";
$result = mysqli_query($con, $sql);
?>

<html lang="en">
<head>
    <title>View Feedback</title>
</head>
<body>
    <h1>Feedback List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Feedback</th>
            <th>Submitted At</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['feedback'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="home.php">Back to Dashboard</a>
</body>
</html>
