<?php
/**
 * 向指定手机号码发送模板短信
 * https://help.aliyun.com/document_detail/55451.html?spm=5176.sms-account.109.2.26b81793F8d7lP
 *
 * User: APING
 * Date: 2017/09/23
 * Time: 14:33
 */

namespace Palisms\Request\V20170525;

use Palisms\EncryptionDecryption;
use Palisms\Exception\PalismsException;
use Palisms\Request\Request;

class SendRequest extends Request
{
    /**
     * API的命名
     *
     * @return string
     */
    protected function action()
    {
        return 'SendSms';
    }

    /**
     * 短信接收号码，必填
     * 支持单个或多个手机号码，传入号码为11位手机号码，不能加0或+86。群发短信需传入多个号码，以英文逗号分隔，一次调用最多传入200个号码。
     * 示例：18600000000 或 [13911111111,13322222222]
     *
     * @param $phoneNumbers
     * @return $this
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        $phoneNumbers = is_array($phoneNumbers) ? $phoneNumbers : [$phoneNumbers];

        return $this->set('PhoneNumbers', implode(',', $phoneNumbers));
    }

    /**
     * 短信签名，必填
     *
     * @param $signName
     * @return $this
     */
    public function setSignName($signName)
    {
        return $this->set('SignName', $signName);
    }

    /**
     * 短信模板ID，必填
     * 示例：SMS_585014
     *
     * @param $templateCode
     * @return $this
     */
    public function setTemplateCode($templateCode)
    {
        return $this->set('TemplateCode', $templateCode);
    }

    /**
     * 短信模板变量
     * 传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开。
     * 示例：针对模板“验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”，传参时需传入{"code":"1234","product":"alidayu"}
     *
     * @param $TemplateParam
     * @return $this
     */
    public function setTemplateParam(array $TemplateParam)
    {
        if (! count($TemplateParam)) {
            return $this;
        }
        //参数值全部转换为string
        array_map(function ($val) {
            return (string) $val;
        }, $TemplateParam);

        return $this->set('TemplateParam', EncryptionDecryption::json_encode($TemplateParam, '短信模板变量无法编码为JSON'));
    }

    /**
     * 外部流水扩展字段
     *
     * @param $extend
     * @return $this
     */
    public function setOutId($outId)
    {
        return $this->set('OutId', $outId);
    }

    /**
     * impl
     *
     * @return $this
     * @throws PalismsException
     */
    public function check()
    {
        if (is_null($this->PhoneNumbers)) {
            throw new PalismsException('短信接收号码未设置(PhoneNumbers)');
        }

        if (is_null($this->SignName)) {
            throw new PalismsException('短信签名未设置(SignName)');
        }

        if (is_null($this->TemplateCode)) {
            throw new PalismsException('短信模板未设置(TemplateCode)');
        }
    }

}