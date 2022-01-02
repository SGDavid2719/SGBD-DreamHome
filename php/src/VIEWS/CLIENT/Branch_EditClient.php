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
        $lClientNumber = (isset($_POST['clientno'])) ? $_POST['clientno'] : $_SESSION['clientno'];
        if(isset($_POST['clientno'])) unset($_POST['clientno']);
        $lColumns = "client.clientno, client.fname, client.lname, client.telno, client.preftype, client.maxrent, client.email";
        $lTable = "client";
        $lCriteria = "WHERE client.clientno = '$lClientNumber'";
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
                        <label for="clientno">Client Number:</label><br>
                        <input type="text" id="clientno" name="clientno" value=<?=$lData['clientno']?> class="form-control" readonly required><br>
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
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" value=<?=$lData['email']?> class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="telno">Telephone number:</label><br>
                        <input type="text" id="telno" name="telno" value=<?=$lData['telno']?> class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="preftype">Pref type:</label><br>
                        <input type="text" id="preftype" name="preftype" value=<?=$lData['preftype']?> class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="maxrent">Max rent:</label><br>
                        <input type="text" id="maxrent" name="maxrent" value=<?=$lData['maxrent']?> class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-1 d-flex justify-content-center">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'Branch_ListClients.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitClientEdition_BRANCH">
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