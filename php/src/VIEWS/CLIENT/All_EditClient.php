<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/CLIENT/Query.css" />
</head>
<body>
<?php
    include_once('../../ELEMENTS/Header.php');
    include_once('../../PHP/Utilities.php');
    $lRoleSecurityClass = $_SESSION['rolesecurityclass'];
    $lClientNumber = ($_SESSION['role'] == 'Client') ? $_SESSION['roleno'] : $_SESSION['clientno'];
    $lColumns = "client.clientno, client.fname, client.lname, client.telno, client.preftype, client.maxrent, client.email";
    $lTable = "client";
    $lCriteria = "WHERE client.clientno = '$lClientNumber' AND client.securityclass<=$lRoleSecurityClass";
    $lData = GetData($lColumns, $lTable, $lCriteria);
    // Property types
    $lPropertyTypes = array("Flat", "House");
?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" name="fname" value=<?=$lData['fname']?> maxlength="10" class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" name="lname" value=<?=$lData['lname']?> maxlength="10" class="form-control"><br>
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
                        <select type="text" id="preftype" name="preftype" class="form-select form-select-sm" required>
                            <?php 
                            foreach ($lPropertyTypes as $lRow) 
                            {
                                if ($lRow == $lData['preftype']) echo '<option value=' . "$lRow" . ' selected>' . $lRow . '</option>';
                                else echo '<option value=' . "$lRow" . '>' . $lRow . '</option>';
                            }
                            ?>
                        </select>
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
                        <input type="text" id="email" name="email" value=<?=$lData['email']?> maxlength="50" class="form-control"><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            var lRole = "<?php echo $_SESSION['role']; ?>";
                            lBtn.addEventListener('click', function() {
                                if (lRole == 'Client') document.location.href = 'All_DetailClient.php';
                                else document.location.href = 'All_ListClients.php';
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
        include_once('../../ELEMENTS/Footer.php');
    ?>
</body>
</html>