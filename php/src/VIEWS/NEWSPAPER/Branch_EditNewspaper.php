<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/VIEWING/Viewing.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        include_once('../../PHP/Utilities.php');
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lNewspaperNumber = $_SESSION['newspaperno'];
        unset($_SESSION['newspaperno']);
        // Newspaper data
        $lColumns = "*";
        $lTable = "newspaper";
        $lCriteria = "WHERE newspaperno='$lNewspaperNumber' AND newspaper.securityclass<=$lRoleSecurityClass";
        $lData = GetData($lColumns, $lTable, $lCriteria);
        // Array of addresses
        $lColumns = 'DISTINCT address.addressno';
        $lTable = 'address';
        $lCriteria = "WHERE address.securityclass<=$lRoleSecurityClass";
        $lAddressesArrayData = GetAllData($lColumns, $lTable, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Internal info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="newspaperno">Newspaper Number:</label><br>
                        <input type="text" id="newspaperno" name="newspaperno" value=<?=$lData['newspaperno']?> class="form-control" readonly><br>
                    </div>
                    <div class="col-6">
                        <label for="branchno">Address Number:</label><br>
                        <select type="text" id="addressno" name="addressno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lAddressesArrayData) as $lRow) {
                                if($lAddressesArrayData[$lRow]['addressno'] == $lData['addressno']) {
                                    echo '<option value=' . $lAddressesArrayData[$lRow]['addressno'] . ' selected>' . $lAddressesArrayData[$lRow]['addressno'] . '</option>';
                                } else {
                                    echo '<option value=' . $lAddressesArrayData[$lRow]['addressno'] . '>' . $lAddressesArrayData[$lRow]['addressno'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Newspaper info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name" value=<?=$lData['name']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="telephone">Telephone:</label><br>
                        <input type="text" id="telephone" name="telephone" value=<?=$lData['telephone']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Contact info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="contactfname">Contact first name:</label><br>
                        <input type="text" id="contactfname" name="contactfname" value=<?=$lData['contactfname']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="contactlname">Contact last name:</label><br>
                        <input type="text" id="contactlname" name="contactlname" value=<?=$lData['contactlname']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-1 d-flex justify-content-center">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'All_ListNewspapers.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitNewspaperEdition">
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