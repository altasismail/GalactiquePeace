<?php
    session_start();

    //initial variables:
    $name = "";
    $address = "";
    $id = "0";
    $edit_state = false;

    // connecting a database:
    $db = mysqli_connect('localhost', 'root', '', 'glq');

    //Action described here for save button click:
    if (isset($_POST['save'])){
        $name = $_POST['name'];
        $address = $_POST['address'];

        $query = "INSERT INTO info (name,address) VALUES ('$name', '$address')";
        mysqli_query($db, $query);
        $_SESSION['msg'] = "Ambassador Saved";
        //here after inserting the data entry into sql database, we would like to return to index.php page back:
        header('location: index.php');
    }
    // to make a change first retrive the already given info:
    if (isset($_POST['update'])) {
        $name = mysql_real_escape_string($_POST['name']);
        $address = mysql_real_escape_string($_POST['address']);
        $id = mysql_real_escape_string($_POST['id']);

        // and send new entries back to db:
        mysqli_query($db, "UPDATE info SET name=`$name`, address=`$address` WHERE id=$id");
        $_SESSION['msg'] = "Ambassador Re-Assigned!";
        header('location: index.php');

    }
    //delete an entry:
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM info WHERE id=$id");
        $_SESSION['msg'] = "Ambassador Deposted!";
        header('location: index.php');

    }

    //retrive information from mysql
    $results = mysqli_query($db, "SELECT * FROM info");

?>
