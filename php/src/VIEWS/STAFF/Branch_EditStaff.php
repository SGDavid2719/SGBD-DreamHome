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
        $lStaffNumber = $_SESSION['staffno'];
        $lColumns = "staff.*";
        $lTable = "staff";
        $lCriteria = "WHERE staff.staffno='$lStaffNumber' AND staff.securityclass<=$lRoleSecurityClass";
        $lData = GetData($lColumns, $lTable, $lCriteria);
        // Array of branches
        $lColumns = 'branch.branchno';
        $lTable = 'branch';
        $lCriteria = '';
        $lBranchArrayData = GetAllData($lColumns, $lTable, $lCriteria);
        // Array of positions
        $lColumns = 'DISTINCT staff.position';
        $lTable = 'staff';
        $lCriteria = "WHERE staff.securityclass<=$lRoleSecurityClass";
        $lPositionArrayData = GetAllData($lColumns, $lTable, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Internal info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="staffno">Staff Number:</label><br>
                        <input type="text" id="staffno" name="staffno" value=<?=$lData['staffno']?> class="form-control" readonly><br>
                    </div>
                    <div class="col-6">
                        <label for="branchno">Branch Number:</label><br>
                        <select type="text" id="branchno" name="branchno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lBranchArrayData) as $lRow) {
                                if($lBranchArrayData[$lRow]['branchno'] == $lData['branchno']) {
                                    echo '<option value=' . $lBranchArrayData[$lRow]['branchno'] . ' selected>' . $lBranchArrayData[$lRow]['branchno'] . '</option>';
                                } else {
                                    echo '<option value=' . $lBranchArrayData[$lRow]['branchno'] . '>' . $lBranchArrayData[$lRow]['branchno'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Staff info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" name="fname" value=<?=$lData['fname']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" name="lname" value=<?=$lData['lname']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                <div class="col-6">
                        <label for="position">Position:</label><br>
                        <select type="text" id="position" name="position" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lPositionArrayData) as $lRow) {
                                if($lPositionArrayData[$lRow]['position'] == $lData['position']) {
                                    echo '<option value=' . $lPositionArrayData[$lRow]['position'] . ' selected>' . $lPositionArrayData[$lRow]['position'] . '</option>';
                                } else {
                                    echo '<option value=' . $lPositionArrayData[$lRow]['position'] . '>' . $lPositionArrayData[$lRow]['position'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="salary">Salary:</label><br>
                        <input type="text" id="salary" name="salary" value=<?=$lData['salary']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="sex">Sex:</label><br>
                        <input type="text" id="sex" name="sex" value=<?=$lData['sex']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="dob">Date of birth:</label><br>
                        <input type="date" id="dob" name="dob" value=<?=$lData['dob']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" value=<?=$lData['email']?> class="form-control"><br>
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
                                document.location.href = 'Branch_ListStaff.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitStaffEdition">
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