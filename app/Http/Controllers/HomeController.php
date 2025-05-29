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

                case 'lessupervisee':
                    return view('pages.lessupervisee');

                case 'synthesesupervision':
                    return view('pages.synthesesupervision');
            }
        } catch (Throwable $t) {
            Log::info($t);
        }
    }

    public function pageviews($page)
    {
        try {
            switch ($page) {
                case 'register':
                    return view('auth.register');
                case 'login':
                    return view('auth.login');
                case 'dashboard':
                    return view('dashboard');

                case 'created':
                    return view('newpages.creationdesupervision');

                case 'etablissementsanitaire':
                    return view('newpages.etablissementsanitaire');

                case 'identifiantsuperviser':
                    return view('newpages.identifiantsuperviser');

                case 'identifiantsuperviseurs':
                    return view('newpages.idenfiantsuperviseurs');

                case 'synthesesupervision':
                    return view('newpages.synthesesupervision');

                case 'problemeprioritaire':
                    return view('newpages.problemeprioritaire');
                case 'environnementElement':
                    return view('newpages.environnementElement');

                case 'conpetanceElement':
                    return view('newpages.conpetanceElement');
            }
        } catch (Throwable $t) {
            Log::info($t);
        }
    }
}
