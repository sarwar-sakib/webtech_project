<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['user']['account_type'] != 'admin') {
    header('location: login.html');
    exit;
}

$con = mysqli_connect('127.0.0.1', 'root', '', 'testing_project');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM feedback ORDER BY created_at ASC";
$result = mysqli_query($con, $sql);
if (!$result) {
    die("Error fetching feedback: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            background-color: rgb(0, 123, 255);
            color: white;
            padding: 10px;
            margin: 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background-color: rgb(0, 123, 255);
            color: white;
            text-align: left;
            padding: 10px;
        }

        td {
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf4ff;
        }

        a {
            display: inline-block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            color: rgb(0, 123, 255);
            font-weight: bold;
            border: 1px solid rgb(0, 123, 255);
            padding: 10px 20px;
            border-radius: 5px;
        }

        a:hover {
            background-color: rgb(0, 123, 255);
            color: white;
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Feedback List</h1>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Feedback</th>
                <th>Submitted At</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['feedback']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="home.php">Back to Dashboard</a>
    </div>
</body>
</html>
