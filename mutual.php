<?php
  require "header.php";
  require "includes/dbh.inc.php"
?>

<main>
    </nav>
        <div class="header-login">
    <div class="wrapper-main container h-100 d-flex justify-content-center">
        <section>
        <?php
        // session is started in login
        require "includes/dbh.inc.php";
        
        if (isset($_SESSION["userId"])) {
            $uid = $_SESSION["userId"];
        }
        echo "<h3>Users that have liked you back are:</h3>";
        $sql = "SELECT id, uname, photo_filename, firstname, surname
                FROM t155233_users
                WHERE id IN 
                (SELECT likes FROM t155233_likes WHERE uid=$uid);";
        
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<img src="../uploads/' . $row["photo_filename"] . '" alt="' . $row["photo_filename"] . '"/>
                  <h3>' . $row["firstname"] .' ' . $row["surname"] . '</h3>';
        }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        </section>
    </div>
</main>

<?php
  require "footer.php";
?>