<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Database\Eloquent\SoftDeletes;


class Table extends Resource
{
    use SoftDeletes;
    public function toArray($request)
    {
        return [
            'table_number' => $this->table_number,
        ];
    }
    protected $dates = ['deleted_at'];
}