<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'url', 'category', 'image', 'sort_order', 'is_active'])]
class Project extends Model
{
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }

    public function domain(): string
    {
        $host = parse_url($this->url, PHP_URL_HOST);

        return $host ? preg_replace('/^www\./', '', $host) : $this->url;
    }
}
