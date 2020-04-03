<?php

namespace Bighousecreative\RegistrationStatus;

use Laravel\Nova\Card;
use Carbon\Carbon;

class RegistrationStatus extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Indicates if registration is currently open.
     *
     * @return $this
     */
    public function currentRegistrationStatus()
    {
//        $today = new Carbon();
//        $opening_date = get_store_config('opening_date');
//        $closing_date = get_store_config('closing_date');

        $opening_date = 'opening_date';
        $closing_date = 'closing_date';
        $opening_time = 'opening_time';
        $closing_time = 'closing_time';

        return $this->withMeta([
            'opening_date'      => $opening_date,
            'closing_date'      => $closing_date,
            'opening_time'      => $opening_time,
            'closing_time'      => $closing_time,
            'registration_open' => true,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'registration_status';
    }
}
