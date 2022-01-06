<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/PROPERTY/Property.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        include_once('../../PHP/Utilities.php');
        $lBranchNumber = $_SESSION['branchno'];
        $pPropertyno = $_SESSION['propertyno'];
        $lColumns = "p.propertyno, p.type, p.rooms, p.rent, a.city, a.postcode, a.street";
        $lTables = "staff s, propertyforrent p, address a";
        $lCriteria = "WHERE s.staffno = p.staffno AND p.addressno = a.addressno AND s.branchno='$lBranchNumber' AND p.propertyno='$pPropertyno'";
        $lData = GetData($lColumns, $lTables, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <input type="text" id="propertyno" value=<?=$lData['propertyno']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="street">Street:</label><br>
                        <input type="text" id="street" name="street" value=<?=$lData['street']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" name="city" value=<?=$lData['city']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" name="postcode" value=<?=$lData['postcode']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="type">Type</label><br>
                        <input type="text" id="type" name="type" value=<?=$lData['type']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Property info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="rooms">Rooms:</label><br>
                        <input type="text" id="rooms" name="rooms" value=<?=$lData['rooms']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="rent">Rent:</label><br>
                        <input type="text" id="rent" name="rent" value=<?=$lData['rent']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-11"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-secondary">Return</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                <?php unset($_SESSION['propertyno']);?>
                                document.location.href = 'Branch_ListProperties.php';
                            });
                        </script>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>