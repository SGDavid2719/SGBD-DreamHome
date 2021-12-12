<?php
    include_once('../ELEMENTS/head.php');
?>
</head>
<body>
    <?php
        include_once('../ELEMENTS/header.php');
    ?>
    <section>
        <div class="container">
            <h1>Welcome <?=$_SESSION['name']?></h1>
        </div>
    </section>
    <?php
        include_once('../ELEMENTS/footer.php');
    ?>
</body>
</html>