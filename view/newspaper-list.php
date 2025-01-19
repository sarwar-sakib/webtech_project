<?php
session_start();
if (!isset($_SESSION['status'])) {
    header('location: login.html');
}
require_once('../model/newspaperModel.php');

if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
    $searchQuery = isset($_GET['search-query']) ? $_GET['search-query'] : '';
    $newspapers = !empty($searchQuery) ? searchNewspapers($searchQuery) : getAllNewspapers();
    header('Content-Type: application/json');
    echo json_encode($newspapers);
    exit;
}

//Hii hey

// Fetch all newspapers from the database
$newspapers = getAllNewspapers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newspaper List</title>
    <link rel="stylesheet" type="text/css" href="Newspaper-liststyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        #body-container {
            padding: 20px;
            flex: 1;
        }

        /* Page Title */
        #page-title {
            margin-top: 60px;
            text-align: center;
            color: #007BFF;
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* Search Form */
        #search-form {
            margin-top: 50px;
            text-align: center;
            margin-bottom: 20px;
        }
        #search-label {
            font-size: 16px;
            font-weight: bold;
            margin-right: 10px;
        }
        #search-bar {
            padding: 10px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Table Styling */
        #newspaper-table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        #table-header th {
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            padding: 10px;
            text-align: left;
        }
        .table-row td {
            padding: 10px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }
        .table-row:hover {
            background-color: #f9f9f9;
        }
        .no-results {
            text-align: center;
            color: #999;
            font-size: 14px;
            padding: 10px;
        }

        /* Action Links */
        .newspaper-actions a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            margin: 0 5px;
        }
        .newspaper-actions a:hover {
            text-decoration: underline;
        }

        /* Add Newspaper and Home Links */
        #action-links {
            text-align: center;
            margin-top: 20px;
        }
        #action-links a {
            color: #007BFF;
            text-decoration: none;
            font-size: 14px;
            margin: 0 10px;
        }
        #action-links a:hover {
            text-decoration: underline;
        }

        /* Footer Styling */
        footer {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 15px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        footer a {
            color: #fff;
            text-decoration: underline;
        }
        footer a:hover {
            text-decoration: none;
        }
    </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function editNewspaperForm(id) {
            window.location.href = `../view/edit-newspaper.php?id=${id}`;
        }

        function liveSearch() {
            const query = $('#search-bar').val();
            $.get('newspaper-list.php', { 'search-query': query, 'ajax': 'true' }, function(data) {
                let rows = '';
                if (data.length > 0) {
                    data.forEach(item => {
                        rows += ` 
                            <tr class="table-row">
                                <td class="newspaper-name">${item.name}</td>
                                <td class="newspaper-price">${item.price}</td>
                                <?php if ($_SESSION['user']['account_type'] == 'admin') { ?>
                                <td class="newspaper-actions">
                                    <a href="javascript:void(0)" onclick="deleteNewspaper(${item.id})" class="delete-link">Delete</a> |
                                    <a href="javascript:void(0)" onclick="editNewspaperForm(${item.id})" class="edit-link">Edit</a>
                                </td>
                                <?php } ?>
                                <?php if ($_SESSION['user']['account_type'] == 'advertiser') { ?>
                                <td class="newspaper-actions">
                                    <a href="createAd.php?newspaper=${encodeURIComponent(item.name)}&price=${item.price}" class="select-link">Select</a>
                                </td>
                                <?php } ?>
                            </tr>
                        `;
                    });
                } else {
                    rows = `
                        <tr>
                            <td colspan="3" class="no-results">No results found</td>
                        </tr>
                    `;
                }
                $('#newspaper-table tbody').html(rows);
            });
        }

        $(document).ready(function() {
            $('#search-bar').on('input', liveSearch);
        });
    </script>
</head>

<body id="body-container">
    <main>
    <?php includeTopBar(); ?>

    <h1 id="page-title">Newspaper List</h1>

    <form method="get" id="search-form" onsubmit="return false;">
        <label for="search-bar" id="search-label">Search:</label>
        <input type="text" id="search-bar" name="search-query" placeholder="Enter name">
    </form>

    <table border="1" cellpadding="10" id="newspaper-table">
        <thead>
            <tr id="table-header">
                <th id="header-name">Newspaper Name</th>
                <th id="header-price">Price (Taka)</th>
                <?php if ($_SESSION['user']['account_type'] == 'admin') { ?>
                    <th id="header-actions">Actions</th>
                <?php } ?>
                <?php if ($_SESSION['user']['account_type'] == 'advertiser') { ?>
                    <th id="header-actions">Select</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($newspapers as $newspaper) { ?>
                <tr class="table-row">
                    <td class="newspaper-name"><?= htmlspecialchars($newspaper['name']) ?></td>
                    <td class="newspaper-price"><?= htmlspecialchars($newspaper['price']) ?></td>
                    <?php if ($_SESSION['user']['account_type'] == 'admin') { ?>
                        <td class="newspaper-actions">
                            <a href="javascript:void(0)" onclick="deleteNewspaper(<?= $newspaper['id'] ?>)" class="delete-link">Delete</a> |
                            <a href="javascript:void(0)" onclick="editNewspaperForm(<?= $newspaper['id'] ?>)" class="edit-link">Edit</a>
                        </td>
                    <?php } ?>
                    <?php if ($_SESSION['user']['account_type'] == 'advertiser') { ?>
                        <td class="newspaper-actions">
                            <a href="createAd.php?newspaper=<?= urlencode($newspaper['name']) ?>&price=<?= urlencode($newspaper['price']) ?>" class="select-link">Select</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div id="action-links">
        <?php if ($_SESSION['user']['account_type'] == 'admin') { ?>
            <a href="add-newspaper.php" id="add-newspaper-link">Add New Newspaper</a> |
            <a href="home.php" id="home-link">Home</a>
        <?php } ?>
        <?php if ($_SESSION['user']['account_type'] == 'advertiser') { ?>
            <a href="home.php" id="advertiser-home-link">Home</a>
        <?php } ?>
    </div>
        </main>
        
    <?php includeBottomBar(); ?>
    <script src="../asset/edit-Newspaper.js"></script>
</body>
</html>
