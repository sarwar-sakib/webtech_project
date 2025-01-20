<?php
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        session_start();
        unset($_SESSION['status']);
        //session_destroy();

        setcookie('status', 'true', time() - 10, '/');
        header('location: ../view/landingpage.html');
        exit;
    }
?>

<script>
    if (confirm("Are you sure you want to log out?")) {
        window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>?confirm=yes";
    } else {
        window.history.back();
    }
</script>
