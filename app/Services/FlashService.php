<?php

namespace App\Services;

class FlashService
{
    public function flashMessage($flashType, $flashMessage)
    {
        session()->flash('flash.message', $flashMessage);
        session()->flash('flash.type', $flashType);
    }
}

