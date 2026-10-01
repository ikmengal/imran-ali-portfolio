<?php

namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Filterable
{
    protected function applyFilters(Builder $query, Request $request, array $filters = []): Builder
    {
        foreach ($filters as $filter) {
            $this->applyFilter($query, $request, $filter);
        }

        return $query;
    }

    protected function applyFilter(Builder $query, Request $request, array $filter): void
    {
        $name = $filter['name'];
        $type = $filter['type'] ?? 'select';
        $column = $filter['column'] ?? $name;
        $value = $request->get($name);

        if ($value === null || $value === '') {
            return;
        }

        switch ($type) {
            case 'select':
            case 'boolean':
                $query->where($column, $value);
                break;

            case 'search':
                $query->where($column, 'LIKE', "%{$value}%");
                break;

            case 'date_from':
                $query->whereDate($column, '>=', $value);
                break;

            case 'date_to':
                $query->whereDate($column, '<=', $value);
                break;

            case 'date_range':
                if (is_array($value) && count($value) === 2) {
                    $query->whereBetween($column, [$value[0], $value[1]]);
                }
                break;

            case 'multi_select':
                if (is_array($value) && count($value) > 0) {
                    $query->whereIn($column, $value);
                }
                break;

            case 'custom':
                if (isset($filter['callback'])) {
                    ($filter['callback'])($query, $value);
                }
                break;
        }
    }

    protected function getFilterOptions(string $model, string $column): array
    {
        return $model::query()
            ->select($column)
            ->distinct()
            ->pluck($column)
            ->filter()
            ->values()
            ->toArray();
    }
}