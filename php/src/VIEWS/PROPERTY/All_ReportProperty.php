<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/CLIENT/AllQueryClient.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../utilities.php');
        $lDataArray = GetAllData('propertyforrent');
    ?>
    <section>
        <div class="container mt-5">
            <table>
                <thead>
                    <tr>
                        <th><?php echo implode('</th><th>', array_keys(current($lDataArray))); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lDataArray as $row): array_map('htmlentities', $row); ?>
                        <tr>
                            <td><?php echo implode('</td><td>', $row); ?></td>
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