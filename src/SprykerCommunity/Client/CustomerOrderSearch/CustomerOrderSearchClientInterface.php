<?php

namespace SprykerCommunity\Client\CustomerOrderSearch;

interface CustomerOrderSearchClientInterface
{
    /**
     * @param string $searchString
     * @param array<string, mixed> $requestParameters
     *
     * @return array
     */
    public function search(string $searchString, array $requestParameters): array;

    /**
     * @param string $searchString
     * @param array<string, mixed> $requestParameters
     *
     * @return int
     */
    public function searchCount(string $searchString, array $requestParameters): int;
}
