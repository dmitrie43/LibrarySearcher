<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasFile
{
    public function removeFiles(): void
    {
        foreach ($this->files as $field) {
            $this->removeFile($field);
        }
    }

    public function removeFile(string $field): void
    {
        if (! empty($this->getRawOriginal($field))) {
            Storage::delete($this->getRawOriginal($field));
        }
    }
}
