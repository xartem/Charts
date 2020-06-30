<?php

namespace ConsoleTVs\Charts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ChartsController extends BaseController
{
    public function __invoke(BaseChart $chart, Request $request)
    {
        return new JsonResponse($chart->handler($request)->toObject());
    }
}