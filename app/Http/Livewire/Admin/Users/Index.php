<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Users\User;
use App\Traits\Livewire\IsFilterable;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, IsFilterable;

    public function mount()
    {
        $this->sortField = 'id';
        $this->sortAsc = false;
    }

    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::where('firstname', 'like' , "%$this->searchTerm%")
                ->orWhere('lastname', 'like' , "%$this->searchTerm%")
                ->orWhere('email', 'like' , "%$this->searchTerm%")
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
            ,
        ]);
    }
}
