<?php
namespace Devall\Sandro\Block\Page;

use Magento\Framework\View\Element\Template;

class View extends Template {
    public function getStr(): string {
        return 'this string is passed from the Block';
    }
}
