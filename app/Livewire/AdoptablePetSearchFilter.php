<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pet;

class AdoptablePetSearchFilter extends Component
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

    public $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Tabby'];

    public function render()
    {
        $query = Pet::where('status', 'adoptable')->visibleToUsers()
            ->with('mostRecentReturn');

        // Apply search first
        if ($this->search) {
            $searchTerm = strtolower($this->search);
            $query->where(function($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(species) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(breed) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(gender) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(color_markings) LIKE ?', ['%' . $searchTerm . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        // Apply other filters
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
            foreach ($this->selectedColors as $color) {
                $query->where('color_markings', 'like', '%' . $color . '%');
            }
        }

        $pets = $query->paginate(12);

        return view('livewire.adoptable-pet-search-filter', [
            'pets' => $pets,
            'breeds' => $this->breeds,
            'colors' => $this->colors,
        ]);
    }

    public function updated($property)
    {
        if ($property === 'species') {
            $this->breed = '';
        }

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
