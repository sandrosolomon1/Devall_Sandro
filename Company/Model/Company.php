<?php

namespace Devall\Company\Model;

use Devall\Company\Api\Data\CompanyInterface;

class Company extends \Magento\Framework\Model\AbstractModel implements CompanyInterface {
    const NAME = 'name';

    protected function _construct()
    {
        $this->_init('Devall\Company\Model\ResourceModel\Company');
    }

    public function GetName()
    {
        return $this->_getData(self::NAME);
    }

    public function SetName($name)
    {
        $this->setData(self::NAME);
    }

}
