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
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lBranchNumber = $_SESSION['branchno'];
        $pPropertyno = $_SESSION['propertyno'];
        /* Fetch property data */
        $lColumns = "p.propertyno, p.ownerno, p.type, p.rooms, p.rent, a.city, a.postcode, a.street";
        $lTables = "staff s, propertyforrent p, address a";
        $lCriteria = "WHERE p.addressno = a.addressno AND p.propertyno='$pPropertyno' AND p.securityclass<=$lRoleSecurityClass";
        $lData = GetData($lColumns, $lTables, $lCriteria);
        /* Fetch owners */
        $lColumns = 'owner.ownerno';
        $lTable = 'owner';
        $lCriteria = '';
        $lOwnerArrayData = GetAllData($lColumns, $lTable, $lCriteria);
        // Property types
        $lPropertyTypes = array("Flat", "House");
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
                        <input type="text" id="propertyno" name="propertyno" value=<?=$lData['propertyno']?> class="form-control" readonly><br>
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
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="street">Street:</label><br>
                        <input type="text" id="street"value=<?="'$lStreet'"?> maxlength="35" class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" value=<?=$lData['city']?> maxlength="10" class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" value=<?="'$lPostcode'"?> maxlength="10" class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="type">Type</label><br>
                        <select type="text" id="type" name="type" class="form-select form-select-sm" required>
                            <?php 
                            foreach ($lPropertyTypes as $lRow) 
                            {
                                if ($lRow == $lData['type']) echo '<option value=' . "$lRow" . ' selected>' . $lRow . '</option>';
                                else echo '<option value=' . "$lRow" . '>' . $lRow . '</option>';
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
                        <input type="text" id="rooms" name="rooms" value=<?=$lData['rooms']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="rent">Rent:</label><br>
                        <input type="text" id="rent" name="rent" value=<?=$lData['rent']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-secondary">Return</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            var lAll_Or_Branch = '<?php echo $_SESSION['all_or_branch']; ?>';
                            <?php unset($_SESSION['all_or_branch']);?>
                            lBtn.addEventListener('click', function() {
                                <?php unset($_SESSION['propertyno']);?>
                                if (lAll_Or_Branch === 'editPropertyInfo_ALL') document.location.href = 'All_ListProperties.php';
                                else document.location.href = 'Branch_ListProperties.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitPropertyEdition">
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