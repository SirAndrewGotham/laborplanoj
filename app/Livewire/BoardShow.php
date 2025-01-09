<?php

namespace App\Livewire;

use App\Models\Board;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BoardShow extends Component
{
    public Board $board;
    public function mount()
    {
        $this->authorize('view', $this->board);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('frontend.boards.board-show');
    }
}
