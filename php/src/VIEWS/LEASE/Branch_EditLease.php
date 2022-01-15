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
        $lContractNumber = $_SESSION['contractno'];
        $lColumns = "contract.contractno, contract.clientno, contract.propertyno, contract.startdate, contract.enddate, contract.paymode, contract.depositpaid, propertyforrent.propertyno, propertyforrent.type, propertyforrent.rooms, propertyforrent.rent, client.fname, client.lname, client.email";
        $lTable = "contract INNER JOIN propertyforrent ON contract.propertyno = propertyforrent.propertyno INNER JOIN client ON contract.clientno = client.clientno";
        $lCriteria = "WHERE contract.contractno='$lContractNumber' AND contract.securityclass<=$lRoleSecurityClass";
        $lData = GetData($lColumns, $lTable, $lCriteria);
        // Pay mode
        $lColumns = 'DISTINCT contract.paymode';
        $lTable = 'contract';
        $lCriteria = "WHERE contract.securityclass<=$lRoleSecurityClass";
        $lPayModeArrayData = GetAllData($lColumns, $lTable, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Internal info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="contractno">Contract Number:</label><br>
                        <input type="text" id="contractno" name="contractno" value=<?=$lData['contractno']?> class="form-control" readonly><br>
                    </div>
                    <div class="col-6">
                        <label for="clientno">Client Number:</label><br>
                        <input type="text" id="clientno" value=<?=$lData['clientno']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Contract info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="startdate">Start date:</label><br>
                        <input type="date" id="startdate" name="startdate" value=<?=$lData['startdate']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="enddate">End date:</label><br>
                        <input type="date" id="enddate" name="enddate" value=<?=$lData['enddate']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="paymode">Pay mode:</label><br>
                        <select type="text" id="paymode" name="paymode" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lPayModeArrayData) as $lRow) {
                                echo '<option value=' . $lPayModeArrayData[$lRow]['paymode'] . '>' . $lPayModeArrayData[$lRow]['paymode'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="rooms">Deposit paid:</label><br>
                        <input type="text" id="depositpaid" name="depositpaid" value=<?=$lData['depositpaid']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Property info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <input type="text" id="propertyno" value=<?=$lData['propertyno']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="type">Type:</label><br>
                        <input type="text" id="type" value=<?=$lData['type']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="rent">Rent:</label><br>
                        <input type="text" id="rent" value=<?=$lData['rent']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="rooms">Rooms:</label><br>
                        <input type="text" id="rooms" value=<?=$lData['rooms']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Owner info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" value=<?=$lData['fname']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" value=<?=$lData['lname']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Contact info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" value=<?=$lData['email']?> class="form-control" disabled><br>
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
                                document.location.href = 'Branch_ListLeases.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitLeaseEdition">
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