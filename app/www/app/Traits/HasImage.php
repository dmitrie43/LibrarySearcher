<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function removeImages(): void
    {
        foreach ($this->images as $field) {
            $this->removeImage($field);
        }
    }

    public function removeImage(string $field): void
    {
        if (! empty($this->getOriginal($field))) {
            Storage::delete($this->getOriginal($field));
        }
    }
}
