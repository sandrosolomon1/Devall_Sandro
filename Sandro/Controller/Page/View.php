<?php
namespace Devall\Sandro\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\Page;

class View extends Action {
    public function execute()
    {
        $page = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);

        $block = $page->getLayout()->getBlock('sandro.task');
        $block->setdata('str','this string is passed from the Controller');

        return $page;
    }
}
