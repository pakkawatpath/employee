<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <div id="face" class="tabcontent">
        <form action="uploada.php" id="uploadForm" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="my-5 col-sm-9 col-md-6 col-lg-8 col-xl-10">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="hidden" name="scan" value="face">
                            <input type="file" class="custom-file-input" id="customFileInput" accept=".csv" name="file" required>
                            <label class="custom-file-label" for="customFileInput"></label>
                        </div>
                        <div class="input-group-append">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</body>

</html>

<?php
date_default_timezone_set('Asia/Bangkok');
$date_now = date('Y-m-d H:i');
echo $date_now . '<br>';
$date = date_create($date_now);
echo $udate = date_format($date, "d/m/Y H:i");

$n = array("นาย", "นาง", "นางสาว");
$i = 0;
while ($i < count($n)) {
    echo $n[$i];
    $i++;
}
