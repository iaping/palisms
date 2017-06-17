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

        return strtoupper(md5($str . $secret));
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
    public static function json_encode($value, $error = null)
    {
        if (($json = json_encode($value)) === false) {
            throw new PalismsException($error ?: '无法编码数据为JSON');
        }

        return $json;
    }

    /**
     * json_decode
     *
     * @param string $json
     * @param bool $assoc
     * @param string $error
     * @return mixed
     * @throws \Exception
     */
    public static function json_decode($json, $assoc = true, $error = null)
    {
        if (! $data = json_decode($json, $assoc)) {
            throw new PalismsException(sprintf('%s：%s', $error ?: '无法解析JSON数据', $json));
        }

        return $data;
    }

}