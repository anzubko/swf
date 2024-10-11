<?php
declare(strict_types=1);

namespace App\Shared;

use SWF\Paginator as SWFPaginator;

class Paginator
{
    /**
     * Calculates page-by-page navigation.
     */
    public function calc(int $totalEntries, int $entriesPerPage, int $pagesPerSet, int $currentPage): SWFPaginator
    {
        return new SWFPaginator($totalEntries, $entriesPerPage, $pagesPerSet, $currentPage);
    }
}
