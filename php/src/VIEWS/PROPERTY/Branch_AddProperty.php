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
        $lColumns = "owner.ownerno";
        $lTable = "owner";
        $lCriteria = "WHERE owner.securityclass<=$lRoleSecurityClass";
        $lOwnerArrayData = GetAllData($lColumns, $lTable, $lCriteria);
        // Property types
        $lPropertyTypes = array("Flat", "House");
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="branchno">Branch Number:</label><br>
                        <input type="text" id="branchno" name="branchno" value=<?=$_SESSION['branchno']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="staffno">Staff Number:</label><br>
                        <input type="text" id="staffno" name="staffno" value=<?=$_SESSION['roleno']?> class="form-control" readonly><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <input type="text" id="propertyno" name="propertyno" maxlength="4" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="propertyno">Owner Number:</label><br>
                        <select type="text" id="ownerno" name="ownerno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lOwnerArrayData) as $lRow) 
                            {
                                $lAuxValue = $lOwnerArrayData[$lRow]['ownerno'];
                                if ($lOwnerArrayData[$lRow]['ownerno'] == $lData['ownerno']) echo '<option value=' . "$lAuxValue" . ' selected>' . $lOwnerArrayData[$lRow]['ownerno'] . '</option>';
                                else echo '<option value=' . "$lAuxValue" . '>' . $lOwnerArrayData[$lRow]['ownerno'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="addressno">Address Number:</label><br>
                        <input type="text" id="addressno" name="addressno" maxlength="3" class="form-control" required><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="street">Street:</label><br>
                        <input type="text" id="street" name="street" maxlength="35" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" name="city" maxlength="10" class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" name="postcode" maxlength="10" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="type">Type</label><br>
                        <select type="text" id="type" name="type" class="form-select form-select-sm" required>
                            <?php 
                            foreach ($lPropertyTypes as $lRow) 
                            {
                                echo '<option value=' . "$lRow" . '>' . $lRow . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Property info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="rooms">Rooms:</label><br>
                        <input type="text" id="rooms" name="rooms" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="rent">Rent:</label><br>
                        <input type="text" id="rent" name="rent" class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                <?php unset($_GET['propertyno']);?>
                                document.location.href = 'Branch_ListProperties.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-primary" name="submitAddProperty_BRANCH">
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