<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/VIEWING/Viewing.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../PHP/Utilities.php');
        $lBranchNumber = $_SESSION['branchno'];
        $lOwnerNumber = $_POST['ownerno'];
        unset($_POST['ownerno']);
        $lColumns = "DISTINCT owner.ownerno, owner.fname, owner.lname, owner.address, owner.telno, owner.email";
        $lTable = "owner";
        $lCriteria = "INNER JOIN propertyforrent ON owner.ownerno = propertyforrent.ownerno INNER JOIN staff ON propertyforrent.staffno = staff.staffno WHERE staff.branchno = '$lBranchNumber ' AND owner.ownerno = '$lOwnerNumber'";
        $lData = GetData($lColumns, $lTable, $lCriteria);
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="ownerno">Owner Number:</label><br>
                        <input type="text" id="ownerno" name="ownerno" value=<?=$lData['ownerno']?> class="form-control" readonly required><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Owner info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" name="fname" value=<?=$lData['fname']?> class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" name="lname" value=<?=$lData['lname']?> class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Personal info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="address">Address:</label><br>
                        <input type="text" id="address" name="address" value=<?=$lData['address']?> class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="telno">Telephone number:</label><br>
                        <input type="text" id="telno" name="telno" value=<?=$lData['telno']?> class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" value=<?=$lData['email']?> class="form-control" required><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-1 d-flex justify-content-center">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'Branch_ListOwners.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitOwnerEdition">
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
        include_once('../../ELEMENTS/footer.php');
    ?>
</body>
</html>