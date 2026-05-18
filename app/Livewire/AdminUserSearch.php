<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class AdminUserSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'all';
    public $nameSort = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        // Apply verification filter
        if ($this->filter === 'verified') {
            $query->whereNotNull('email_verified_at');
        } elseif ($this->filter === 'not_verified') {
            $query->whereNull('email_verified_at');
        }

        // Apply name search - searches across first_name, middle_name, last_name
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', "%{$this->search}%")
                  ->orWhere('middle_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name', 'like', "%{$this->search}%");
            });
        }

        // Apply name sorting
        if ($this->nameSort === 'first_name') {
            $query->orderBy('first_name', 'asc');
        } elseif ($this->nameSort === 'middle_name') {
            $query->orderBy('middle_name', 'asc');
        } elseif ($this->nameSort === 'last_name') {
            $query->orderBy('last_name', 'asc');
        }

        $users = $query->paginate(10);

        return view('livewire.admin-user-search', compact('users'));
    }
}

