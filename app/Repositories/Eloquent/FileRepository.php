<?php

namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Models\User;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class FileRepository extends BaseRepository implements FileRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param File $model
     */
    public function __construct(File $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Collection
     */
    public function search(array $params = []): Collection
    {
        $query = User::query();

        $query->when($params['global'], function (Builder $query, string $global) {
            return $query->where(function (Builder $query) use ($global) {
                $query->where('name', 'LIKE', "%{$global}%")
                    ->orWhere('fullname', 'LIKE', "%{$global}%")
                    ->orWhere('email', 'LIKE', "%{$global}%")
                    ->orWhere('phone', 'LIKE', "%{$global}%");
            });
        })->when($params['not_user'], function (Builder $query, int $userid) {
            $query->where('id', '!=', $userid);
        });

        return $query->get();
    }

    public function save(array $attributes): File
    {
        $file = $this->model->create($attributes);

        return $file;
    }
}
