<?php
  require "header.php";
  require "includes/dbh.inc.php"
?>

<main>
    </nav>
        <div class="header-login">
    <div class="wrapper-main">
        <section>
              <?php
              if (isset($_SESSION['userId'])) {
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $uid = $_SESSION['userId'];
                
                $sql = "SELECT photo_filename, gender FROM t155233_users WHERE id=$uid";
                $result = $conn->query($sql);

                $checkMissingData = false;
                
                if ($result->num_rows > 0) {
                    /* output data of each row
                    Checks if there exists a record of a photo in db, if not
                    pulls out form to upload one.
                    */
                    while($row = $result->fetch_assoc()) {
                        //echo "id: " . $row["photo_filename"]. "<br>";
                        if(empty($row["photo_filename"])) {
                            echo '<form action="includes/upload.inc.php" method="post" 
                            enctype="multipart/form-data">
                            Select photo upload:
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input type="submit" value="Upload Image" name="upload_image">
                            </form>';
                        }
                        if(empty($row["gender"])) {
                            echo '<form action="includes/setGender.inc.php" method="post">
                            <input type="radio" name="gender" value="male"> Male<br>
                            <input type="radio" name="gender" value="female"> Female<br>
                            <input type="submit" value="Set gender" name="set_gender">
                            </form>';
                        }
                        $checkMissingData = true;
                    }
                /* if all is set, meaning gender and photo isn't missing.
                Start new query.
                We can ask for opinions about other's photos. */    
                } if($checkMissingData) { 
                    
                    $sql = "SELECT gender FROM t155233_users WHERE id=$uid;";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $gender = $row["gender"];
                        }
                    }

                    echo $gender;
                    
                    
                    $sql = "SELECT id, gender, photo_filename
                            FROM t155233_users
                            WHERE gender != '$gender'
                            AND id NOT IN (SELECT rated
                            FROM t155233_rated WHERE uid <> $uid)
                            
                            
                    ;";

                    $result = mysqli_query($conn, $sql);                        
                
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        $unratedUsers = array();
                        while($row = mysqli_fetch_assoc($result)) {
                             
                            echo "id that isn't rated: " . $row["rated"]. " photo's filename " . $row['photo_filename'] . "<br>";
                            
                            array_push($unratedUsers, $row['photo_filename']);
                        }
                        echo print_r($unratedUsers);
                        if (!empty($unratedUsers)) {
                            error_reporting(0);
                            echo '<img src="../uploads/' . $unratedUsers[0] . '" alt="' . $unratedUsers . '>"';
                            echo '<img src="img/kiss.png" alt="kiss">';
                        }
                    } else {
                        echo "0 results";
                    }


                }
                mysqli_close($conn);
            } else {
             echo 'Login to get a piece of the action. Show your red nose and show some Christmas spirit!';        
            }            
            ?>            
        </section>
    </div>
</main>

<?php
  require "footer.php";
?>
