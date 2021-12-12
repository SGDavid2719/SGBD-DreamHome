<?php
    session_start();
    if(empty($_SESSION['name'])):
        header('Location:login.php');
    endif;
?>

<?php
    include_once('ELEMENTS/head.php');
?>
<body>
    <?php
        include_once('ELEMENTS/header.php');
    ?>
    <section>
        <div class="container">
            <h1>Welcome <?=$_SESSION['name']?></h1>
        </div>
    </section>
    <?php
        include_once('ELEMENTS/footer.php');
    ?>
</body>
</html>