<?php
    $lTable = ($_SESSION['role'] == 'Client') ? 'client' : 'staff';

    /* Client section */
    $lClientLink = ($_SESSION['role'] == 'Client') ? "../CLIENT/All_DetailClient.php" : "../CLIENT/All_ListClients.php";
    /* Property section */
    $lPropertyLink = ($_SESSION['role'] == 'Client' || $_SESSION['role'] == 'Manager') ? "../PROPERTY/All_ListProperties.php" : "../PROPERTY/Branch_ListProperties.php";
    /* Viewing section */
    $lPropertyViewingLink = "../VIEWING/Branch_ListViewings.php";
    /* Owner section */
    $lOwnerViewingLink = ($_SESSION['role'] == 'Manager') ? "../OWNER/All_ListOwners.php" : "../OWNER/Branch_ListOwners.php";
    /* Lease section */
    $lLeaseLink = ($_SESSION['role'] == 'Manager') ? "../LEASE/All_ListLeases.php" : "../LEASE/Branch_ListLeases.php";
    /* Staff section */
    $lStaffLink = ($_SESSION['role'] == 'Manager') ? "../STAFF/All_ListStaff.php" : "../STAFF/Branch_ListStaff.php";
    /* Branch section */
    $lBranchLink = "../BRANCH/All_ListBranches.php";
    /* Newspaper section */
    $lNewspaperLink = "../NEWSPAPER/All_ListNewspapers.php";
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
                        <a href=<?=$lBranchLink?>>Branch</a>
                    </li>
                    <li id="staffLink">
                        <a href=<?=$lStaffLink?>>Staff</a>
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
                    <li id="leaseLink">
                        <a href=<?=$lLeaseLink?>>Lease</a>
                    </li>
                    <li id="newspaperLink">
                        <a href=<?=$lNewspaperLink?>>Newspaper</a>
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
        echo '<style>#leaseLink { display:none;}</style>';
    }
?>