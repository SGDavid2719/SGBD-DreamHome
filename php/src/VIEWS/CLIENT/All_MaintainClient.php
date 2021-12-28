<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/CLIENT/Query.css" />
</head>
<body>
<?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../utilities.php');
        $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';
        $lEmail = $_SESSION['email'];
        $lCriteria = " where email='$lEmail'";
        $lData = GetData($lTable, $lCriteria);
        $_SESSION['clientno'] = $lData['clientno'];
    ?>
    <section>
        <div class="container mt-5">
            <form action="../../utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" value=<?php echo $lData['fname'] ?> disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" value=<?php echo $lData['lname'] ?> disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Contact info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">Telephone number:</label><br>
                        <input type="text" id="telno" name="telno" value=<?php echo $lData['telno'] ?>><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Preferences info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="lname">Pref Type:</label><br>
                        <input type="text" id="preftype" name="preftype" value=<?php echo $lData['preftype'] ?>><br>
                    </div>
                    <div class="col-6">
                        <label for="fname">Maxrent</label><br>
                        <input type="text" id="maxrent" name="maxrent" value=<?php echo $lData['maxrent'] ?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Account info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="lname">Email:</label><br>
                        <input type="text" id="email" name="email" value=<?php echo $lData['email'] ?>><br>
                    </div>
                    <div class="col-6">
                        <label for="fname">Password:</label><br>
                        <input type="password" id="password" name="password" value=<?php echo $lData['password'] ?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'All_QueryClient.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitClientForm">
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