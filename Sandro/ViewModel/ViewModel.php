<?php

namespace Devall\Sandro\ViewModel;

class ViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface {
    private $str;
    public function __construct(
    ) {
        $this->str = "this string is passed from the ViewModel";
    }
    public function getStr() {
        return $this->str;
    }
}
