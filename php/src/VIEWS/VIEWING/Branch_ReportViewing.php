<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/VIEWING/Viewing.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../utilities.php');
        $lBranchNumber = $_SESSION['branchno'];
        $lColumns = "DISTINCT viewing.propertyno, viewing.clientno, viewing.viewdate, viewing.comment";
        $lTable = "staff";
        $lCriteria = "RIGHT JOIN propertyforrent ON staff.branchno = propertyforrent.branchno RIGHT JOIN viewing ON propertyforrent.propertyno = viewing.propertyno WHERE staff.branchno = '$lBranchNumber'";
        $lDataArray = GetAllData($lColumns, $lTable, $lCriteria);
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
                                <form action="../../utilities.php" method="post">
                                    <input type="text" id="clientno" class="d-none" name="clientno" value=<?php echo $lRow['clientno'] ?>>
                                    <input type="text" id="propertyno" class="d-none" name="propertyno" value=<?php echo $lRow['propertyno'] ?>>
                                    <input type="text" id="viewdate" class="d-none" name="viewdate" value=<?php echo $lRow['viewdate'] ?>>
                                    <input type="text" id="comment" class="d-none" name="comment" value=<?php echo $lRow['comment'] ?>>
                                    <input type="submit" value="More info" class="btn btn-secondary" name="branchQueryPropertyViewingForm">
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