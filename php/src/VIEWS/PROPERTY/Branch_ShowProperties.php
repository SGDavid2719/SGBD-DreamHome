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
        $lBranchNumber = $_SESSION['branchno'];
        $lCriteria = "WHERE branchno='$lBranchNumber'";
        $lDataArray = GetAllData('branchno, propertyno, street, city, postcode, type, rooms, rent', 'propertyforrent', $lCriteria);
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
                                        <input type="text" id="propertyno" class="d-none" name="propertyno" value=<?php echo $lRow['propertyno'] ?>>
                                        <input type="submit" value="More info" class="btn btn-secondary" name="branchQueryPropertyForm">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-10"></div>
                <div class="col-1">
                    <form action="../../PHP/Utilities.php" method="post">
                        <input type="text" id="branchno" class="d-none" name="branchno" value=<?=$_SESSION['branchno']?>>
                        <input type="submit" value="Add Property" class="btn btn-secondary" name="branchAddProperty">
                    </form> 
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>