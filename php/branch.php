<?php

if(isset($_POST['edit'])==true){
    // echo "修正ボタン押下";
    if(isset($_POST['id'])==false){
        header('Location:ng.php');
        exit();
    }
    $edit_id = $_POST["id"];
    header('Location:temperature_record_edit.php?id='.$edit_id);
    exit();
}

if(isset($_POST['delete'])==true){
    // echo "削除ボタン押下";
    if(isset($_POST['id'])==false){
        header('Location:ng.php');
        exit();
    }
    $delete_id = $_POST["id"];
    header('Location:temperature_record_delete.php?id='.$delete_id);
    exit();
}

?>
