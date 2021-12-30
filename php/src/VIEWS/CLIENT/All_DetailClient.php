<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/CLIENT/Query.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../PHP/Utilities.php');
        $lColumns = "*";
        $lTable = ($_SESSION['role'] == 'Client') ? "client" : "staff";
        $lRoleNumber = $_SESSION['roleno'];
        $lCriteria = ($_SESSION['role'] == 'Client') ? "WHERE clientno='$lRoleNumber'" : "WHERE staffno='$lRoleNumber'";
        $lData = GetData($lColumns, $lTable, $lCriteria);
    ?>
    <section>
        <div class="container">
            <header>
                <div class="row m-5 p-2 headerRow">
                    <div class="col-8">
                        <h1>Client name: <?=$lData['fname'] . " " . $lData['lname']?></h1>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <a href="All_EditClient.php" class="btn btn-secondary button">Edit</a>
                    </div>
                </div>
            </header>
            <div class="row containerRow m-1">
                <div class="col infoField">
                    <h3>Telephone number:</h3>
                    <p><?=$lData['telno']?></p>
                </div>
            </div>       
            <div class="row containerRow m-1">
                <div class="col infoField">
                    <h3>Preftype:</h3>
                    <p><?=$lData['preftype']?></p>
                </div>
            </div>       
            <div class="row containerRow m-1">
                <div class="col infoField">
                    <h3>Max rent</h3>
                    <p><?=$lData['maxrent']?></p>
                </div>
            </div>    
            <div class="row containerRow m-1">
                <div class="col infoField">
                    <h3>Email</h3>
                    <p><?=$lData['email']?></p>
                </div>
            </div>    
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>