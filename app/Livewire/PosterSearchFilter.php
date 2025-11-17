<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Poster;

class PosterSearchFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';
    public $species = '';
    public $breed = '';
    public $gender = '';
    public $selectedColors = [];
    public $date_from = '';
    public $date_to = '';

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
        $query = Poster::where('approved', true)->where('status', 'active');

        // Apply filters
        if ($this->search) {
            $query->where(function($q) {
                $q->where('pet_name', 'like', '%' . $this->search . '%')
                  ->orWhere(function($subQ) {
                      $subQ->where('type', 'found')
                           ->whereRaw("CONCAT('FND', LPAD(id, 4, '0')) LIKE ?", ['%' . $this->search . '%']);
                  });
            });
        }

        if ($this->type) {
            $query->where('type', $this->type);
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
            $query->where(function($q) {
                foreach ($this->selectedColors as $color) {
                    $q->orWhere('color_markings', 'like', '%' . $color . '%');
                }
            });
        }

        if ($this->date_from) {
            $query->where('date_lost_found', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->where('date_lost_found', '<=', $this->date_to);
        }

        $posters = $query->latest()->paginate(12);

        return view('livewire.poster-search-filter', compact('posters'));
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
        $this->search = '';
        $this->type = '';
        $this->species = '';
        $this->breed = '';
        $this->gender = '';
        $this->selectedColors = [];
        $this->date_from = '';
        $this->date_to = '';
        $this->resetPage();
    }
}
