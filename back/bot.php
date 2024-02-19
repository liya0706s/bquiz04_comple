<?php
// 如果有送資料過來編輯...
if (!empty($_POST)) {
    $Bottom->save(['bottom' => $_POST['bottom'], 'id' => 1]);
}
// 如果if else沒有else可以不用大括號，寫在一行;第二行中會被算在else內容
?>
<h2 class="ct">編輯頁尾版權區</h2>
<form action="?do=bot" method="post">
    <!-- 回到bot該頁 -->
    <!-- table.all>tr>td.tt+td.pp>input -->
    <table class="all">
        <tr>
            <td class="tt">頁尾宣告內容</td>
            <td class="pp">
                <input type="text" name="bottom" value="<?= $Bottom->find(1)['bottom']; ?>">
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="編輯">
        <input type="reset" value="重置">
    </div>
</form>