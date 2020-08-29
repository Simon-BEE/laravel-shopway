<?php

namespace App\Traits\Livewire;

use Illuminate\Support\Str;

trait HasFlashMessage
{
    /**
     * Generate a new event to create a flash message
     *
     * @param string $message
     * @param string $type MUST BE SUCCESS or ERROR
     * @return void
     */
    public function newFlashMessage(string $message, string $type = 'success')
    {
        if ($type !== 'success' && $type !== 'error') {
            $type = 'success';
        }

        $this->emit('flashMessage', [
            'type' => $type,
            'message' => $message,
            'id' => Str::random(10)
        ]);
    }
}