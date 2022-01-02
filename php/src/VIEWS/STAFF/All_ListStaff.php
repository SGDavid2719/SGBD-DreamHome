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
        $lColumns = "staff.staffno, staff.fname, staff.lname, staff.branchno, staff.position";
        $lTables = "staff";
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
                        <input type="submit" value="Show Branch Staff" class="btn btn-secondary" name="showBranchStaff_BRANCH">
                    </form> 
                </div>
            </div>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>