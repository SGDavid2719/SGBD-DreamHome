<?php
    function Redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    $user_address=$_POST['eaddress'];
    $user_password=$_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "credentials";
    // Create connection
    $connection = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $query="SELECT*FROM Users where userAddress='$user_address' and pass='$user_password'";
    $result=mysqli_query($connection, $query);

    $rows=mysqli_num_rows($result);
    if($rows) {
        Redirect('index.php', false);
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>Your email address or password are incorrect!</strong> Try it again.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        include_once('login.php');
    }
    mysqli_free_result($result);
    mysqli_close($connection);
?>