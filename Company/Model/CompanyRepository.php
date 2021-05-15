<?php
namespace Devall\Company\Model;

use Devall\Company\Api\CompanyRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Devall\Company\Api\Data\CompanyInterface;
use Devall\Company\Api\Data\CompanySearchResultInterface;
use Devall\Company\Api\Data\CompanySearchResultInterfaceFactory;
use Devall\Company\Model\ResourceModel\Company\CollectionFactory as CompanyCollectionFactory;
use Devall\Company\Model\ResourceModel\Company\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @var CompanyFactory
     */
    private $companyfactory;

    /**
     * @var CompanyCollectionFactory
     */
    private $companycollectionfactory;

    /**
     * @var CompanySearchResultInterfaceFactory
     */
    private $companysearchresultinterfacefactory;

    /**
     * CompanyRepository constructor.
     * @param CompanyFactory $companyfactory
     * @param CompanyCollectionFactory $companycollectionfactory
     * @param CompanySearchResultInterfaceFactory $companysearchresultinterfacefactory
     */
    public function __construct
    (
        CompanyFactory $companyfactory,
        CompanyCollectionFactory $companycollectionfactory,
        CompanySearchResultInterfaceFactory $companysearchresultinterfacefactory
    )
    {
        $this->companyfactory = $companyfactory;
        $this->companycollectionfactory = $companycollectionfactory;
        $this->companysearchresultinterfacefactory = $companysearchresultinterfacefactory;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function getById($id): CompanyInterface
    {
        $company = $this->companyfactory->create();
        $company->getResource()->load($company, $id);
        if (! $company->getId()) {
            throw new NoSuchEntityException(__('Unable to find hamburger with ID "%1"', $id));
        }
        return $company;
    }

    public function save(CompanyInterface $company): CompanyInterface
    {
        $company->getResource()->save($company);
        return $company;
    }

    public function delete(CompanyInterface $company)
    {
        $company->getResource()->delete($company);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

}
