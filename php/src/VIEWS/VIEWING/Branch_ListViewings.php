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
        $lColumns = "viewing.viewingno, viewing.viewdate, viewing.comment, propertyforrent.type, propertyforrent.rooms, propertyforrent.rent";
        $lTable = "viewing INNER JOIN propertyforrent ON viewing.propertyno = propertyforrent.propertyno INNER JOIN staff ON propertyforrent.staffno = staff.staffno";
        $lCriteria = "WHERE staff.branchno = '$lBranchNumber '";
        $lDataArray = GetAllData($lColumns, $lTable, $lCriteria);
        //
        if(isset($_SESSION['viewingno'])) unset($_SESSION['viewingno']);
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
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
                                    <input type="text" id="viewdate" class="d-none" value=<?=$lRow['viewdate'] ?> class="form-control" >
                                    <input type="text" id="comment" class="d-none" value=<?=$lRow['comment'] ?> class="form-control" >
                                    <input type="submit" value="More info" class="btn btn-secondary" name="showViewingInfo_BRANCH">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>