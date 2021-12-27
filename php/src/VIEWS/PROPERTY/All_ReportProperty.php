<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/PROPERTY/Property.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../utilities.php');
        $lDataArray = GetAllData('propertyno, street, city, postcode, type, rooms, rent', 'propertyforrent');
    ?>
    <section>
        <div class="container mt-5">
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
                                    <input type="text" id="propertyno" class="d-none" name="propertyno" value=<?php echo $lRow['propertyno'] ?>>
                                    <input type="submit" value="More info" class="btn btn-primary" name="queryPropertyForm">
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