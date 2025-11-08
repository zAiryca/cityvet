<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Poster;

class PosterSearchFilter extends Component
{
    public $search = '';
    public $type = '';
    public $species = '';
    public $breed = '';
    public $gender = '';
    public $color = '';
    public $date_from = '';
    public $date_to = '';

    public $breeds = [
        'Canine' => ['Aspin', 'Puspin', 'Shih Tzu', 'Poodle', 'Golden Retriever', 'Labrador', 'German Shepherd', 'Bulldog', 'Beagle', 'Chihuahua'],
        'Feline' => ['Persian', 'Siamese', 'Maine Coon', 'British Shorthair', 'Ragdoll', 'Bengal', 'Sphynx', 'Abyssinian', 'Scottish Fold', 'Russian Blue']
    ];

    public $colors = ['Black', 'White', 'Brown', 'Gray', 'Orange', 'Cream', 'Blue', 'Red'];

    public function render()
    {
        $query = Poster::where('approved', true);

        // Apply filters
        if ($this->search) {
            $query->where('pet_name', 'like', '%' . $this->search . '%');
        }

        if ($this->type) {
            $query->where('type', $this->type);
        }

        if ($this->species) {
            $query->where('species', $this->species);
        }

        if ($this->breed) {
            $query->where('breed', 'like', '%' . $this->breed . '%');
        }

        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        if ($this->color) {
            $query->where('color_markings', 'like', '%' . $this->color . '%');
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
        $this->color = '';
        $this->date_from = '';
        $this->date_to = '';
        $this->resetPage();
    }
}
