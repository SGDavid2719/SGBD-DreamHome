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
        $lColumns = "viewing.viewingno, viewing.viewdate, viewing.comment, propertyforrent.type, propertyforrent.rooms, propertyforrent.rent";
        $lTable = "viewing INNER JOIN propertyforrent ON viewing.propertyno = propertyforrent.propertyno INNER JOIN staff ON propertyforrent.staffno = staff.staffno";
        $lCriteria = "WHERE staff.branchno = '$lBranchNumber '";
        $lDataArray = GetAllData($lColumns, $lTable, $lCriteria);
        // Clear posted data 
        if(isset($_SESSION['viewingno'])) unset($_SESSION['viewingno']);
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
                                        <input type="text" id="viewingno" class="d-none" name="viewingno" value=<?=$lRow['viewingno'] ?> class="form-control" >
                                        <input type="submit" value="More info" class="btn btn-secondary" name="showViewingInfo_BRANCH">
                                    </form>
                                </td>
                                <td>
                                    <form action="../../PHP/Utilities.php" method="post">
                                        <input type="text" id="viewingno" class="d-none" name="viewingno" value=<?=$lRow['viewingno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editViewingInfo_BRANCH">
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
                        <input type="submit" value="Add View" class="btn btn-secondary" name="addView_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>