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
        $lColumns = "contract.contractno, contract.startdate, contract.enddate, contract.paymode";
        $lTables = "contract INNER JOIN propertyforrent ON contract.propertyno = propertyforrent.propertyno INNER JOIN staff ON propertyforrent.staffno = staff.staffno";
        $lCriteria = "WHERE staff.branchno='$lBranchNumber'";
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
                                        <input type="text" id="contractno" class="d-none" name="contractno" value=<?=$lRow['contractno']?>>
                                        <input type="submit" value="More info" class="btn btn-secondary" name="showContractInfo_BRANCH">
                                    </form>
                                </td>
                                <td>
                                    <form id="editContract" action="../../PHP/Utilities.php" method="post">
                                        <input type="text" id="contractno" class="d-none" name="contractno" value=<?=$lRow['contractno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editContractInfo_BRANCH">
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
                            document.location.href = 'All_ListLeases.php';
                        });
                    </script>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <form id="addContract" action="../../PHP/Utilities.php" method="post">
                        <input type="submit" value="Add Contract" class="btn btn-secondary" name="addContract_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>

    <?php

    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager' && $_SESSION['role'] != 'Supervisor') {
        echo '<style>#editContract { display:none;}</style>';
        echo '<style>#addContract { display:none;}</style>';
    } 

    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') {
        echo '<style>#ReturnBtn { display:none;}</style>';
    }

    ?>

    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>