<?php
namespace App\Common;
/**
 * 容器 - 定义一个飞类
 */
class Fly
{
    /**
     * fly high
     * @var
     */
    public $high;
    public function __construct($high) {
        $this->high = $high;
    }
    public function say()
    {
        return '我飞了'. $this->high . '米';
    }
}
