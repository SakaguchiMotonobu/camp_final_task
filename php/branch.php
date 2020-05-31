<?php

if(isset($_POST['edit'])==true){
    // echo "修正ボタン押下";
    $edit_id = $_POST["id"];
    header('Location:temperature_record_edit.php?id='.$edit_id);
    exit();
}

if(isset($_POST['delete'])==true){
    // echo "削除ボタン押下";
    $delete_id = $_POST["id"];
    header('Location:temperature_record_delete.php?id='.$delete_id);
    exit();
}

?>
