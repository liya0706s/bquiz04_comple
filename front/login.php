<h2>第一次購買</h2>
<img src="./icon/0413.jpg" onclick="location.href='?do=reg'">

<h2>會員登入</h2>
<!-- table.all>tr*3>td.tt.ct+td.pp>input:text -->
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
            // $a = rand(10, 99);
            // $b = rand(10, 99);
            // SESSION比一般變數長久存在伺服器端，客戶看不到
            // $_SESSION['ans'] = $a + $b;
            // echo $a . " + " . $b . " =";

            // 圖形驗證碼:
            $_SESSION['ans']=code(5);
            $img=captcha($_SESSION['ans']);
            ?>
            <img src="<?=$img;?>" alt="">
            <input type="text" name="ans" id="ans">
        </td>
    </tr>
</table>
<div class="ct">
    <button onclick="login('mem')">確認</button>
</div>

<script>
    // 定義一個名為 login 的函數，它接受一個參數：table (mem和admin)
    function login(table) {
        // 發送一個 GET 請求到 './api/chk_ans.php' 確認驗證碼
        $.get('./api/chk_ans.php', {
            ans: $("#ans").val()
        }, (chk) => {
            // 將 ans 參數設置為 id 為 'ans' 的元素的值
            // chk 是從 chk_ans.php 返回的響應
            if (parseInt(chk) == 0) {
                alert("驗證碼錯誤，請重新輸入")
            } else {
                // 如果驗證碼正確，發送一個 POST 請求到 './api/chk_pw.php'
                $.post("./api/chk_pw.php", {
                        table, // 傳送 table 參數
                        acc: $("#acc").val(), // 傳送 acc 參數，其值為 id 為 'acc' 的元素的值
                        pw: $("#pw").val()
                    }, // 傳送 pw 參數，其值為 id 為 'pw' 的元素的值
                    (res) => { // res 是從 chk_pw.php 返回的響應
                        if (parseInt(res) == 0) {
                            // 如果 res 轉換為整數後等於 0，顯示錯誤訊息
                            alert("帳號或密碼錯誤，請重新輸入")
                        } else {
                            // 如果帳號和密碼正確，則重定向到 'index.php'
                            location.href = 'index.php';
                        }
                    })
            }
        })
    }
</script>