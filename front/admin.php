<h2>管理員登入</h2>
<!-- table.all>tr*3>td.tt+td.pp>input:text -->
<table class="all">
    <tr>
        <td class="tt">帳號</td>
        <td class="pp"><input type="text" name="acc" id="acc"></td>
    </tr>
    <tr>
        <td class="tt">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt">驗證碼</td>
        <td class="pp">
            <?php
            // 兩位數的亂數區間
            $a = rand(10, 99);
            $b = rand(10, 99);
            // SESSION比一般變數長久,存在伺服器端,客戶看不到
            $_SESSION['ans'] = $a + $b;
            echo $a . " + " . $b . " =";
            ?>
            <input type="text" name="ans" id="ans">
            
        </td>
    </tr>
</table>
<div class="ct"><button onclick="login('admin')">確認</button></div>

<script>
    function login(table) {
        $.get('./api/chk_ans.php', {
            ans: $('#ans').val()
        }, (chk) => {
            // 將 ans 參數設置為 id 為 'ans' 的元素的值
            if (parseInt(chk) == 0) {
                alert("對不起，您輸入的驗證碼有誤，請您重新輸入")
            } else {
                $.post("./api/chk_pw.php", {
                        table,
                        acc: $("#acc").val(),
                        pw: $("#pw").val()
                    },
                    (res) => {
                        if (parseInt(res) == 0) {
                            alert("帳號或密碼錯誤，請重新輸入")
                        } else {
                            location.href = 'back.php?do=admin';
                        }
                    })
            }
        })
    }
</script>