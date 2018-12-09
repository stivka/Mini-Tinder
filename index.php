<?php
  require "header.php";
?>

<main>
    </nav>
        <div class="header-login">
    <div class="wrapper-main">
        <section>
              <?php
              if (isset($_SESSION['userId'])) {
                echo '<form action="includes/upload.inc.php" method="post" 
                enctype="multipart/form-data">
                Select photo upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>';
              }
              else {
                
              }
            ?>            
        </section>
    </div>
</main>

<?php
  require "footer.php";
?>
