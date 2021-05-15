<?php

namespace Devall\Company\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Devall\Company\Api\Data\CompanyInterface;

interface CompanyRepositoryInterface {

    /**
     * @param int $id
     * @return \Devall\Company\Api\Data\CompanyInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): \Devall\Company\Api\Data\CompanyInterface;

    /**
     * @param \Devall\Company\Api\Data\CompanyInterface $company
     * @return \Devall\Company\Api\Data\CompanyInterface
     */
    public function save(CompanyInterface $company): \Devall\Company\Api\Data\CompanyInterface;

    /**
     * @param \Devall\Company\Api\Data\CompanyInterface $company
     * @return void
     */
    public function delete(CompanyInterface $company);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Devall\Company\Api\Data\CompanySearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
