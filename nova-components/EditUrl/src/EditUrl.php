<?php

namespace SweetSpot\EditUrl;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class EditUrl extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'edit-url';

    protected function fillAttributeFromRequest(NovaRequest $request,
                                                $requestAttribute,
                                                $model,
                                                $attribute)
    {
        if ($request->exists($requestAttribute)) {
            unset($request[$requestAttribute]);
        }
    }
}
