<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/CLIENT/Query.css" />
</head>
<body>
<?php
    include_once('../../ELEMENTS/header.php');
    include_once('../../PHP/Utilities.php');
    $lColumns = "*";
    $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';
    $lRoleNumber = $_SESSION['roleno'];
    $lCriteria = ($_SESSION['role'] == 'Client') ? "WHERE clientno='$lRoleNumber'" : "WHERE staffno='$lRoleNumber'";
    $lData = GetData($lColumns, $lTable, $lCriteria);
?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" value=<?=$lData['fname']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" value=<?=$lData['lname']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Contact info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="telno">Telephone number:</label><br>
                        <input type="text" id="telno" name="telno" value=<?=$lData['telno']?> class="form-control"><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Preferences info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="preftype">Pref Type:</label><br>
                        <input type="text" id="preftype" name="preftype" value=<?=$lData['preftype']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="maxrent">Max Rent</label><br>
                        <input type="text" id="maxrent" name="maxrent" value=<?=$lData['maxrent']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Account info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" value=<?=$lData['email']?> class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" value=<?=$lData['password']?> class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'All_DetailClient.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitClientEdition">
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