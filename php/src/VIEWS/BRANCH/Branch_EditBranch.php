<?php
    // Utilities
    include_once('../../PHP/Utilities.php');
    // Security handler
    CheckRolePermission("branch");
    // Head
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Views.css"/>
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        $lBranchNumber = $_SESSION['branchno'];
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lColumns = "branch.branchno, address.*";
        $lTable = "branch INNER JOIN address ON branch.addressno = address.addressno";
        $lCriteria = "WHERE branchno='$lBranchNumber' AND branch.securityclass<=$lRoleSecurityClass";
        $lData = GetData($lColumns, $lTable, $lCriteria);
        $_SESSION['addressno'] = $lData['addressno'];
        // Value handler
        $lStreet = $lData['street'];
        $lPostcode = $lData['postcode'];
    ?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Internal info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="contractno">Branch Number:</label><br>
                        <input type="text" id="contractno" value=<?=$lData['branchno']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="addressno">Address Number:</label><br>
                        <input type="text" id="addressno" name="" value=<?=$lData['addressno']?> class="form-control" readonly><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Address info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="street">Street:</label><br>
                        <input type="text" id="street" name="street" value=<?="'$lStreet'"?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" name="city" value=<?=$lData['city']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" name="postcode" value=<?="'$lPostcode'"?> class="form-control"><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-1 d-flex justify-content-center">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'All_ListBranches.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitBranchEdition">
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