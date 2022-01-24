<?php
    // Utilities
    include_once('../../PHP/Utilities.php');
    // Security handler
    CheckRolePermission("client");
    // Head
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Views.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
        $lColumns = "client.clientno, client.fname, client.lname, client.telno, client.preftype, client.maxrent, client.email";
        $lTables = "client";
        $lCriteria = "WHERE client.securityclass<=$lRoleSecurityClass";
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
                                        <input type="text" id="clientno" class="d-none" name="clientno" value=<?=$lRow['clientno']?>>
                                        <input type="submit" value="Edit" class="btn btn-primary" name="editClientInfo_ALL">
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
                    <form id="addClient" action="../../PHP/Utilities.php" method="post">
                        <input type="submit" value="Add Client" class="btn btn-secondary" name="addClient">
                    </form> 
                </div>
            </div>
        </div>
    </section>

    
    <?php
    if ($_SESSION['role'] != 'Director' &&  $_SESSION['role'] != 'Manager') {
        echo '<style>#addClient { display:none;}</style>';
    }

    include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>