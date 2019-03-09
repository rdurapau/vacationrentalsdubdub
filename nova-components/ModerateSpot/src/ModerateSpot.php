<?php

namespace SweetSpot\ModerateSpot;

use Laravel\Nova\ResourceTool;

class ModerateSpot extends ResourceTool
{
    /**
     * Get the displayable name of the resource tool.
     *
     * @return string
     */
    public function name()
    {
        return 'Moderation';
    }

    /**
     * Get the component name for the resource tool.
     *
     * @return string
     */
    public function component()
    {
        return 'moderate-spot';
    }
}
