<?php
    include_once('../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../CSS/index.css" />
</head>
<body>
    <?php
        include_once('../ELEMENTS/header.php');
        include_once('../utilities.php');
        $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';
        //$lData = GetData($lTable, "");
    ?>
    <section>
        <div class="container mt-5">
            
        </div>
    </section>
    <?php
        include_once('../ELEMENTS/footer.php');
    ?>
</body>
</html>