<?php
    include_once('../../ELEMENTS/Head.php');
?>
<!-- STYLES -->
<link rel="stylesheet" type="text/css" href="../../CSS/VIEWING/Viewing.css" />
</head>
<body>
    <?php
        include_once('../../ELEMENTS/Header.php');
        include_once('../../PHP/Utilities.php');
        $lPropertyNumber = $_SESSION['viewingno'];
        $lColumns = "viewing.viewingno, viewing.viewdate, viewing.comment, propertyforrent.type, propertyforrent.rooms, propertyforrent.rent, address.street, address.city, address.postcode";
        $lTable = "viewing INNER JOIN propertyforrent ON viewing.propertyno = propertyforrent.propertyno INNER JOIN address ON propertyforrent.addressno = address.addressno";
        $lCriteria = "WHERE viewing.viewingno = '$lPropertyNumber '";
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
                        <label for="viewingno">Viewing Number:</label><br>
                        <input type="text" id="viewingno" value=<?=$lData['viewingno']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Viewing info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="viewdate">Viewdate:</label><br>
                        <input type="date" id="viewdate" name="viewdate" value=<?=$lData['viewdate']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="comment">Comment:</label><br>
                        <input type="text" id="comment" name="comment" maxlength="20" value=<?(!empty($lData['comment'])) ? print($lData['comment']) : print("-")?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Property info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="type">Type:</label><br>
                        <input type="text" id="type" name="type" value=<?=$lData['type']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="rooms">Rooms:</label><br>
                        <input type="text" id="rooms" name="rooms" value=<?=$lData['rooms']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="rent">Rent:</label><br>
                        <input type="text" id="rent" name="rent" value=<?=$lData['rent']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <h4>Address info</h4>
                    <hr>
                    <div class="col-6">
                        <label for="street">Street:</label><br>
                        <input type="text" id="street" name="street" value=<?=$lData['street']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6">
                        <label for="city">City:</label><br>
                        <input type="text" id="city" name="city" value=<?=$lData['city']?> class="form-control" disabled><br>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label for="postcode">Postcode:</label><br>
                        <input type="text" id="postcode" name="postcode" maxlength="10" value=<?=$lData['postcode']?> class="form-control" disabled><br>
                    </div>
                    <div class="col-6"></div>
                </div>
                <div class="row mt-4">
                    <div class="col-9"></div>
                    <div class="col-3 d-flex justify-content-end">
                        <button id='ReturnBtn' type="button" class="btn btn-secondary">Return</button>
                        <script>
                            var lBtn = document.getElementById('ReturnBtn');
                            lBtn.addEventListener('click', function() {
                                document.location.href = 'Branch_ListViewings.php';
                            });
                        </script>
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