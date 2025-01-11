<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class HomeController extends Controller
{

    public function getpage($page)
    {
        try {
            switch ($page) {
                case 'index':
                    return view('welcome');
                case 'supervision':
                    return view('pages.supervision');
                case 'outildesupervision':
                    return view('pages.outildesupervision');

                    case'lessupervisee':
                        return view('pages.lessupervisee');

                        case 'synthesesupervision':
                            return view('pages.synthesesupervision');
            }
        } catch (Throwable $t) {
            Log::info($t);
        }
    }
}
