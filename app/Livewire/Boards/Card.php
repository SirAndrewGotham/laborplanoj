<?php

namespace App\Livewire\Boards;

use Livewire\Component;

class Card extends Component
{
    public \App\Models\Card $card;
    public function render()
    {
        return view('frontend.boards.card');
    }
}
