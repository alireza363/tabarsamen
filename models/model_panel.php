<?php

class model_panel extends model
{
    private $user;

    function __construct()
    {
        parent::__construct();
        $this->user = self::sessionGet('user');
    }

    function getInfo()
    {
        $sql = 'select tbl_sahamdar.*, tbl_banks.bank_name
                from tbl_sahamdar
                LEFT JOIN tbl_banks
                ON tbl_sahamdar.Account_BankID=tbl_banks.bank_id
                WHERE id=?';
        $result = self::doselect($sql, [$this->user], 1);

        return $result;
    }

    function getbanks()
    {
        $sql = 'select * from tbl_banks';
        $result = self::doselect($sql);

        return $result;
    }

    function Editform($data, $id)
    {
        $mobile = $data['mobile'];
        $telephone = $data['telephone'];
        $post = $data['post'];
        $address = $data['address'];
        $account_no = $data['account_no'];
        $account_bankid = $data['account_bankid'];

        $sql = 'update tbl_sahamdar set mobile=?, telephone=?, post=?, address=?, Account_No=?, Account_BankID=? WHERE id=?';
        $values = [$mobile, $telephone, $post, $address, $account_no, $account_bankid, $id];
        $this->doquery($sql, $values);
    }

    function showMali()
    {
        $sql = 'select * from tbl_mali WHERE shomareh=?';
        $result = self::doselect($sql, [$this->user]);

        return $result;
    }

//    function addId()
//    {
//        $sql = 'select * from sahamdar';
//        $result = self::doselect($sql);
//        foreach ($result as $key=>$item) {
//            $No = $item['No_saham'];
//            $ps = $item['code_meli'];
//            if ($ps == null) {
//                $ps = $key;
//            }
//            $fname = $item['fname'];
//            $lname = $item['lname'];
//            $fd = $item['father'];
//            $cm = $item['code_meli'];
//            if ($cm == null) {
//                $cm = $key;
//            }
//            $td = $item['tedad_saham'];
//
//            $sql = 'insert into tbl_sahamdar ( No_saham, password, fname, lname, father, code_meli, tedad_saham) VALUES (?,?,?,?,?,?,?)';
//            $this->doquery($sql, [ $No, $ps, $fname, $lname, $fd, $cm, $td]);
//        }
//    }
}

?>