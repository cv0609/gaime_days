<?php
namespace App\Traits;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Request;

trait PaginationTrait {
public function paginate($items, $perPage = 5, $page = null,$path = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        $paginator = new LengthAwarePaginator($itemstoshow ,$total   ,$perPage);
        $paginator->setPath($path ?: Request::url());

        return $paginator;
    }
}
