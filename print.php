<?php
  require "header.php";
  require "includes/dbh.inc.php";
  require "includes/upload.inc.php";
  include_once "includes/dbh.inc.php";
?>

<main>
    <div class="wrapper-main">
        <section>
            <p class="">
                <?php
                
                $filename = mysqli_real_escape_string($conn, $_POST['fileToUpload']);
                
                echo '<p> filename is ' . $filename . '';
                
                mysqli_close($conn);
                ?>
            </p>
        </section>
    </div>
</main>

<?php
  require "footer.php";
?>
