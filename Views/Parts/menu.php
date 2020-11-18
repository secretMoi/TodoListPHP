<div class="btn-group">
    <?php if($_SESSION['Role'] == 2) require_once 'MenuSelonRole/menuClient.php';
    if($_SESSION['Role'] == 3)
    {
        require_once 'MenuSelonRole/menuClient.php';
        require_once 'MenuSelonRole/menuTravailleur.php';
    }
    if($_SESSION['Role'] == 1) {
        require_once 'MenuSelonRole/menuClient.php';
        require_once 'MenuSelonRole/menuTravailleur.php';
        require_once 'MenuSelonRole/menuAdmin.php';
    }
    ?>

</div>