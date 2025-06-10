<!DOCTYPE html>
<html>

<head></head>

<body>
    <?php
    echo $_POST['x'];
    ?>
    <form action="test_.php" method="post">
        <input type="text" name="x" value="123">
        <input type="submit">
    </form>

    <div class="row">
        <div id="pos" class="col">ตำแหน่ง:
            <select name="position">
                <?php
                $pos = $result['position'];
                ?>
                <option value="<?php echo $pos ?>"><?php echo $pos ?></option>
                <?php
                $posx = mysqli_query($conn, "SELECT DISTINCT `position` FROM `position` WHERE `position` NOT IN ('$pos') ORDER BY `position`");
                while ($respos = $posx->fetch_array()) {
                    if (empty($respos['position'])) {
                        continue;
                    }
                ?>
                    <option value="<?php echo $respos['position'] ?>"><?php echo $respos['position'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
    
</body>

</html>

<?php

date_default_timezone_set('Asia/Bangkok');
echo $year = date("Y") + 543;
echo substr($year, 2);
