<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/PROPERTY/Property.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../PHP/Utilities.php');
        $pPropertyno = (isset($_SESSION['propertyno'])) ? $_SESSION['propertyno'] : 'EMPTY!!!';
        $lColumns = "p.propertyno, p.type, p.rooms, p.rent, a.city, a.postcode, a.street";
        $lTables = "propertyforrent p, address a";
        $lCriteria = "WHERE p.addressno = a.addressno AND p.propertyno='$pPropertyno'";
        $lData = GetData($lColumns, $lTables, $lCriteria);
    ?>
    <section>
    <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <input type="text" id="propertyno" value=<?=$lData['propertyno']?> disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="street">Street:</label><br>
                        <input type="text" id="street" name="street" value=<?=$lData['street']?> disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" name="city" value=<?=$lData['city']?> disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" name="postcode" value=<?=$lData['postcode']?> disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="type">Type</label><br>
                        <input type="text" id="type" name="type" value=<?=$lData['type']?> disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Property info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="rooms">Rooms:</label><br>
                        <input type="text" id="rooms" name="rooms" value=<?=$lData['rooms']?> disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="rent">Rent:</label><br>
                        <input type="text" id="rent" name="rent" value=<?=$lData['rent']?> disabled><br>
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
                                <?php unset($_SESSION['propertyno']);?>
                                document.location.href = 'All_ListProperties.php';
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