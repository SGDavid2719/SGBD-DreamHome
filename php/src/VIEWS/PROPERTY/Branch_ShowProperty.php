<?php
    // Utilities
    include_once('../../PHP/Utilities.php');
    // Security handler
    CheckRolePermission("propertyforrent");
    // Head
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Views.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lBranchNumber = $_SESSION['branchno'];
        $pPropertyno = $_SESSION['propertyno'];
        $lColumns = "p.propertyno, p.type, p.rooms, p.rent, a.city, a.postcode, a.street";
        $lTables = "staff s, propertyforrent p, address a";
        $lCriteria = "WHERE p.addressno = a.addressno AND p.propertyno='$pPropertyno' AND p.securityclass<=$lRoleSecurityClass";
        $lData = GetData($lColumns, $lTables, $lCriteria);
        // Value handler
        $lStreet = $lData['street'];
        $lPostcode = $lData['postcode'];
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
                        <input type="text" id="street" name="street" value=<?="'$lStreet'"?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" name="city" value=<?=$lData['city']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" name="postcode" value=<?="'$lPostcode'"?> class="form-control" disabled><br>
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
                            var lAll_Or_Branch = '<?php echo $_SESSION['all_or_branch']; ?>';
                            <?php unset($_SESSION['all_or_branch']);?>
                            lBtn.addEventListener('click', function() {
                                <?php unset($_SESSION['propertyno']);?>
                                if (lAll_Or_Branch === 'showPropertyInfo_BRANCH') document.location.href = 'Branch_ListProperties.php';
                                else document.location.href = 'All_ListProperties.php';
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