<?php
    // Utilities
    include_once('../../PHP/Utilities.php');
    // Security handler
    CheckRolePermission("newspaper");
    // Head
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Views.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        $lColumns = "*";
        $lTables = "newspaper";
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
                                    <form id="editNewspaper" action="../../PHP/Utilities.php" method="post">
                                        <input type="text" id="newspaperno" class="d-none" name="newspaperno" value=<?=$lRow['newspaperno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editNewspaperInfo">
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
                        <input type="submit" value="Add Newspaper" class="btn btn-secondary" name="addNewspaper">
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