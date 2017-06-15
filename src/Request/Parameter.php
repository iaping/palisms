<?php
/**
 * 参数基类
 *
 * User: APING
 * Date: 2017/06/15
 * Time: 22:24
 */

namespace Palisms\Request;

abstract class Parameter
{
    /**
     * 参数集合
     *
     * @var array
     */
    protected $collections = [];

    /**
     * 参数集合
     *
     * @return array
     */
    public function data()
    {
        return $this->collections;
    }

    /**
     * 键名进行升序排序
     *
     * @return $this
     */
    public function ksort()
    {
        ksort($this->collections);

        return $this;
    }

    /**
     * 取得参数
     *
     * @param $key
     * @return mixed|void
     */
    public function get($key)
    {
        if ((! $key) || (! array_key_exists($key, $this->collections))) {
            return;
        }

        return $this->collections[$key];
    }

    /**
     * 设置参数
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->collections[$key] = $value;

        return $this;
    }

    /**
     * 取得参数（魔术）
     *
     * @param $key
     * @return mixed|void
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * 设置参数（魔术）
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

}