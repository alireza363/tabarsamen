<?php

class model
{
    public static $conn;

    function __construct()
    {
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'db_fibopj';
        $arr = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8');
        self::$conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbname, $username, $password, $arr);
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (function_exists('jdate') == false) {
            require('public/jdf/jdf.php');
        }
    }

    public static function sessionInit()
    {
        session_start();
    }

    public static function sessionSet($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function sessionGet($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }

    public static function doselect($sql, $params = [], $fetch = '', $fetchstyle = PDO::FETCH_ASSOC)
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($params as $key => $param) {
            $stmt->bindValue($key + 1, $param);
        }
        $stmt->execute();
        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchstyle);
        } else {
            $result = $stmt->fetch($fetchstyle);
        }

        return $result;
    }

    function doquery($sql, $params = [])
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($params as $key => $param) {
            $stmt->bindValue($key + 1, $param);
        }
        $stmt->execute();
    }

    public static function getcookie($name, $min)
    {
        if (isset($_COOKIE[$name])) {
            $cookie = $_COOKIE[$name];
        } else {
            $value = time() . rand(10000, 100000);//random value of cookie...
            $expire = time() + $min * 60;
            setcookie($name, $value, $expire, '/');
            if (isset($_COOKIE[$name])) {
                $cookie = $_COOKIE[$name];
            } else {
                $cookie = $value;
            }
        }

        return $cookie;
    }

    public static function userInfo($userId)
    {
        $sql = 'select * from tbl_users WHERE id=?';
        $result = self::doselect($sql, [$userId], 1);

        return $result;
    }

    public static function userLevel()
    {
        @self::sessionInit();
        $userId = self::sessionGet('user');
        $sql = 'select * from tbl_users WHERE id=?';
        $userInfo = self::doselect($sql, [$userId], 1);

        return $userInfo;
    }

    public static function jalaliDate($format = 'Y/n/j', $x = '')
    {
        $date = jdate($format, $x);
        return $date;
    }

    public static function jalalitoMilady($jalili, $format = '/')
    {
        $jalili = explode($format, $jalili);
        $y = $jalili[0];
        $m = $jalili[1];
        $d = $jalili[2];
        $miladi = jalali_to_gregorian($y, $m, $d);
        $miladi = implode('/', $miladi);
        $miladi = new DateTime($miladi);
        $miladi = $miladi->format('Y' . $format . 'm' . $format . 'd');

        return $miladi;
    }

    public static function miladitoJalili($miladi, $format = '/')
    {
        $miladi = explode($format, $miladi);
        $y = $miladi[0];
        $m = $miladi[1];
        $d = $miladi[2];
        $jalili = gregorian_to_jalali($y, $m, $d);
        $jalili = implode('/', $jalili);

        return $jalili;
    }

    function discount_calc($price, $discount)
    {
        $price_new = floor($price * (1 - ($discount / 100)));
        $discount_price = $price - $price_new;
        $result = ['price_new' => $price_new, 'discount_price' => $discount_price];

        return $result;
    }

    public static function getsettings()
    {
        $sql = 'select * from tbl_settings';
        $result = self::doselect($sql);

        $settings = [];
        foreach ($result as $row) {
            $setting = $row['setting_name'];
            $value = $row['setting_value'];
            $settings[$setting] = $value;
        }

        return $settings;
    }

    function getMenu($parentId = 0)
    {
        $sql = 'select * from tbl_category WHERE parentId=?';
        $result = self::doselect($sql, [$parentId]);

        foreach ($result as $row) {

            if (sizeof($row) > 0) {
                $children = $this->getMenu($row['id']);
                $row['children'] = $children;
            }
            @$data[] = $row;
        }

        return @$data;
    }

    public static function basketNum()
    {
        $cookie = self::getcookie('basket', 4320);
        $sql = 'select * from tbl_basket WHERE cookie=?';
        $result = self::doselect($sql, [$cookie]);
        $tedad = 0;

        foreach ($result as $row) {
            $tedad = $tedad + $row['tedad'];
        }

        return $tedad;
    }

    function getFile($file, $format, $size)
    {
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileTemp = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $Typeok = 0;
        if (in_array('jpg', $format) and $fileType == 'image/jpeg') {
            $Typeok = 1;
            $msg = '';
        } elseif ($Typeok == 0) {
            $msg = 'فرمت تصویر قابل قبول نیست.';
        }
        if (in_array('png', $format) and $fileType == 'image/png') {
            $Typeok = 1;
            $msg = '';
        } elseif ($Typeok == 0) {
            $msg = 'فرمت تصویر قابل قبول نیست.';
        }
        $Sizeok = 0;
        if ($fileSize < $size) {
            $Sizeok = 1;
        } else {
            $msg = 'اندازه تصویر قابل قبول نیست.';
        }
        $noError = 0;
        if (empty($fileError)) {
            $noError = 1;
        } else {
            $msg = '';
        }

        $uploadok = 0;
        if ($Typeok == 1 and $Sizeok == 1 and $noError == 1) {
            $uploadok = 1;
        }

        $data = ['upload' => $uploadok, 'name' => $fileName, 'temp' => $fileTemp, 'msg' => $msg];

        return $data;
    }

    function create_thumbnail($file, $pathToSave = '', $w = '', $h = '')
    {
        list($width, $height) = getimagesize($file);

        if ($h == '') {
            $h = $w * $height / $width;// tanasob giri $width/$height=$w/$h
        }

        if ($w == '') {
            $w = $h * $width / $height;// tanasob giri $width/$height=$w/$h
        }

        $what = getimagesize($file);
        switch (strtolower($what['mime'])) {
            case 'image/png':
                $src = imagecreatefrompng($file);
                break;
            case 'image/jpeg':
                $src = imagecreatefromjpeg($file);
                break;
            case 'image/gif':
                $src = imagecreatefromgif($file);
                break;
            default:
                //die();
        }

        $dst = imagecreatetruecolor($w, $h);//the new image

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);

        imagejpeg($dst, $pathToSave, 95);//pish farz in tabe 75 darsad quality ast

        return $dst;
    }

}

