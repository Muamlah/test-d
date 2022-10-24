<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Admin */
class LogCollection extends ResourceCollection
{

    // public $collects = \App\Models\Log::class;

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);

    }

    public function with($request):array
    {
        return [
        'meta' => [
            'page' => $request->input('pagination.page'),
            'pages' => $request->input('pages'),
            'perpage' => $request->input('pagination.perpage'),
            'total' => $request->input('total'),
            'sort' => $request->input('pagination.sort'),
            'field' => $request->input('pagination.field'),
            'query' => $request->input('pagination.query'),
        ],
    ];
    }
}
