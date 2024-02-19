<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db03";
    // db+抽到的崗位號碼
    // protected $dsn = "mysql:host=localhost;charset=utf8;dbname=bquiz"; //資料庫
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
        // $this->pdo=new PDO($this->dsn,'s1120409','s1120409');
    }


    function all($where = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // all 方法用於從資料表中 擷取所有資料。
    // 它接受兩個可選參數 $where 和 $other，分別用於指定查詢的條件和其他條件。
    // 最後，使用 PDO 連線執行 SQL 查詢，並返回結果集。

    function count($where = '', $other = '')
    {
        $sql = "select count(*) from `$this->table` ";
        $sql = $this->sql_all($sql, $where, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    private function math($math, $col, $array = '', $other = '')
    {
        $sql = "select $math(`$col`)  from `$this->table` ";
        $sql = $this->sql_all($sql, $array, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col = '', $where = '', $other = '')
    {
        return $this->math('sum', $col, $where, $other);
    }
    function max($col, $where = '', $other = '')
    {
        return $this->math('max', $col, $where, $other);
    }
    function min($col, $where = '', $other = '')
    {
        return $this->math('min', $col, $where, $other);
    }

    function find($id)
    {
        $sql = "select * from `$this->table` ";

        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id`='$id'";
        }
        //echo 'find=>'.$sql;
        $row = $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // update or insert
    function save($array)
    {
        if (isset($array['id'])) {
            // $array = array('id' => 123, 'column1' => 'value1', 'column2' => 'value2');
            $sql = "update `$this->table` set ";

            if (!empty($array)) {
                $tmp = $this->a2s($array);
            }

            $sql .= join(",", $tmp);
            $sql .= " where `id`='{$array['id']}'";
        } else {
            // $array = array('column1' => 'value1', 'column2' => 'value2');
            $sql = "insert into `$this->table` ";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";

            $sql = $sql . $cols . " values " . $vals;
        }

        return $this->pdo->exec($sql);
    }

    function del($id)
    {
        $sql = "delete from `$this->table` where ";

        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " `id`='$id'";
        }
        //echo $sql;

        return $this->pdo->exec($sql);
    }

    /**
     * 可輸入各式SQL語法字串並直接執行
     */
    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function a2s($array)
    {
        foreach ($array as $col => $value) {
            $tmp[] = "`$col`='$value'";
        }
        return $tmp;
    }

    // sql_all 方法是一個私有方法，它被各個方法內部調用，用於組合 SQL 查詢語句。
    // 這個方法檢查資料表是否被設定且不是空的，然後根據條件和其他條件構建 SQL 語句。
    private function sql_all($sql, $array, $other)
    {

        if (isset($this->table) && !empty($this->table)) {

            if (is_array($array)) {

                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array";
            }

            $sql .= $other;
            // echo 'all=>'.$sql;
            // $rows = $this->pdo->query($sql)->fetchColumn();
            return $sql;
        }
    }
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function to($url)
{
    header("location:$url");
}

$Bottom = new DB('bottom');
$Mem = new DB('mem');
$Admin = new DB('admin');
$Type = new DB('type');
$Goods = new DB('goods');
$Orders = new DB('orders');


?>