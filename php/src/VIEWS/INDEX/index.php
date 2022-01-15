<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/index.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        include_once('../../PHP/Utilities.php');
        $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';
        $lData = GetData('*', $lTable, "");
        //DELETE
        print_r($_SESSION);
    ?>
    <section>
        <div class="container mt-5">
            <header>
                <div class="row rowHeader">
                    <img src="../../IMG/dream-home.png" alt="DreamHome Logo" id="profileIMG">
                </div>  
                <div class="row mt-2">
                    <h1>Welcome, <?=$_SESSION['fname']?> <?=$_SESSION['lname']?></h1>
                </div>                
            </header>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>