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
        $lCriteria = "WHERE branchno='$lBranchNumber'";
        $lPropertiesArray = GetAllData('propertyno', 'propertyforrent', $lCriteria);
        $lDataArray = array();
        foreach(array_keys($lPropertiesArray) as $lKey) {
            $lPropertyNumber = $lPropertiesArray[$lKey]['propertyno'];
            $lCriteria = "WHERE propertyno='$lPropertyNumber'";
            $lData = GetAllData('*', 'viewing', $lCriteria);
            if ($lData != null) array_push($lDataArray, $lData[0]);
        }
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