<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/PROPERTY/Property.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../PHP/Utilities.php');
        $lColumns = "owner.ownerno, owner.fname, owner.lname, owner.address, owner.telno, owner.email";
        $lTables = "owner";
        $lCriteria = "";
        $lDataArray = GetAllData($lColumns, $lTables, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
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
                                        <input type="text" id="ownerno" class="d-none" name="ownerno" value=<?=$lRow['ownerno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editOwnerInfo_ALL">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-10"></div>
                <div class="col-2 d-flex justify-content-end">
                    <form action="../../PHP/Utilities.php" method="post">
                        <input type="submit" value="Show Branch Owners" class="btn btn-secondary" name="showBranchOwners_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>

    <?php

    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') {
        echo '<style>#ReturnBtn { display:none;}</style>';
    } 

    ?>

    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>