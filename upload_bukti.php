<?php
$target = "uploads/".basename($_FILES['bukti']['name']);
move_uploaded_file($_FILES['bukti']['tmp_name'], $target);

echo json_encode(["path"=>$target]);
