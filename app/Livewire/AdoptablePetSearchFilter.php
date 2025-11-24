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
        $query = Pet::where('status', 'adoptable');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhere('display_code', 'like', '%' . $this->search . '%');
            });
        }

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
