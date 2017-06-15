<?php
/**
 * 加解密/编解码
 *
 * User: aping
 * Date: 2017/06/15
 * Time: 22:57
 */

namespace Palisms;

use Palisms\Exception\PalismsException;

class EncryptionDecryption
{
    /**
     * 签名
     *
     * @param array $data
     * @param string $secret
     * @return string
     */
    public static function sign(array $data, $secret = '')
    {
        $str = $secret;

        foreach ($data as $key => $val) {
            $str .= $key . $val;
        }

        return self::string2Hex(md5($str . $secret));
    }

    /**
     * 字符串转16进制
     *
     * @param $str
     * @return string
     */
    public static function string2Hex($str)
    {
        $hex='';

        for ($i=0; $i < strlen($str); $i++){
            $hex .= dechex(ord($str[$i]));
        }

        return $hex;
    }

    /**
     * json_encode
     *
     * @param $value
     * @return bool
     * @throws \Exception
     */
    public static function json_encode($value)
    {
        if (($json = json_encode($value)) === false) {
            throw new PalismsException(json_last_error_msg());
        }

        return $json;
    }

    /**
     * json_decode
     *
     * @param $json
     * @param bool $assoc
     * @return mixed
     * @throws \Exception
     */
    public static function json_decode($json, $assoc = true)
    {
        if (! $data = json_decode($json, $assoc)) {
            throw new PalismsException(json_last_error_msg());
        }

        return $data;
    }

}