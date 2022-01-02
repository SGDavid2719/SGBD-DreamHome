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
        $lColumns = "branch.branchno, address.*";
        $lTables = "branch INNER JOIN address ON branch.addressno = address.addressno";
        $lCriteria = "";
        $lDataArray = GetAllData($lColumns, $lTables, $lCriteria);
        $lBranchNumber = $_SESSION['branchno'];
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
                                <?php
                                    if($lRow['branchno'] == $lBranchNumber) {
                                        echo("
                                        <td>
                                            <form id='editContract' action='../../PHP/Utilities.php' method='post'>
                                                <input type='text' id='contractno' class='d-none' name='contractno' value=$lBranchNumber>
                                                <input type='submit' value='Edit' class='btn btn-primary' name='editBranchInfo_BRANCH'>
                                            </form>
                                        </td>
                                        ");
                                    } else {
                                        echo("<td></td>");
                                    }
                                ?> 
                            </tr>                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>