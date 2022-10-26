<?php
namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Ad;

class AdComposer {

    public function compose(View $view) {
        $view->with('total', Ad::count());
    }
}
