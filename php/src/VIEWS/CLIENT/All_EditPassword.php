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
?>
    <section>
        <div class="container mt-5">
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="password">Previous Password:</label><br>
                        <input type="password" id="password" name="password" maxlength="40" class="form-control"><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="newPassword1">New password:</label><br>
                        <input type="password" id="newPassword1" name="newPassword1" maxlength="40" class="form-control"><br>
                    </div>
                    <div class="col-6">
                        <label for="newPassword2">Repeat password:</label><br>
                        <input type="password" id="newPassword2" name="newPassword2" maxlength="40" class="form-control"><br>
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
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitClientPasswordEdition">
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