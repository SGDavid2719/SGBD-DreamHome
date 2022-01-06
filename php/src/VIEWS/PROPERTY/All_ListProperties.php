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
        $lColumns = "p.propertyno, p.type, p.rooms, p.rent, a.city, a.postcode, a.street";
        $lTables = "propertyforrent p, address a";
        $lCriteria = "WHERE p.addressno = a.addressno";
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
                                        <input type="text" id="propertyno" class="d-none" name="propertyno" value=<?=$lRow['propertyno']?>>
                                        <input type="submit" value="More info" class="btn btn-secondary" name="showPropertyInfo_ALL">
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
                    <form id="showBranchProperties" action="../../PHP/Utilities.php" method="post">
                        <input type="submit" value="Show Branch Properties" class="btn btn-secondary" name="showBranchProperties_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>

    <?php

    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') 
    {
        echo '<style>#showBranchProperties { display:none;}</style>';
    } 

    ?>

    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>