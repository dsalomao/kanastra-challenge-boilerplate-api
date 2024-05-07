<?php
namespace App\Repositories;

use App\Models\File;
use Illuminate\Support\Collection;

interface FileRepositoryInterface
{
    public function all(): Collection;

    public function search(array $params): Collection;

    public function save(array $attributes): File;
}
