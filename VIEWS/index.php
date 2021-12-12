<?php
    include_once('../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../CSS/index.css" />
</head>
<body>
    <?php
        include_once('../ELEMENTS/header.php');
    ?>
    <section>
        <div class="container mt-5">
            <header>
                <div class="row rowHeader">
                    <img src="../IMG/dream-home.png" alt="DreamHome Logo" id="profileIMG">
                    
                </div>  
                <div class="row mt-2">
                    <h1>Welcome, <?=$_SESSION['name']?></h1>
                </div>                
            </header>
        </div>
    </section>
    <?php
        include_once('../ELEMENTS/footer.php');
    ?>
</body>
</html>