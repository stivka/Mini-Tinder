<?php
  require "header.php";
  require "includes/dbh.inc.php";
  include_once "includes/dbh.inc.php";
?>

<main>
    <div class="wrapper-main">
        <section>
            <p class="">
                <?php
                $nameVariable = 'Phil';
                $sql = "SELECT * FROM users WHERE uname='$nameVariable'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "id: " . $row["id"]. " - email: " . $row["email"]. " - uname: " . $row["uname"]. " - firstname: " . $row["firstname"]. " - surname: " . $row["surname"]. " -pwd: " .["pwd"]. "<br>";
                    }
                } else {
                    echo "0 results";
                }
                
                mysqli_close($conn);
                ?>
            </p>
        </section>
    </div>
</main>

<?php
  require "footer.php";
?>
