<?php
/**
 * 向指定手机号码发送模板短信
 * https://api.alidayu.com/docs/api.htm?spm=a3142.7395905.4.6.OuKgjc&apiId=25450
 *
 * User: APING
 * Date: 2017/06/15
 * Time: 23:21
 */

namespace Palisms\Request\Sms;

use Palisms\Exception\PalismsException;
use Palisms\Request\Request;

class NumSendRequest extends Request
{
    /**
     * impl
     */
    public function method()
    {
        return 'alibaba.aliqin.fc.sms.num.send';
    }

    /**
     * 公共回传参数
     * 在“消息返回”中会透传回该参数；举例：用户可以传入自己下级的会员ID，
     * 在消息返回时，该会员ID会包含在内，用户可以根据该会员ID识别是哪位会员使用了你的应用
     *
     * @param $extend
     * @return $this
     */
    public function setExtend($extend)
    {
        return $this->set('extend', $extend);
    }

    /**
     * 短信类型
     * 传入值请填写normal
     *
     * @param $smsType
     * @return $this
     */
    protected function setSmsType($smsType = 'normal')
    {
        return $this->set('sms_type', $smsType);
    }

    /**
     * 短信签名
     * 传入的短信签名必须是在阿里大于“管理中心-验证码/短信通知/推广短信-配置短信签名”中的可用签名。
     * 如“阿里大于”已在短信签名管理中通过审核，则可传入”阿里大于“（传参时去掉引号）作为短信签名。
     * 短信效果示例：【阿里大于】欢迎使用阿里大于服务。
     *
     * @param $smsFreeSignName
     * @return $this
     */
    public function setSmsFreeSignName($smsFreeSignName)
    {
        return $this->set('sms_free_sign_name', $smsFreeSignName);
    }

    /**
     * 短信模板变量
     * 传参规则{"key":"value"}，key的名字须和申请模板中的变量名一致，多个变量之间以逗号隔开。
     * 示例：针对模板“验证码${code}，您正在进行${product}身份验证，打死不要告诉别人哦！”，传参时需传入{"code":"1234","product":"alidayu"}
     *
     * @param $smsParam
     * @return $this
     */
    public function setSmsParam($smsParam)
    {
        return $this->set('sms_param', $smsParam);
    }

    /**
     * 短信接收号码
     * 支持单个或多个手机号码，传入号码为11位手机号码，不能加0或+86。群发短信需传入多个号码，以英文逗号分隔，一次调用最多传入200个号码。
     * 示例：18600000000,[13911111111,13322222222]
     *
     * @param $recNum
     * @return $this
     */
    public function setRecNum($recNum)
    {
        if (! is_array($recNum)) {
            $recNum = [$recNum];
        }

        return $this->set('rec_num', implode(',', $recNum));
    }

    /**
     * 短信模板ID
     * 传入的模板必须是在阿里大于“管理中心-短信模板管理”中的可用模板。
     * 示例：SMS_585014
     *
     * @param $smsTemplateCode
     * @return $this
     */
    public function setSmsTemplateCode($smsTemplateCode)
    {
        return $this->set('sms_template_code', $smsTemplateCode);
    }

    /**
     * impl
     *
     * @return void
     */
    protected function init()
    {
        $this->setSmsType();
    }

    /**
     * impl
     *
     * @return $this
     * @throws PalismsException
     */
    public function check()
    {
        if ($this->sms_type !== 'normal') {
            throw new PalismsException('短信类型请填写normal');
        }

        if (is_null($this->sms_free_sign_name)) {
            throw new PalismsException('短信签名未设置');
        }

        if (is_null($this->rec_num)) {
            throw new PalismsException('短信接收号码未设置');
        }

        if (is_null($this->sms_template_code)) {
            throw new PalismsException('短信模板未设置');
        }
    }

}