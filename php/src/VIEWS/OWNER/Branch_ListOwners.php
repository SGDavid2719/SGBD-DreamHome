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
        $lBranchNumber = $_SESSION['branchno'];
        $lColumns = "DISTINCT owner.ownerno, owner.fname, owner.lname, owner.address, owner.telno, owner.email";
        $lTable = "owner";
        $lCriteria = "INNER JOIN propertyforrent ON owner.ownerno = propertyforrent.ownerno INNER JOIN staff ON propertyforrent.staffno = staff.staffno WHERE staff.branchno = '$lBranchNumber '";
        $lDataArray = GetAllData($lColumns, $lTable, $lCriteria);
        // Clear session data
        if (isset($_SESSION['ownerno'])) unset($_SESSION['ownerno']);
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
                                <form id="editOwner" action="../OWNER/Branch_EditOwner.php" method="post">
                                    <input type="text" id="ownerno" class="d-none" name="ownerno" value=<?=$lRow['ownerno']?>>
                                    <input type="submit" value="Edit" class="btn btn-primary" name="editOwnerInfo_BRANCH">
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
                        document.location.href = 'All_ListOwners.php';
                    });
                </script>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <form id="addOwner" action="../../PHP/Utilities.php" method="post">
                    <input type="submit" value="Add Owner" class="btn btn-secondary" name="addOwner_BRANCH">
                </form> 
            </div>
        </div>
    </section>

    <?php
    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') 
    {
        echo '<style>#ReturnBtn { display:none;}</style>';
        echo '<style>#addOwner { display:none;}</style>';
        if ($_SESSION['role'] != 'Supervisor') echo '<style>#editOwner { display:none;}</style>';
    } 
    ?>
    
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>