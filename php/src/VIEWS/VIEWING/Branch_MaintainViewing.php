<?php
    include_once('../../ELEMENTS/head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/VIEWING/Viewing.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/header.php');
        include_once('../../utilities.php');
        $lPropertyNumber = $_SESSION['propertyno'];
        $lClientNumber = $_SESSION['clientno'];
        $lViewdate = $_SESSION['viewdate'];
        $lComment = $_SESSION['comment'];
    ?>
    <section>
        <div class="container mt-5">
            <h1>Branch Number: <?=$_SESSION['branchno']?></h1>
            <form action="../../utilities.php" method="post">
                <div class="row mt-4">
                    <h4>Intern info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="propertyno">Property Number:</label><br>
                        <input type="text" id="propertyno" name="propertyno" value=<?=$lPropertyNumber?> readonly><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Basic info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="clientno">Client Number:</label><br>
                        <input type="text" id="clientno" name="clientno" value=<?=$lClientNumber?> readonly><br>
                    </div>
                    <div class="col-6">
                        <label for="viewdate">View Date:</label><br>
                        <input type="date" id="viewdate" name="viewdate" value=<?=$lViewdate?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <label for="comment">Comment:</label><br>
                        <input type="text" id="comment" name="comment" value=<?=$lComment?>><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-1 d-flex justify-content-center">
                        <button id='ReturnBtn' type="button" class="btn btn-danger">Cancel</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'Branch_QueryViewing.php';
                            });
                        </script>
                    </div>
                    <div class="col-1 d-flex justify-content-end">
                        <input type="submit" value="Submit" class="btn btn-secondary" name="submitViewingForm">
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