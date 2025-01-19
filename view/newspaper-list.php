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
    <script src="../asset/edit-Newspaper.js"></script>
</body>
</html>
