<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/CLIENT/AllQueryClient.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../utilities.php');
        $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';
        $lEmail = $_SESSION['email'];
        $lCriteria = " where email='$lEmail'";
        $lData = GetData($lTable, $lCriteria);
    ?>
    <section>
        <header>
            <div class="row m-5 p-2 headerRow">
                <div class="col-8">
                    <h1>Client name: <?php echo $lData['fname'] . " " . $lData['lname'] ?></h1>
                </div>
                <div class="col-3"></div>
                <div class="col-1 d-flex justify-content-end">
                    <a href="allMaintainClient.php" class="btn btn-secondary button">Edit</a>
                </div>
            </div>
        </header>
        <div class="container mt-5">
            <div class="row containerRow m-1">
                <div class="col-2"></div>
                <div class="col-8 infoField">
                    <h4>Telephone number:<h4><br>
                    <p><?php echo $lData['telno'] ?></p>
                </div>
                <div class="col-2"></div>
            </div>       
            <div class="row containerRow m-1">
                <div class="col-2"></div>
                <div class="col-8 infoField">
                    <h4>Preftype:<h4><br>
                    <p><?php echo $lData['preftype'] ?></p>
                </div>
                <div class="col-2"></div>
            </div>       
            <div class="row containerRow m-1">
                <div class="col-2"></div>
                <div class="col-8 infoField">
                    <h4>Max rent<h4><br>
                    <p><?php echo $lData['maxrent'] ?></p>
                </div>
                <div class="col-2"></div>
            </div>    
            <div class="row containerRow m-1">
                <div class="col-2"></div>
                <div class="col-8 infoField">
                    <h4>Email<h4><br>
                    <p><?php echo $lData['email'] ?></p>
                </div>
                <div class="col-2"></div>
            </div>    
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>