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
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lColumns = "staff.staffno, staff.fname, staff.lname, staff.branchno, staff.position";
        $lTables = "staff";
        $lCriteria = "WHERE staff.branchno='$lBranchNumber' AND staff.securityclass<=$lRoleSecurityClass";
        $lDataArray = GetAllData($lColumns, $lTables, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <div class="row">
                <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            </div>
            <div class="row">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col"><?php echo implode('</th><th scope="col">', array_keys(current($lDataArray))); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lDataArray as $lRow): array_map('htmlentities', $lRow); ?>
                            <tr>
                                <td><?php echo implode('</td><td>', $lRow); ?></td>
                                <td>
                                    <form action="../../PHP/Utilities.php" method="post">
                                        <input type="text" id="staffno" class="d-none" name="staffno" value=<?=$lRow['staffno']?>>
                                        <input type="submit" value="More info" class="btn btn-secondary" name="showStaffInfo_BRANCH">
                                    </form>
                                </td>
                                <td>
                                    <form id="editStaff" action="../../PHP/Utilities.php" method="post">
                                        <input type="text" id="staffno" class="d-none" name="staffno" value=<?=$lRow['staffno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editStaffInfo_BRANCH">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-2 d-flex justify-content-end">
                    <button id='ReturnBtn' type="button" class="btn btn-secondary">Return</button>
                    <script>
                        var lBtn = document.getElementById('ReturnBtn');
                        lBtn.addEventListener('click', function() {
                            document.location.href = 'All_ListStaff.php';
                        });
                    </script>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <form action="../../PHP/Utilities.php" method="post">
                        <input type="submit" value="Add Staff" class="btn btn-secondary" name="addStaff_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>    

    <?php

    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') {
        echo '<style>#ReturnBtn { display:none;}</style>';
        echo '<style>#editStaff { display:none;}</style>';
    } 

    ?>
    
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>