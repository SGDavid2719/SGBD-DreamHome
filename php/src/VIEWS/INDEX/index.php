<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Index.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        include_once('../../PHP/Utilities.php');
        $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';
        $lData = GetData('*', $lTable, "");
        // Branch handler
        unset($_SESSION['addressno']);
    ?>
    <div class="container mt-5">
        <div class="row mt-2">
            <div class="col-lg-12 d-flex justify-content-center align-self-center">
                <h1>Welcome, <?=$_SESSION['fname']?> <?=$_SESSION['lname']?></h1>
            </div>
            <div class="col-lg-12 d-flex justify-content-center align-self-center">
                <i class="fas fa-home icon"></i>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <h1>DreamHome</h1>
            </div>
        </div>
    </div>
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>