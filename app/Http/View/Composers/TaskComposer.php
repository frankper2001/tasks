<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Task;

class TaskComposer{
    // metodo que vincula la informacion a la vista
    public function compose(View $view){
        $view->with('total', Task::count());
    }
}

?>