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
        // Property types
        $lPropertyTypes = array("Flat", "House");
    ?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="clientno">Client Number:</label><br>
                        <input type="text" id="clientno" name="clientno" maxlength="3" class="form-control" required><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Owner info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" name="fname" maxlength="10" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" name="lname" maxlength="10" class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Personal info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" maxlength="50" class="form-control" required><br>
                    </div>
                    <div class="col-6">
                        <label for="telno">Telephone number:</label><br>
                        <input type="text" id="telno" name="telno" class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="preftype">Pref type:</label><br>
                        <select type="text" id="preftype" name="preftype" class="form-select form-select-sm" required>
                            <?php 
                            foreach ($lPropertyTypes as $lRow) 
                            {
                                echo '<option value=' . "$lRow" . '>' . $lRow . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="maxrent">Max rent:</label><br>
                        <input type="text" id="maxrent" name="maxrent" class="form-control" required><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-1 d-flex justify-content-center">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'All_ListClients.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitClientAddition">
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