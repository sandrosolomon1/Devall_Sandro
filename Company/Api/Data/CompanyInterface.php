<?php

namespace Devall\Company\Api\Data;

use Magento\Tests\NamingConvention\true\mixed;

interface CompanyInterface
{
    /**
     * @return mixed | null
     */
    public function GetName();

    /**
     * @param string $name
     * @return void
     */
    public function SetName(string $name);
}