class helper
{
    private $url;
    private $api_key;
    const METHOD_POST = 'post';
    const METHOD_GET = 'get';
    /**
     * list of errors
     *
     * @var array
     */
    private $errors = array();

    /**
     * @param string $webserviceUrl
     * @param string $apiKey
     */
    public function __construct($webserviceUrl)
    {
        $this->url = $webserviceUrl;
        $this->api_key = 'F4960daa89D73A33332382fE661E7a18';
    }

    public function getPrices($des_city, $price, $weight, $buy_type, $delivery_type)
    {
        $params = array(
            'des_city' => $des_city,
            'price' => $price,
            'weight' => $weight,
            'buy_type' => $buy_type,
            'send_type' => $delivery_type
        );
        return $this->call('order/getPrices.json', $params);
    }


    private function call($url, $params, $methodType = helper::METHOD_POST)
    {
        // flush error list
        $this->errors = array();
        if (stripos($url, 'http://') === false)
            $url = $this->url . $url;
        $params['api'] = $this->api_key;
        $data = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, $methodType === helper::METHOD_POST);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        $result = json_decode($result, true);
        if (json_last_error() == JSON_ERROR_NONE)
            return $this->parseResponse($result);
        throw new FrotelResponseException('Failed to Parse Response (' . json_last_error() . ')');
    }

    /**
     * parse webservice response
     *
     * @param array $response
     * @return bool
     * @throws FrotelResponseException
     * @throws FrotelWebserviceException
     */
    private function parseResponse($response)
    {
        if (!isset($response['code'], $response['message'], $response['result']))
            throw new FrotelResponseException('پاسخ دریافتی از سرور معتبر نیست.');
        if ($response['code'] == 0)
            return $response['result'];
        $this->errors[] = $response['message'];
        throw new FrotelWebserviceException($response['message']);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}

class FrotelResponseException extends Exception
{
}

class FrotelWebserviceException extends Exception
{
}

?>