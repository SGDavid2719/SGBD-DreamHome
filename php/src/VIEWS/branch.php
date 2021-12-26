<?php
    include_once('../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../CSS/branch.css" />
</head>
<body>
    <?php
        include_once('../ELEMENTS/header.php');
        include_once('../utilities.php');
        $lBranchData = GetData('branch');
    ?>
    <section>
        <header>
            <div class="row m-5 p-2 headerRow">
                <h1>Branch number <?php echo $lBranchData[0] ?></h1>
            </div>
        </header>
        <div class="container mt-5">
            <div class="row containerRow">
                <div class="col-md-4 m-1 infoField">
                    <h5>Street<h5><br>
                    <p><?php echo $lBranchData[1] ?></p>
                </div>
                <div class="col-md-4 m-1 infoField">
                    <h5>City<h5><br>
                    <p><?php echo $lBranchData[2] ?></p>
                </div>
                <div class="col-md-4 m-1 infoField">
                    <h5>Postcode<h5><br>
                    <p><?php echo $lBranchData[3] ?></p>
                </div>
            </div>         
        </div>
    </section>
    <?php
        include_once('../ELEMENTS/footer.php');
    ?>
</body>
</html>