<?php

namespace App\Livewire;

use App\Models\PetRegistration;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPetRegistrationSearchFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $species = '';
    public $breed = '';
    public $gender = '';
    public $selectedColors = [];

    protected $breeds = [
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

    protected $colors = [
        'Black',
        'White',
        'Brown',
        'Gray',
        'Orange',
        'Cream',
        'Tabby'
    ];

    public function render()
    {
        $query = PetRegistration::query();

        // Filter by search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('pet_name', 'like', '%' . $this->search . '%')
                  ->orWhere('display_pet_id', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // Filter by species
        if ($this->species) {
            $query->where('species', $this->species);
        }

        // Filter by breed
        if ($this->breed) {
            $query->where('breed', $this->breed);
        }

        // Filter by gender
        if ($this->gender) {
            $query->where('gender', $this->gender);
        }

        // Filter by status from URL parameter
        $status = request()->get('registration_status');
        if ($status) {
            $query->where('status', $status);
        }

        // Filter by selected colors
        if (!empty($this->selectedColors)) {
            foreach ($this->selectedColors as $color) {
                $query->where('color_markings', 'like', '%' . $color . '%');
            }
        }

        $petRegistrations = $query->paginate(12);

        return view('livewire.admin-pet-registration-search-filter', [
            'petRegistrations' => $petRegistrations,
            'breeds' => $this->breeds,
            'colors' => $this->colors,
        ]);
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->species = '';
        $this->breed = '';
        $this->gender = '';
        $this->selectedColors = [];
    }
}
