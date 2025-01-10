<?php

namespace App\Livewire;

use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Layout;
use Livewire\Component;

class BoardShow extends Component
{
    public Board $board;

    public function mount()
    {
        $this->authorize('view', $this->board);
    }

    public function sorted(array $items)
    {
        // pluck out correct order of the ids, which is transferred as "value"
        $order = collect($items)->pluck('value')->toArray();
        // use sortable package to set the order
//        dd($order);
//        \App\Models\Column::setNewOrder($order); // this resets the order
        \App\Models\Column::setNewOrder($order, 1, 'id', function (Builder $query) {
            $query->where('user_id', auth()->id()); // only creator can sort
        });
    }

    public function moved(array $items)
    {
        // go over columns
        collect($items)->recursive()->each(function ($column) {
            $columnId = $column->get('value');
            // get order of cards inside each column
            $order = $column->get('items')->pluck('value')->toArray();
//            dd($order);
            // find all cards that have switched columns
            \App\Models\Card::where('user_id', auth()->id())
                ->find($order)
                ->where('column_id', '!=', $columnId)
                ->each->update([
                    'column_id' => $columnId
                ]);
//            \Log::info($cards);
            // update cards order
            \App\Models\Card::setNewOrder($order, 1, 'id', function (Builder $query) {
                $query->where('user_id', auth()->id());
            });
        });
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('frontend.boards.board-show', [
            'board' => $this->board,
            'columns' => $this->board->columns()->ordered()->get(),
        ]);
    }
}
