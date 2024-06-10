<?php

class model_adminsetting extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function saveSetting($data, $num)
    {
        if ($num == 1) {
            foreach ($data as $settingName => $value) {
                $sql = 'update tbl_settings set setting_value=? WHERE setting_name=?';
                $values = [$value, $settingName];
                $this->doquery($sql, $values);
            }
        }
        if ($num == 2) {
            $sql = 'select * from tbl_settings';
            $result = self::doselect($sql);
            foreach ($result as $row) {

                $settingName = $row['setting_name'];
                $value = $row['default_setting'];

                if ($value != '') {
                    $sql = 'update tbl_settings set setting_value=? WHERE setting_name=?';
                    $values = [$value, $settingName];
                    $this->doquery($sql, $values);
                }
            }
        }

    }

}

?>