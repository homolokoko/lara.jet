<?php

namespace App\Http\Controllers\Library\Search;

use App\Http\Controllers\Library\OptimizedSearch;
use App\Models\Configure\Styles;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

class EziOrderInfo extends OptimizedSearch
{
    public function getBuildQuery($searchTerm): Builder
    {
        $searchTerm = Str::of($searchTerm)->lower();
        return DB::query()
            ->select([
                'styleno as name',
                DB::raw("'style' as type"),
                DB::raw('CASE WHEN EXISTS (
            SELECT 1 FROM styles
            WHERE styles.name = tblorder_info.styleno
        ) THEN true ELSE false END as status')
            ])
            ->from('tblorder_info')
            ->whereRaw('LOWER(styleno) LIKE ?', [$searchTerm])
            ->union(
                DB::query()
                    ->select([
                        'orderno as name',
                        DB::raw("'order' as type"),
                        DB::raw('CASE WHEN EXISTS (
                    SELECT 1 FROM styles
                    WHERE styles.name = tblorder_info.orderno
                ) THEN true ELSE false END as status')
                    ])
                    ->from('tblorder_info')
                    ->whereRaw('LOWER(orderno) LIKE ?', [$searchTerm])
            )
            ->orderBy('name');
    }
    public function search($searchTerm, $limit)
    {
        // Validate and sanitize input
        $searchTerm = trim($searchTerm);

        // Use throttling to prevent abuse
        $results = Cache::remember(
            'search_' . md5($searchTerm),
            300, // 5 minutes
            fn() => $this->searchColumns($searchTerm, $limit)
        );

        return $results;
    }

}
