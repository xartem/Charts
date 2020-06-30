<?php

namespace ConsoleTVs\Charts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ChartsController extends BaseController
{
    public function __invoke(Request $request)
    {
        $chartRouteName = Str::afterLast($request->path(), '/');

        if (! ($chartClass = Cache::get(config('charts.cache_key_prefix') . '.' . $chartRouteName))) {
            abort(404);
        }

        $chart = new $chartClass();

        return new JsonResponse($chart->handler($request)->toObject());
    }
}