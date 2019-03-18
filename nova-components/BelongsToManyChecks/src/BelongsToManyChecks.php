<?php

namespace SweetSpot\BelongsToManyChecks;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class BelongsToManyChecks extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'belongs-to-many-checks';

    /**
     * Populate the list of available checkboxes
     *
     * @param  array  $hues
     * @return $this
     */
    public function checks(array $checks)
    {
        return $this->withMeta(['checks' => $checks]);
    }

    public function populateWith($val)
    {
        // dump($val);
        return $this->withMeta(['populateWith' => $val]);
    }

    public function selected($val)
    {
        // dump($val);
        return $this->withMeta(['selected' => $val]);
    }

    public function relationship(string $rel)
    {
        return $this->withMeta(['rel' => $rel]);
    }

    public function groupBy(string $groupBy)
    {

        return $this->withMeta(['groupBy', $groupBy]);
    }


    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request,
                                                $requestAttribute,
                                                $model,
                                                $attribute)
    {
        if ($request->exists($requestAttribute)) {
            if ($request[$requestAttribute]) {
                $ids = explode(',',$request[$requestAttribute]);
            } else {
                $ids = [];
            }
            
            $model->amenities()->sync($ids);
            unset($request[$requestAttribute]);
        }
    }

    /**
     * Resolve the field's value.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        $attribute = $attribute ?? $this->attribute;

        if ($attribute instanceof Closure ||
           (is_callable($attribute) && is_object($attribute))) {
            return $this->resolveComputedAttribute($attribute);
        }

        if (! $this->resolveCallback) {
            $this->value = $this->resolveAttribute($resource, $attribute);
        } elseif (is_callable($this->resolveCallback)) {
            $value = data_get($resource, str_replace('->', '.', $attribute), $placeholder = new \stdClass());

            if ($value !== $placeholder) {
                $this->value = call_user_func($this->resolveCallback, $value, $resource);
            }
        }
    }

}
