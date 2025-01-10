<?php

namespace App\Livewire\Boards;

use App\Livewire\Forms\EditColumn;
use Livewire\Component;

class Column extends Component
{
    public \App\Models\Column $column;
    public EditColumn $editColumnForm;

    public function mount()
    {
        $this->editColumnForm->name = $this->column->name;
    }

    public function updateColumn()
    {
        $this->editColumnForm->validate();

        $this->column->update($this->editColumnForm->only('name'));

        $this->dispatch('column-updated');
    }

    public function render()
    {
        return view('frontend.boards.column', [
            'cards' => $this->column->cards()->ordered()->get(),
        ]);
    }
}
