<?php

session_start();
// deletes all the values from the $_SESSION variable
session_unset();
// destroys the current running sessions
session_destroy();
header("Location: ../index.php");
