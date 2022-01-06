<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/PROPERTY/Property.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        include_once('../../PHP/Utilities.php');
        $lBranchNumber = $_SESSION['branchno'];
        $lColumns = "propertyforrent.propertyno, propertyforrent.type, propertyforrent.rooms, propertyforrent.rent, address.city, address.postcode, address.street";
        $lTables = "propertyforrent INNER JOIN staff ON propertyforrent.staffno = staff.staffno INNER JOIN address ON propertyforrent.addressno = address.addressno";
        $lCriteria = "WHERE staff.branchno = '$lBranchNumber'";
        $lDataArray = GetAllData($lColumns, $lTables, $lCriteria);
        // DELETE
        print_r($_SESSION);
        print_r($_POST);
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
                                        <input type="text" id="propertyno" class="d-none" name="propertyno" value=<?=$lRow['propertyno']?>>
                                        <input type="submit" value="More info" class="btn btn-secondary" name="showPropertyInfo_BRANCH">
                                    </form>
                                </td>
                                <td>
                                    <form id="editPropertyButton" action="../../PHP/Utilities.php" method="post">
                                        <input type="text" id="propertyno" class="d-none" name="propertyno" value=<?=$lRow['propertyno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editPropertyInfo_ALL">
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
                            document.location.href = 'All_ListProperties.php';
                        });
                    </script>
                </div>
                <div class="col-2 d-flex justify-content-end">
                    <form action="../../PHP/Utilities.php" method="post">
                        <input type="submit" value="Add Property" class="btn btn-secondary" name="addProperty_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>

    <?php

    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') {
        echo '<style>#ReturnBtn { display:none;}</style>';

        if ($_SESSION['role'] != 'Supervisor') echo '<style>#editPropertyButton { display:none;}</style>';
    } 

    ?>
    
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>