<?php

namespace SweetSpot\PendingSubmissions;

use Laravel\Nova\Card;

class PendingSubmissions extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Indicates that the analytics should show current visitors.
     *
     * @return $this
     */
    public function showButton($show = true)
    {
        return $this->withMeta(['showButton' => $show]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'pending-submissions';
    }
}
