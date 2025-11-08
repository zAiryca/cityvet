<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pet;

class PetSearchFilter extends Component
{
    public $species = '';
    public $breed = '';
    public $gender = '';
    public $color = '';
    public $search = '';

    public $breeds = [
        'Canine' => ['Aspin', 'Puspin', 'Shih Tzu', 'Poodle', 'Golden Retriever', 'Labrador', 'German Shepherd', 'Bulldog', 'Beagle', 'Chihuahua'],
        'Feline' => ['Persian', 'Siamese', 'Maine Coon', 'British Shorthair', 'Ragdoll', 'Bengal', 'Sphynx', 'Abyssinian', 'Scottish Fold', 'Russian Blue']
    ];

    public $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange'];

    public function render()
    {
        $query = Pet::query();

        // Apply filters
        if ($this->species) {
            $query->where('species', $this->species);
        }

        if ($this->breed) {
            $query->where('breed', $this->breed);
        }

        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        if ($this->color) {
            $query->where('color_markings', 'like', '%' . $this->color . '%');
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filter by status based on current route
        $currentRoute = request()->route()->getName();
        if ($currentRoute === 'pets.adoptable') {
            $query->where('status', 'adoptable');
        } elseif ($currentRoute === 'pets.impounded') {
            $query->where('status', 'impounded');
        }

        $pets = $query->paginate(12);

        return view('livewire.pet-search-filter', compact('pets'));
    }

    public function updated($property)
    {
        // Reset pagination when filters change
        $this->resetPage();
    }
}
