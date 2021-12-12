<?php
    include_once('../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../CSS/branch.css" />
</head>
<body>
    <?php
        include_once('../ELEMENTS/header.php');
    ?>
    <section>
        <header>
            <div class="m-5 p-2">
                <h1>Branch number X</h1>
            </div>
        </header>
        <div class="container mt-5">
            <div class="col-md-6">
                <article>
                    <div>
                        <h1>Manager number <?=$_SESSION['name']?></h1>
                        <h1>City</h1>
                        <h1>Street</h1>
                        <h1>Postcode</h1>
                    </div>
                </article>
            </div>
            <div class="col-md-6">
                <aside>
                    <img src="../IMG/dream-home.png" alt="DreamHome Logo" class="">
                </aside>
            </div>            
        </div>
    </section>
    <?php
        include_once('../ELEMENTS/footer.php');
    ?>
</body>
</html>