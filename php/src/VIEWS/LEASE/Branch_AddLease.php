<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/VIEWING/Viewing.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../PHP/Utilities.php');
        $lBranchNumber = $_SESSION['branchno'];
        // Client numbers
        $lColumns = 'client.clientno';
        $lTable = 'client';
        $lCriteria = '';
        $lClientArrayData = GetAllData($lColumns, $lTable, $lCriteria);
        // Properties
        $lColumns = 'propertyforrent.propertyno';
        $lTable = 'propertyforrent INNER JOIN staff ON propertyforrent.staffno = staff.staffno';
        $lCriteria = "WHERE staff.branchno = '$lBranchNumber'";
        $lPropertyArrayData = GetAllData($lColumns, $lTable, $lCriteria);
        // Pay mode
        $lColumns = 'DISTINCT contract.paymode';
        $lTable = 'contract';
        $lCriteria = "";
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
                        <input type="text" id="contractno" name="contractno" class="form-control"><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="clientno">Client Number:</label><br>
                        <select type="text" id="clientno" name="clientno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lClientArrayData) as $lRow) {
                                echo '<option value=' . $lClientArrayData[$lRow]['clientno'] . '>' . $lClientArrayData[$lRow]['clientno'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <select type="text" id="propertyno" name="propertyno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lPropertyArrayData) as $lRow) {
                                echo '<option value=' . $lPropertyArrayData[$lRow]['propertyno'] . '>' . $lPropertyArrayData[$lRow]['propertyno'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Contract info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="startdate">Start date:</label><br>
                        <input type="date" id="startdate" name="startdate" class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="enddate">End date:</label><br>
                        <input type="date" id="enddate" name="enddate" class="form-control"><br>
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
                        <input type="text" id="depositpaid" name="depositpaid" class="form-control"><br>
                    </div>
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
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitAddLease_BRANCH">
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