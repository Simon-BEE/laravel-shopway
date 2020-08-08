<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Traits\Classify\IsFilterableWithLivewire;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, IsFilterableWithLivewire;

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
