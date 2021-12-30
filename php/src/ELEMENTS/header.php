<?php
    $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';

    /* Client section */
    $lClientLink = ($_SESSION['role'] == 'Client') ? "../CLIENT/All_DetailClient.php" : "../CLIENT/Branch_ListClients.php";
    /* Property section */
    $lPropertyLink = ($_SESSION['role'] == 'Client') ? "../PROPERTY/All_ListProperties.php" : "../PROPERTY/Branch_ListProperties.php";
    /* Viewing section */
    $lPropertyViewingLink = "../VIEWING/Branch_ReportViewing.php";
    /* Viewing section */
    $lOwnerViewingLink = "../OWNER/Branch_ListOwners.php";
?>

<header>
    <div id="navigation-bar" class="p-3">
        <div id="navigation-menu-btn" class="navigation-menu-btn">
            <i class="fas fa-bars fa-2x"></i>
        </div>
        <div class="m-2 navigation-elements">
            <nav id="navigation-main" class="navigation-main">
                <!-- Brand -->
                <a href="../INDEX/Index.php"><img src="../../IMG/dream-home.png" alt="DreamHome Logo" class="iconImg invert"></a>
                <!-- Left Nav -->
                <ul class="navigation-menu mt-2">
                    <li id="branchLink">
                        <a href="branch.php">Branch</a>
                    </li>
                    <li id="staffLink">
                        <a href="staff.php">Staff</a>
                    </li>
                    <li id="propertyForRentLink">
                        <a href=<?=$lPropertyLink?>>Property for rent</a>
                    </li>
                    <li id="ownerLink">
                        <a href=<?=$lOwnerViewingLink?>>Owner</a>
                    </li>
                    <li id="clientLink">
                        <a href=<?=$lClientLink?>>Client</a>
                    </li>
                    <li id="propertyViewingLink">
                        <a href=<?=$lPropertyViewingLink?>>Property viewing</a>
                    </li>
                    <li id="newspaperLink">
                        <a href="newspaper.php">Newspaper</a>
                    </li>
                </ul>
                <ul class="navigation-menu-user mt-2">
                    <li>
                        <a href="../../PHP/Logout_Action.php">   
                            <i class="far fa-user"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>                
        </div>
    </div>
</header>

<?php
    if ($_SESSION['role'] == 'Director' ||  $_SESSION['role'] == 'Manager') {
        echo '<style>#propertyViewingLink { display:none;}</style>';
    } else if ($_SESSION['role'] == 'Supervisor') {
        echo '<style>#branchLink { display:none;}</style>';
        echo '<style>#newspaperLink { display:none;}</style>';
    } else if ($_SESSION['role'] == 'Assistant') {
        echo '<style>#branchLink { display:none;}</style>';
        echo '<style>#staffLink { display:none;}</style>';
        echo '<style>#newspaperLink { display:none;}</style>';
    } else if($_SESSION['role'] == 'Client') {
        echo '<style>#branchLink { display:none;}</style>';
        echo '<style>#staffLink { display:none;}</style>';
        echo '<style>#ownerLink { display:none;}</style>';
        echo '<style>#propertyViewingLink { display:none;}</style>';
        echo '<style>#newspaperLink { display:none;}</style>';
    }
?>