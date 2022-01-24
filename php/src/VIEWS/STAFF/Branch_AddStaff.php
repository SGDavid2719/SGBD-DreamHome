<?php
    // Utilities
    include_once('../../PHP/Utilities.php');
    // Security handler
    CheckRolePermission("staff");
    // Head
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/Views.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        $lPositionsArray = array('Assistant');
        if ($_SESSION['role'] == 'Manager') array_push($lPositionsArray, 'Supervisor');
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../PHP/Utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="branchno">Branch Number:</label><br>
                        <input type="text" id="branchno" name="branchno" value=<?=$_SESSION['branchno']?> class="form-control" readonly><br>
                    </div>
                    <div class="col-6">
                        <label for="staffno">Staff Number:</label><br>
                        <input type="text" id="staffno" name="staffno" maxlength="3" class="form-control"><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="position">Staff position:</label><br>
                        <select type="text" id="position" name="position" class="form-select form-select-sm" required>
                            <?php 
                            foreach ($lPositionsArray as $lRow) 
                            {
                               echo '<option value=' . "$lRow" . '>' . $lRow . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="fname">First name:</label><br>
                        <input type="text" id="fname" name="fname" maxlength="10" class="form-control" ><br>
                    </div>
                    <div class="col-6">
                        <label for="lname">Last name:</label><br>
                        <input type="text" id="lname" name="lname" maxlength="10" class="form-control" ><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="sex">Sex:</label><br>
                        <select type="text" id="sex" name="sex" maxlength="1" class="form-select form-select-sm" required>
                            <option value="M">M</option>
                            <option value="F ">F</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="dob">Date of Birth:</label><br>
                        <input type="date" id="dob" name="dob" class="form-control" disaled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="salary">Salary:</label><br>
                        <input type="text" id="salary" name="salary" class="form-control" ><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Account info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="email">Email:</label><br>
                        <input type="text" id="email" name="email" maxlength="50" class="form-control" ><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-10"></div>
                    <div class="col-1 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                <?php unset($_GET['propertyno']);?>
                                document.location.href = 'Branch_ListStaff.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-primary" name="submitAddStaff_BRANCH">
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