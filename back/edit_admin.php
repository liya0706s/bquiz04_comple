<h2 class="ct">修改管理員權限</h2>
<!-- table.all>tr*3>td.tt.ct+td.pp>input:text -->
<?php
// 拿到要修改的使用者資料id
$row = $Admin->find($_GET['id']);
// 資料從資料庫中的字串改成陣列 unserialize()
$pr = unserialize($row['pr']);
?>

<form action="./api/save_admin.php" method="post">
    <table class="all">
        <tr>
            <td class="tt ct">帳號</td>
            <td class="pp"><input type="text" name="acc" id="acc" value="<?= $row['acc']; ?>"></td>
        </tr>
        <tr>
            <td class="tt ct">密碼</td>
            <td class="pp"><input type="password" name="pw" id="pw" value="<?= $row['pw']; ?>"></td>
        </tr>
        <tr>
            <td class="tt ct">權限</td>
            <td class="pp">
                <!-- 有沒有在陣列中的權限 in_array()會回傳true or false/ checked or not / selected or not -->
                <div><input type="checkbox" name="pr[]" value="1" <?= (in_array(1, $pr)) ? 'checked' : ''; ?>>
                    商品分類與管理
                </div>
                <div><input type="checkbox" name="pr[]" value="2" <?= (in_array(2, $pr)) ? 'checked' : ''; ?>>
                    訂單管理
                </div>
                <div><input type="checkbox" name="pr[]" value="3" <?= (in_array(3, $pr)) ? 'checked' : ''; ?>>
                    會員管理
                </div>
                <div><input type="checkbox" name="pr[]" value="4" <?= (in_array(4, $pr)) ? 'checked' : ''; ?>>
                    頁尾版權區管理
                </div>
                <div><input type="checkbox" name="pr[]" value="5" <?= (in_array(5, $pr)) ? 'checked' : ''; ?>>
                    最新消息管理
                </div>
            </td>
        </tr>
    </table>

    <div class="ct">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <!-- 隱藏id 否則會都是新增 -->
        <input type="submit" value="修改">
        <input type="reset" value="重置">
    </div>
</form>