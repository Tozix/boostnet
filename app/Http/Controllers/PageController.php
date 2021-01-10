<?php

namespace BoostNet\Http\Controllers;

use Illuminate\Http\Request;
use BoostNet\Models\Page;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Page $page)
    {
        return view('page.show', compact('page'));
    }
}
