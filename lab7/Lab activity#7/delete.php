<?php
require_once("functions.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    if (deleteEntry($id)) {

        header("Location: index.php");
        exit();
    } else {
        
        echo "Failed to delete the entry.";
    }
} else {
    
    echo "Invalid entry ID.";
}
