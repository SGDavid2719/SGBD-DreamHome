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
        $pPropertyno = (isset($_SESSION['propertyno'])) ? $_SESSION['propertyno'] : 'EMPTY!!!';
        $lCriteria = " where propertyno='$pPropertyno'";
        $lData = GetData('propertyforrent', $lCriteria);
    ?>
    <section>
    <div class="container mt-5">
            <form action="../../utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">Property Number:</label><br>
                        <input type="text" id="fname" value=<?php echo $lData['propertyno'] ?> disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">Street:</label><br>
                        <input type="text" id="telno" name="telno" value=<?php echo $lData['street'] ?>><br>
                    </div>
                    <div class="col-6">
                        <label for="fname">City:</label><br>
                        <input type="text" id="telno" name="telno" value=<?php echo $lData['city'] ?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="lname">Postcode:</label><br>
                        <input type="text" id="preftype" name="preftype" value=<?php echo $lData['postcode'] ?>><br>
                    </div>
                    <div class="col-6">
                        <label for="fname">Type</label><br>
                        <input type="text" id="maxrent" name="maxrent" value=<?php echo $lData['type'] ?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Property info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="lname">Rooms:</label><br>
                        <input type="text" id="email" name="email" value=<?php echo $lData['rooms'] ?>><br>
                    </div>
                    <div class="col-6">
                        <label for="fname">Rent:</label><br>
                        <input type="text" id="password" name="password" value=<?php echo $lData['rent'] ?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-11"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-secondary">Return</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                <?php unset($_GET['propertyno']);?>
                                document.location.href = 'All_ReportProperty.php';
                            });
                        </script>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>