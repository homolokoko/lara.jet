<?php

namespace App\Http\Controllers\Library;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Query\Builder;

class OptimizedSearch
{
    private string $cachePrefix = 'search_results_';
    private int $cacheDuration = 3600; // 1 hour

    public function getBuildQuery($searchTerm): Builder
    {
        return DB::query()
            ->select([
                'column_a as name',
                DB::raw("'table1' as type")
            ])
            ->from(DB::raw('table1 USE INDEX (idx_column_a)'))
            ->where('column_a', 'LIKE', $searchTerm);
    }
    public function searchColumns(string $searchTerm, int $limit = 100): array
    {
        // 1. Early return for empty search
        if (empty($searchTerm)) {
            return [];
        }

        // 2. Generate cache key
        $cacheKey = $this->cachePrefix . md5($searchTerm . $limit);

        // 3. Try to get from cache first
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // 4. Prepare search term (minimum 3 characters for better performance)
        if (strlen($searchTerm) < 3) {
            return [];
        }

        $searchTerm = '%' . $searchTerm . '%';

        // 5. Execute optimized query
        $results = $this->queryResult($searchTerm, $limit);

        // 6. Cache results
        Cache::put($cacheKey, $results, $this->cacheDuration);

        return $results;
    }

    /**
     * @param  string  $searchTerm
     * @param  int  $limit
     * @return array
     */
    public function queryResult(string $searchTerm, int $limit): array
    {
        return $this->getBuildQuery($searchTerm)
            ->limit($limit)
            ->get()
            ->toArray();
    }
}
