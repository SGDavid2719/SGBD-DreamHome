<?php
    // Utilities
    include_once('../../PHP/Utilities.php');
    // Security handler
    CheckRolePermission("staff");
    // Head
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Views.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        $lBranchNumber = $_SESSION['branchno'];
        $pStaffNumber = $_SESSION['staffno'];
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lColumns = "*";
        $lTables = "staff";
        $lCriteria = "WHERE staff.branchno='$lBranchNumber ' AND staff.staffno='$pStaffNumber ' AND staff.securityclass<=$lRoleSecurityClass";
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
                        <label for="staffno">Staff Number:</label><br>
                        <input type="text" id="staffno" value=<?=$lData['staffno']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="position">Staff Position:</label><br>
                        <input type="text" id="position" value=<?=$lData['position']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" name="fname" value=<?=$lData['fname']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" name="lname" value=<?=$lData['lname']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="sex">Sex:</label><br>
                        <input type="text" id="sex" name="sex" value=<?=$lData['sex']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="dob">Date of Birth:</label><br>
                        <input type="date" id="dob" name="dob" value=<?=$lData['dob']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="salary">Salary:</label><br>
                        <input type="text" id="salary" name="salary" value=<?=$lData['salary'] . ' €'?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Account info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" value=<?=$lData['email']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-11"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-secondary">Return</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                <?php unset($_SESSION['staffno']);?>
                                document.location.href = 'Branch_ListStaff.php';
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