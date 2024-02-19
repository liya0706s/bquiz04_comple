<h2 class="ct">會員註冊</h2>
<table class="all">
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name"></td>
    </tr>
    <tr>
        <td class="tt ct">帳號</td>
        <td class="pp">
            <!-- id acc的val -->
            <input type="text" name="acc" id="acc">
            <button onclick="chkacc()">檢測帳號</button>
        </td>
    </tr>
    <tr>
        <td class="tt ct">密碼</td>
        <td class="pp"><input type="password" name="pw" id="pw"></td>
    </tr>
    <tr>
        <td class="tt ct">電話</td>
        <td class="pp"><input type="text" name="tel" id="tel"></td>
    </tr>
    <tr>
        <td class="tt ct">地址</td>
        <td class="pp"><input type="text" name="addr" id="addr"></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email"></td>
    </tr>
</table>
<div class="ct">
    <button onclick="reg()">註冊</button>
    <button onclick='clean()'>重置</button>
</div>
<script>
    function reg() {
        let user = {
            name: $("#name").val(),
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            tel: $("#tel").val(),
            addr: $("#addr").val(),
            email: $("#email").val(),
        }
        // acc 是物件的鍵（key），而 user.acc 是值（value）。
        // 這是因為你需要將用戶物件 user 的 acc 屬性的值傳遞給 chk_acc.php。
        $.get("./api/chk_acc.php", {acc: user.acc},(res) => {
            // 把acc參數是user的acc傳過去，有result的結果傳回來
            if (parseInt(res) == 1 || user.acc == 'admin') {
                // 代表已經有這個帳號
                alert(`此帳號${user.acc}已被使用`)
            } else {
                $.post("./api/reg.php", user, () => {
                    location.href = '?do=login'
                })
            }
        })
    }

    function chkacc() {
        let acc = $("#acc").val()
        $.get("./api/chk_acc.php", {acc}, (res) => {
            // 把acc傳過去有result的結果回來
            if (parseInt(res) == 1 || acc == 'admin') {
                // 代表已經有這個帳號
                alert(`此帳號${acc}已被使用`)
            } else {
                alert(`此帳號${acc}可以使用`)
            }
        })
    }

    function clean() {
        $("#name,#acc,#pw,#tel,#addr,#email").val('');
    }
</script>