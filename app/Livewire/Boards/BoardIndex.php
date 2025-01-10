<?php

namespace App\Livewire\Boards;

use Livewire\Attributes\Layout;
use Livewire\Component;



class BoardIndex extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('frontend.boards.board-index');
    }
}
