<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Poster;

class AdminPosterSearchFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $tab = 'all';
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

    public $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Tabby'];

    public function mount()
    {
        $this->tab = request('tab', 'all');
    }

    public function render()
    {
        $query = Poster::query();

        // Apply tab-based filters
        if ($this->tab === 'lost') {
            $query->where('type', 'lost')->where('status', 'active');
        } elseif ($this->tab === 'found') {
            $query->where('type', 'found')->where('status', 'active');
        } elseif ($this->tab === 'reunited') {
            $query->where('status', 'reunited');
        }
        // For 'all' tab, no type/status filtering

        // Apply search first
        if ($this->search) {
            $query->where(function($q) {
                $q->where('pet_name', 'like', '%' . $this->search . '%')
                  ->orWhere('species', 'like', '%' . $this->search . '%')
                  ->orWhere('breed', 'like', '%' . $this->search . '%')
                  ->orWhere('gender', 'like', '%' . $this->search . '%')
                  ->orWhere('color_markings', 'like', '%' . $this->search . '%')
                  ->orWhere('user_id', 'like', '%' . $this->search . '%')
                  ->orWhere(function($subQ) {
                      $subQ->whereRaw("CONCAT('FND', LPAD(id, 4, '0')) LIKE ?", ['%' . $this->search . '%']);
                  });
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

        if ($this->date_from) {
            $query->where('date_lost_found', '>=', $this->date_from);
        }

        if ($this->date_to) {
            $query->where('date_lost_found', '<=', $this->date_to);
        }

        $posters = $query->latest()->paginate(15);

        return view('livewire.admin-poster-search-filter', compact('posters'));
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
        $this->search = '';
        $this->species = '';
        $this->breed = '';
        $this->gender = '';
        $this->selectedColors = [];
        $this->date_from = '';
        $this->date_to = '';
        $this->resetPage();
    }
}
