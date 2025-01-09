<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function removeImages(): void
    {
        foreach ($this->images as $field) {
            Storage::delete($this->$field);
        }
    }
}
