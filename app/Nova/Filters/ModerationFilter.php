<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use App\ModerationStatus;

class ModerationFilter extends Filter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        if ($value == 'include') {
            return $query->withoutGlobalScope('pending')
                ->includeRejected();
        } else {
            return $query->withoutGlobalScope('pending')
                ->rejected();
        }
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'Include Rejected' => 'include',
            'Only Rejected' => 'only'
        ];
    }

    public $name = "Include Rejected";
}
