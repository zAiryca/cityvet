<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $role;
    protected $search;

    public function __construct($role = 'all', $search = null)
    {
        $this->role = $role;
        $this->search = $search;
    }

    public function collection()
    {
        $query = User::withCount(['adoptedPets', 'claimedPets', 'requests']);

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->role === 'user') {
            $query->where('role', 'user');
        } elseif ($this->role === 'admin') {
            $query->where('role', 'admin');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'First Name',
            'Middle Name',
            'Last Name',
            'Email',
            'Contact Number',
            'Street',
            'Barangay',
            'City/Municipality',
            'Province',
            'Emergency Contact',
            'Role',
            'Adopted Pets',
            'Claimed Pets',
            'Requests',
            'Joined Date',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->first_name,
            $user->middle_name,
            $user->last_name,
            $user->email,
            $user->contact_number,
            $user->street,
            $user->barangay,
            $user->city_municipality,
            $user->province,
            $user->emergency_contact,
            ucfirst($user->role),
            $user->adopted_pets_count,
            $user->claimed_pets_count,
            $user->requests_count,
            $user->created_at->format('M j, Y'),
        ];
    }
}
