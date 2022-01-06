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
        // Client numbers
        $lColumns = 'client.clientno';
        $lTable = 'client';
        $lCriteria = '';
        $lClientArrayData = GetAllData($lColumns, $lTable, $lCriteria);
        // Properties
        $lColumns = 'propertyforrent.propertyno';
        $lTable = 'propertyforrent';
        $lCriteria = '';
        $lPropertyArrayData = GetAllData($lColumns, $lTable, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="viewingno">Viewing Number:</label><br>
                        <input type="text" id="viewingno" name="viewingno" class="form-control" required><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="clientno">Client Number:</label><br>
                        <select type="text" id="clientno" name="clientno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lClientArrayData) as $lRow) {
                                print_r($lClientArrayData[$lRow]);
                                echo '<option value=' . $lClientArrayData[$lRow]['clientno'] . '>' . $lClientArrayData[$lRow]['clientno'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <select type="text" id="propertyno" name="propertyno" class="form-select form-select-sm" required>
                            <?php 
                            foreach (array_keys($lPropertyArrayData) as $lRow) {
                                echo '<option value=' . $lPropertyArrayData[$lRow]['propertyno'] . '>' . $lPropertyArrayData[$lRow]['propertyno'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Viewing info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="viewdate">Viewdate:</label><br>
                        <input type="date" id="viewdate" name="viewdate" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="comment">Comment:</label><br>
                        <input type="text" id="comment" name="comment" class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                <?php unset($_GET['propertyno']);?>
                                document.location.href = 'Branch_ListViewings.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-primary" name="submitAddViewing_BRANCH">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>