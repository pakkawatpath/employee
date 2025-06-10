<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <div class="container">
        <div style="text-align: center;">
            <form action="insert" method="post">
                <label>เพิ่มUser:<span>*</span></label>
                <input type="text" name="iduser" autocomplete="off" placeholder="ID">
                <input type="text" name="passuser" autocomplete="off" placeholder="Password">
                <select name="type">
                    <option disabled selected>---------------</option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
                <input type="submit" value="เพิ่ม">
            </form>
        </div>
        <br>
        <table width=100%; style="border-collapse: collapse;font-size:1em;border-spacing: 20px;">
            <thead>
                <tr>
                    <th class="text-center">ลบ</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $u = mysqli_query($conn, "SELECT * FROM `user`");
                while ($res = $u->fetch_array()) {
                ?>
                    <tr>
                        <td class="text-center"><a href='delete.php?user=<?php echo $res['user'] ?>' onclick="return confirm('ต้องการลบหรือไม่')"><img src='icon/delete.gif' /></a></td>
                        <td class="text-center"><?php echo $res['user'] ?></td>
                        <td class="text-center"><?php echo $res['password'] ?></td>
                        <td class="text-center"><?php echo $res['type'] ?></td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>