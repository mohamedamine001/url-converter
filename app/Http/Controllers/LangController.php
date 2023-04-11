<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests\ChangeLangRequest;

class LangController extends Controller
{
    /**
     * Change locale.
     *
     * @return \Illuminate\Http\Response
    */
    public function change(ChangeLangRequest $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }
}
