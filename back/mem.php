
<h2 class="ct">會員管理</h2>
<table class="all">
    <tr>
        <th class="tt ct">姓名</th>
        <th class="tt ct">會員帳號</th>
        <th class="tt ct">註冊日期</th>
        <th class="tt ct">管理</th>
    </tr>
    <?php
    // 印出所有管理者
    $rows = $Mem->all();
    foreach ($rows as $row) {
    ?>
        <tr>
            <td class="pp ct"><?= $row['name']; ?></td>
            <td class="pp ct"><?= $row['acc']; ?></td>
            <td class="pp ct"><?= $row['regdate']; ?></td>

            <td class="pp ct">
                <?php
                echo "<button onclick='location.href=&#39;?do=edit_mem&id={$row['id']}&#39;'>修改</button>";
                echo "<button onclick='del(&#39;mem&#39;,{$row['id']})'>刪除</button>";
                ?>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<div class="ct">
    <button onclick="location.href='index.php'">返回</button>
</div>