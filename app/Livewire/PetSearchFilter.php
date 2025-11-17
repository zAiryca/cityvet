<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pet;

class PetSearchFilter extends Component
{
    use WithPagination;

    public $species = '';
    public $breed = '';
    public $gender = '';
    public $selectedColors = [];
    public $search = '';

    public $breeds = [
        'Canine' => [
            'Aspin',
            'Poodle',
            'Shih Tzu',
            'Maltese',
            'Pug',
            'Beagle',
            'Cocker Spaniel',
            'Labrador Retriever',
            'German Shepherd',
            'Golden Retriever'
        ],
        'Feline' => [
            'Philippine Domestic Cat',
            'Siamese',
            'Persian',
            'Maine Coon',
            'British Shorthair',
            'Ragdoll',
            'Bengal',
            'Scottish Fold',
            'Abyssinian',
            'Russian Blue'
        ]
    ];

    public $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Red', 'Tabby'];

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

        if (!empty($this->selectedColors)) {
            $query->where(function($q) {
                foreach ($this->selectedColors as $color) {
                    $q->orWhere('color_markings', 'like', '%' . $color . '%');
                }
            });
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filter by status based on current route or admin status filter
        $currentRoute = request()->route()->getName();
        if ($currentRoute === 'pets.adoptable') {
            $query->where('status', 'adoptable');
        } elseif ($currentRoute === 'pets.impounded') {
            $query->where('status', 'impounded');
        } elseif ($currentRoute === 'admin.pets.index') {
            // For admin pets index, apply status filter from query parameter
            $status = request()->get('status');
            if ($status) {
                $query->where('status', $status);
            }
        }

        $pets = $query->paginate(12);

        return view('livewire.pet-search-filter', compact('pets'));
    }

    public function updated($property)
    {
        // If species changes, reset breed
        if ($property === 'species') {
            $this->breed = '';
        }

        // Reset pagination when filters change
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->species = '';
        $this->breed = '';
        $this->gender = '';
        $this->selectedColors = [];
        $this->search = '';
        $this->resetPage();
    }
}
