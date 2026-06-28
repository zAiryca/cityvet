@extends('layouts.app')

@section('title', '| ' . $pet->display_code)

@section('content')
<style>
    .pet-details-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: calc(100vh - 70px);
    }

    .pet-header-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-radius: 12px;
        padding: 24px;
    }

    .pet-main-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        padding: 24px;
    }

    .pet-info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    .pet-info-item {
        margin-bottom: 16px;
    }

    .pet-info-label {
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .pet-info-value {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-top: 4px;
    }

    .photo-container {
        width: 280px;
        height: 280px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .photo-container:hover {
        transform: scale(1.05);
    }

    .photo-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        white-space: nowrap;
    }

    .btn-adopt {
        background: linear-gradient(135deg, #111827 0%, #059669 100%);
        color: white;
    }

    .btn-adopt:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
    }

    .btn-claim {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: white;
    }

    .btn-claim:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 14px;
    }

    .status-adoptable {
        background: #c6f6d5;
        color: #059669;
    }

    .status-impounded {
        background: #fecaca;
        color: #dc2626;
    }

    .timeline-item {
        display: flex;
        gap: 12px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #e2e8f0;
    }

    .timeline-item:last-child {
        border-bottom: none;
    }

    .timeline-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin-top: 4px;
        flex-shrink: 0;
    }

    .timeline-content p {
        margin: 0;
        font-size: 13px;
    }

    .timeline-label {
        font-weight: 600;
        color: #64748b;
        font-size: 11px;
        text-transform: uppercase;
    }

    .timeline-value {
        color: #1e293b;
        font-weight: 600;
        margin-top: 2px;
    }

    .alert-box {
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 16px;
        border-left: 4px solid;
    }

    .alert-warning {
        background: #fef3c7;
        border-color: #f59e0b;
        color: #92400e;
    }

    .alert-danger {
        background: #fee2e2;
        border-color: #ef4444;
        color: #7f1d1d;
    }

    .alert-title {
        font-weight: 700;
        font-size: 14px;
        margin-bottom: 6px;
    }

    .alert-text {
        font-size: 13px;
        line-height: 1.4;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, #667eea, transparent);
        margin: 20px 0;
    }

    /* Mobile & Tablet only — stack photo on top, centered */
    @media (max-width: 1023px) {
        .pet-main-card > div.flex {
            flex-direction: column !important;
            align-items: center !important;
        }

        .photo-container {
            width: 100% !important;
            height: auto !important;
            max-height: 260px;
            margin: 0 auto 20px auto !important;
        }

        .photo-container img {
            max-height: 260px;
        }

        .pet-main-card > div.flex > .flex-1 {
            width: 100% !important;
        }

        .btn-action {
            flex: 1;
            justify-content: center;
        }
    }
</style>

<div class="pt-6 pb-12 pet-details-page">
    <div class="max-w-5xl px-4 mx-auto">
        <!-- Header -->
        <div class="mb-6 pet-header-card">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white sm:text-4xl">{{ $pet->display_code }}</h1>
                    <p class="mt-1 text-blue-100">Pet Details & Information</p>
                </div>
                <span class="status-badge self-start sm:self-auto {{ $pet->status === 'adoptable' ? 'status-adoptable' : 'status-impounded' }}">
                    {{ ucfirst(str_replace('_', ' ', $pet->status)) }}
                </span>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-4">
            <!-- Left Column: Pet Info + Actions -->
            <div class="space-y-4 lg:col-span-3">
                <!-- Pet Information Card -->
                <div class="pet-main-card">
                    <div class="flex gap-6 pb-6 border-b border-gray-200">
                        <!-- Photo -->
                        @if($pet->photo)
                            <div class="photo-container" onclick="openPetPhotoModal()" title="Click to enlarge">
                                <img src="{{ asset('storage/' . $pet->photo) }}" alt="{{ $pet->display_code }}">
                            </div>
                        @else
                            <div class="photo-container" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                                <div class="text-center">
                                    <span class="text-5xl font-bold text-white">{{ substr($pet->display_code, 0, 1) }}</span>
                                    <p class="mt-2 text-xs text-blue-100">No Photo</p>
                                </div>
                            </div>
                        @endif

                        <!-- Quick Info Grid -->
                        <div class="flex-1">
                            <div class="pet-info-grid">
                                <div class="pet-info-item">
                                    <p class="pet-info-label">Species</p>
                                    <p class="pet-info-value">{{ $pet->species }}</p>
                                </div>
                                <div class="pet-info-item">
                                    <p class="pet-info-label">Breed</p>
                                    <p class="pet-info-value">{{ $pet->breed }}</p>
                                </div>
                                <div class="pet-info-item">
                                    <p class="pet-info-label">Gender</p>
                                    <p class="pet-info-value">{{ ucfirst($pet->gender) }}</p>
                                </div>
                                <div class="pet-info-item">
                                    <p class="pet-info-label">Estimated Age</p>
                                    <p class="pet-info-value">{{ $pet->estimated_age }}</p>
                                </div>
                                <div class="pet-info-item">
                                    <p class="pet-info-label">Color Markings</p>
                                    <p class="pet-info-value">{{ str_replace(',', ', ', $pet->color_markings) ?: 'N/A' }}</p>
                                </div>
                                @if($pet->shouldShowCaughtLocation())
                                    <div class="pet-info-item">
                                        <p class="pet-info-label">Caught Location</p>
                                        <p class="pet-info-value">{{ $pet->caught_location }}</p>
                                    </div>
                                @endif
                                @if($pet->description)
                                    <div class="pet-info-item">
                                        <p class="pet-info-label" style="font-weight: bold;">Description</p>
                                        <p class="pet-info-value" style="font-size: 14px; font-weight: 400; background-color: #f3f4f6; color: #000000; padding: 8px 12px; border-radius: 6px;">{{ $pet->description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Adoption Info -->
                    @if($pet->status === 'adoptable')
                        @php
                            $adoptionReasonLabels = [
                                'surrendered_by_owner' => 'Surrendered by Owner',
                                'remained_unclaimed' => 'Remained Unclaimed',
                                'found_by_citizen' => 'Found by Citizen',
                            ];
                            $returnReasonLabels = [
                                'owner_relocation' => 'Owner Relocation/Moving',
                                'owner_illness_death' => 'Owner Illness/Death',
                                'financial_hardship' => 'Financial Hardship',
                                'housing_restriction' => 'Housing Restriction',
                                'lifestyle_change' => 'Lifestyle Change',
                                'incompatibility_pets' => 'Incompatibility with Pets',
                                'incompatibility_children' => 'Incompatibility with Children',
                                'allergies' => 'Allergies',
                                'space_exercise' => 'Lack of Space/Exercise',
                                'behavioral_issues' => 'Behavioral Issues',
                                'other' => 'Other',
                            ];

                            if ($pet->mostRecentReturn && $pet->mostRecentReturn->return_date) {
                                $reason = $returnReasonLabels[$pet->mostRecentReturn->return_reason] ?? ucfirst(str_replace('_', ' ', $pet->mostRecentReturn->return_reason));
                                $notes = $pet->mostRecentReturn->return_notes;
                            } else {
                                if (!empty($pet->adoption_reason_other)) {
                                    $reason = $pet->adoption_reason_other;
                                } else {
                                    $reason = $pet->adoption_reason ? ($adoptionReasonLabels[$pet->adoption_reason] ?? ucfirst(str_replace('_', ' ', $pet->adoption_reason))) : 'Remained Unclaimed';
                                }
                                $notes = $pet->adoption_notes;
                            }
                        @endphp
                        <div class="p-4 mt-4 border-l-4 {{ $pet->mostRecentReturn && $pet->mostRecentReturn->return_date ? 'border-orange-500 bg-orange-50' : 'border-green-500 bg-green-50' }} rounded-8px">
                            <p class="pet-info-label {{ $pet->mostRecentReturn && $pet->mostRecentReturn->return_date ? 'text-orange-700' : 'text-green-700' }}">
                                {{ $pet->mostRecentReturn && $pet->mostRecentReturn->return_date ? 'Return Information' : 'Adoption Information' }}
                            </p>
                            <p class="mt-2 text-sm text-gray-700"><strong>Reason:</strong> {{ $reason }}</p>
                            @if($notes)
                                <p class="mt-1 text-sm text-gray-700"><strong>{{ $pet->mostRecentReturn && $pet->mostRecentReturn->return_date ? 'Return' : 'Adoption' }} Notes:</strong> {{ $notes }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="pet-main-card">
                    <p class="mb-4 section-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Quick Actions
                    </p>
                    <div class="action-buttons">
                        @auth
                            @if($pet->status === 'adoptable')
                                <button id="adoptBtn" type="button" class="btn-action btn-adopt" onclick="openAdoptModal()">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                    </svg>
                                    Start Adoption
                                </button>
                                <button id="claimAdoptableBtn" type="button" class="btn-action btn-claim" onclick="openClaimModalFromAdoptable()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Claim This Pet
                                </button>
                            @elseif($pet->status === 'impounded')
                                <button type="button" onclick="openClaimModal()" class="btn-action" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Submit Claim
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-action" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Login to Continue
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Back Button -->
                <a href="javascript:history.back()" class="block w-full px-6 py-3 text-center font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Previous
                </a>
            </div>

            <!-- Right Column: Timeline & Status -->
            <div class="space-y-4">
                <!-- Timeline Card -->
                <div class="pet-main-card">
                    <p class="mb-4 section-title">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Timeline
                    </p>

                    <div class="space-y-2">
                        @if($pet->impounded_date)
                            <div class="timeline-item">
                                <div class="bg-red-500 timeline-dot"></div>
                                <div class="timeline-content">
                                    <p class="timeline-label">Impounded</p>
                                    <p class="timeline-value">{{ $pet->impounded_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($pet->decision_date)
                            <div class="timeline-item">
                                <div class="bg-green-500 timeline-dot"></div>
                                <div class="timeline-content">
                                    <p class="timeline-label">Made Available</p>
                                    <p class="timeline-value">{{ $pet->decision_date->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @endif

                        @if($pet->remaining_days !== null)
                            @php $days = max(0, (int)floor($pet->remaining_days)); @endphp
                            <div class="timeline-item">
                                <div class="timeline-dot {{ $days <= 1 ? 'bg-red-500' : 'bg-yellow-500' }}"></div>
                                <div class="timeline-content">
                                    <p class="timeline-label">Time Remaining</p>
                                    <p class="timeline-value {{ $days <= 1 ? 'text-red-600' : 'text-gray-900' }}">
                                        {{ $days }} day{{ $days !== 1 ? 's' : '' }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="timeline-item">
                            <div class="bg-gray-400 timeline-dot"></div>
                            <div class="timeline-content">
                                <p class="timeline-label">Last Updated</p>
                                <p class="timeline-value">{{ $pet->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Alert -->
                @if($pet->status === 'impounded')
                    <div class="alert-box alert-danger">
                        <div class="alert-title">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            Currently Impounded
                        </div>
                        <div class="alert-text">
                            <strong>{{ $pet->remaining_days ? (int)$pet->remaining_days : '0' }} days</strong> remaining to claim this pet
                        </div>
                        <div class="mt-2 alert-text">
                            Claim Fee: ₱1,025 + ₱150/day if late
                        </div>
                    </div>

                    <!-- Claim Process -->
                    <div class="pet-main-card">
                        <p class="mb-4 text-xs font-bold text-gray-700 uppercase">Claim Process</p>
                        <div class="space-y-3">
                            <div class="flex gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-sm font-bold text-red-700 bg-red-100 rounded-full">1</div>
                                <div>
                                    <p class="text-sm text-gray-900 font-600">Submit Claim</p>
                                    <p class="mt-1 text-xs text-gray-600">Fill out your claim form with proof</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-sm font-bold text-yellow-700 bg-yellow-100 rounded-full">2</div>
                                <div>
                                    <p class="text-sm text-gray-900 font-600">Under Review</p>
                                    <p class="mt-1 text-xs text-gray-600">Vet department verifies your claim</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-sm font-bold text-green-700 bg-green-100 rounded-full">3</div>
                                <div>
                                    <p class="text-sm text-gray-900 font-600">Ready for Pickup</p>
                                    <p class="mt-1 text-xs text-gray-600">Come claim your pet once approved</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($pet->status === 'adoptable')
                    <div class="alert-box alert-warning">
                        <div class="alert-title">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Available for Adoption
                        </div>
                        <div class="alert-text">
                            Ready to find this pet a loving home. Start your adoption process today!
                        </div>
                    </div>

                    <!-- Adoption Process -->
                    <div class="pet-main-card">
                        <p class="mb-4 text-xs font-bold text-gray-700 uppercase">Adoption Steps</p>
                        <div class="space-y-3">
                            <div class="flex gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-sm font-bold text-green-700 bg-green-100 rounded-full">1</div>
                                <div>
                                    <p class="text-sm text-gray-900 font-600">Submit Application</p>
                                    <p class="mt-1 text-xs text-gray-600">Complete adoption form</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-sm font-bold text-green-700 bg-green-100 rounded-full">2</div>
                                <div>
                                    <p class="text-sm text-gray-900 font-600">Review & Approval</p>
                                    <p class="mt-1 text-xs text-gray-600">Vet reviews your application</p>
                                </div>
                            </div>
                            <div class="flex gap-3">
                                <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 text-sm font-bold text-green-700 bg-green-100 rounded-full">3</div>
                                <div>
                                    <p class="text-sm text-gray-900 font-600">Finalization</p>
                                    <p class="mt-1 text-xs text-gray-600">Sign documents & adopt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@auth
{{-- ADOPT MODAL (Compact design for better UX) --}}
@if($pet->status === 'adoptable')
<div id="adoptModal" class="fixed inset-0 z-[9999] p-4 bg-black/30 backdrop-blur-sm flex items-center justify-center" style="display: none;">
    <div class="relative mx-auto p-4 border w-full max-w-2xl shadow-xl rounded-lg bg-white max-h-[95vh] overflow-y-auto">
        <div class="mb-2">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-900">Pet Adoption Application</h3>
                <button onclick="closeAdoptModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="mb-4 text-sm text-gray-600">Complete this form to start the adoption process for {{ $pet->display_code }}.</p>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="adopt">

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 1: Adopter's Information</h5>
                    <div class="p-4 mb-4 border border-blue-200 rounded-lg bg-blue-50">
                        <p class="mb-2 text-sm text-blue-800"><strong>Note:</strong> The information below is auto-filled from your profile. If you need to update your information, please go to your <a href="{{ route('profile.edit') }}" class="text-blue-600 underline hover:text-blue-800">profile settings</a> first.</p>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Last Name</label>
                            <input name="last_name" type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">First Name</label>
                            <input name="first_name" type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Middle Name</label>
                            <input name="middle_name" type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Complete Address (House No., Street, e.g., Barangay Poblacion, Cpark)</label>
                        <input name="address" type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Contact Number</label>
                            <input name="contact_number" type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                            <input name="email" type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Date of Birth (MM/DD/YYYY)</label>
                        <input
                            type="date"
                            name="date_of_birth"
                            value="{{ auth()->user()->birthday ? auth()->user()->birthday->format('Y-m-d') : '' }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50"
                            readonly
                        >
                    </div>

                    @if(auth()->user()->id_photo)
                                        <div class="mb-4">
                                            <label class="block mb-1 text-sm font-medium text-gray-700">ID Photo</label>
                                            <div onclick="document.getElementById('petsShowIdPhotoModal').classList.remove('hidden')"
                                                 class="flex flex-col items-center justify-center w-24 h-16 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer hover:bg-gray-900">
                                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </div>

                                            <!-- Modal for Full Size ID Photo -->
                                            <div id="petsShowIdPhotoModal"
                                                 class="fixed inset-0 z-[9999] flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black/30 backdrop-blur-sm"
                                                 onclick="if(event.target.id === 'petsShowIdPhotoModal') this.classList.add('hidden')">
                                                <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                                    <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                                        <h3 class="text-xl font-semibold text-gray-800">Your ID Photo</h3>
                                                        <button onclick="document.getElementById('petsShowIdPhotoModal').classList.add('hidden')"
                                                                class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="p-6 max-h-[80vh] overflow-y-auto">
                                                        <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                                             alt="Full Size ID Photo"
                                                             class="w-full h-auto rounded-lg shadow-md">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                                    @else
                                        <div class="p-3 mb-4 border border-yellow-200 rounded bg-yellow-50">
                                            <p class="text-sm text-yellow-800"><strong>Note:</strong> You haven't uploaded an ID photo yet. Please upload one in your <a href="{{ route('profile.edit') }}" class="text-blue-600 underline hover:text-blue-800">profile settings</a> for faster verification.</p>
                                        </div>
                                    @endif
                </div>

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 2: Household Information</h5>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">1. Type of Dwelling:</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="dwelling_type" value="owned" required class="mr-2">
                                Owned House
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="dwelling_type" value="rented" class="mr-2">
                                Rented House
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="dwelling_type" value="apartment" class="mr-2">
                                Apartment
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">2. If you rent, do you have your landlord's permission to keep a pet?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="landlord_permission" value="yes" class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="landlord_permission" value="no" class="mr-2">
                                No
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="landlord_permission" value="n/a" class="mr-2">
                                N/A (I own my home)
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">3. Is your property securely fenced or gated?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="fenced_property" value="yes" required class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="fenced_property" value="no" class="mr-2">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">4. How many people live in your home? Adults (18+)</label>
                            <input type="number" name="adults_count" min="1" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Children (under 18)</label>
                            <input type="number" name="children_count" min="0" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">5. Is anyone in your household allergic to animals?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="allergies" value="yes" required class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="allergies" value="no" class="mr-2">
                                No
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="allergies" value="unsure" class="mr-2">
                                Unsure
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">6. Do you currently have other pets?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="other_pets" value="yes" required class="mr-2">
                                Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="other_pets" value="no" class="mr-2">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">7. If yes, please list them (e.g., "1 Dog, 5 y/o, vaccinated"; "2 Cats, vaccinated")</label>
                        <textarea name="other_pets_list" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">8. Where will this pet primarily live?</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="pet_living_area" value="indoors" required class="mr-2">
                                Indoors only
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="pet_living_area" value="outdoors" class="mr-2">
                                Outdoors only
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="pet_living_area" value="both" class="mr-2">
                                Both indoors and outdoors
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">9. Please briefly explain why you would like to adopt a pet</label>
                        <textarea name="reason" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
                    </div>
                </div>

                <div class="mb-8">
                    <h5 class="pb-2 mb-4 text-lg font-semibold text-gray-800 border-b">Section 3: Adoption Agreement</h5>
                    <p class="mb-4 text-sm text-gray-600">By submitting this application, I understand and agree to the following:</p>
                    <ul class="mb-4 space-y-1 text-sm text-gray-700">
                        <li>• I will provide the adopted pet with proper shelter, sufficient food, clean water, and all necessary medical care (including veterinary visits).</li>
                        <li>• I will ensure the pet receives its annual Anti-Rabies vaccination and other required boosters.</li>
                        <li>• I will not keep the pet permanently caged or tethered on a short leash.</li>
                        <li>• If I can no longer care for the pet for any reason, I will return it to the City Veterinary Department and will NOT abandon it.</li>
                        <li>• I will abide by all provisions of Republic Act 8485 (The Animal Welfare Act) and Republic Act 8482 (The Anti-Rabies Act).</li>
                    </ul>

                    <div class="space-y-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            I certify that all information in this application is true and correct.
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            I have read and agree to all terms of the Adoption Agreement.
                        </label>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-700">Home Environment Photos (Optional - 2-3 photos)</label>
                    <div id="adoptPhoto-dropzone" class="p-6 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed cursor-pointer rounded-xl hover:border-green-400 hover:bg-green-50">
                        <input type="file" name="photos[]" multiple accept="image/*" class="hidden" id="adoptPhotoUpload">
                        <label for="adoptPhotoUpload" class="block cursor-pointer">
                            <svg class="w-10 h-10 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="font-medium text-green-600">Drag and drop or click to upload</p>
                            <p class="mt-1 text-sm text-gray-500">PNG, JPG up to 50MB</p>
                        </label>
                    </div>
                    <div id="adoptPhotoPreview" class="mt-4" style="display: none;">
                        <p class="mb-2 text-sm font-medium text-gray-700">Uploaded Photos:</p>
                        <div id="adoptPhotoGrid" class="grid grid-cols-3 gap-3"></div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeAdoptModal()" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 font-semibold text-white bg-green-600 rounded-md hover:bg-green-700">Submit Adoption Application</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Adopt Photo Carousel Modal -->
<div id="adoptPhotoCarousel" class="fixed inset-0 z-[9999] p-4 bg-black/30 backdrop-blur-sm flex items-center justify-center" style="display: none;" onclick="if(event.target.id === 'adoptPhotoCarousel') closeAdoptPhotoCarousel()">
    <div class="relative w-full max-w-2xl max-h-[85vh]">
        <button onclick="closeAdoptPhotoCarousel()" class="absolute right-0 z-10 text-gray-100 -top-10 hover:text-white">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <button id="adoptCarouselPrev" type="button" onclick="prevAdoptPhoto()" class="absolute px-3 py-2 text-white -translate-y-1/2 rounded-lg -left-12 top-1/2 bg-black/30 hover:bg-black/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="adoptCarouselNext" type="button" onclick="nextAdoptPhoto()" class="absolute px-3 py-2 text-white -translate-y-1/2 rounded-lg -right-12 top-1/2 bg-black/30 hover:bg-black/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <img id="adoptCarouselImage" src="" alt="Photo" class="w-full h-auto rounded-lg shadow-2xl">
        <div class="mt-3 text-center">
            <p id="adoptCarouselCounter" class="text-sm text-white"></p>
        </div>
    </div>
</div>
@endif

{{-- CLAIM MODAL FOR ADOPTABLE PETS (Compact design) --}}
@if($pet->status === 'adoptable')
<div id="claimModalFromAdoptable" class="fixed inset-0 z-[9999] p-4 bg-black/30 backdrop-blur-sm flex items-center justify-center" style="display: none;">
    <div class="relative mx-auto p-4 border w-full max-w-2xl shadow-xl rounded-lg bg-white max-h-[95vh] overflow-y-auto">
        <div class="mb-2">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-900">Claim Request Form</h3>
                <button onclick="closeClaimModalFromAdoptable()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mb-4 space-y-3">
                <div class="p-3 border border-orange-200 rounded-lg bg-orange-50">
                    <p class="text-xs text-orange-700"><strong>Late Discovery:</strong> This pet is now adoptable. Submit your claim with proof of ownership.</p>
                </div>
                <p class="text-sm text-gray-600">Complete this form to claim {{ $pet->display_code }} as your pet.</p>
            </div>

            <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="claim">

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 1: Your Information</h5>
                    <p class="mb-3 text-xs text-gray-600">Your profile info is auto-filled. Review for accuracy.</p>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Last Name</label>
                            <input name="last_name" type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">First Name</label>
                            <input name="first_name" type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Middle Name</label>
                            <input name="middle_name" type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Address</label>
                        <input name="address" type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Contact</label>
                            <input name="contact_number" type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Email</label>
                            <input name="email" type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Date of Birth</label>
                        <input name="date_of_birth" type="date" value="{{ auth()->user()->birthday ? auth()->user()->birthday->format('Y-m-d') : '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>

                    @if(auth()->user()->id_photo)
                        <div class="mb-3">
                            <label class="block mb-1 text-xs font-medium text-gray-700">ID Photo</label>
                            <div onclick="document.getElementById('petsClaimIdPhotoModalAdoptable').classList.remove('hidden')"
                                 class="flex flex-col items-center justify-center w-20 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer h-14 hover:bg-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <!-- Modal for Full Size ID Photo -->
                            <div id="petsClaimIdPhotoModalAdoptable"
                                 class="fixed inset-0 z-[9999] flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black/30 backdrop-blur-sm"
                                 onclick="if(event.target.id === 'petsClaimIdPhotoModalAdoptable') this.classList.add('hidden')">
                                <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                    <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Your ID Photo</h3>
                                        <button onclick="document.getElementById('petsClaimIdPhotoModalAdoptable').classList.add('hidden')"
                                                class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 max-h-[80vh] overflow-y-auto">
                                        <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                             alt="ID Photo"
                                             class="w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                    @endif
                </div>

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 2: Proof of Ownership</h5>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Describe unique features of your pet</label>
                        <textarea name="proof_of_ownership_description" rows="2" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="E.g., scar, specific mark, behavioral trait..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Upload proof (vet records, photos, barangay reg, etc.)</label>
                        <div id="adoptableClaimPhoto-dropzone" class="p-4 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-orange-400 hover:bg-orange-50">
                            <input type="file" name="photos[]" multiple accept="image/*, .pdf" class="hidden" id="adoptableClaimPhotoUpload">
                            <label for="adoptableClaimPhotoUpload" class="block cursor-pointer">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm font-medium text-orange-600">Drag and drop or click to upload</p>
                                <p class="mt-0.5 text-xs text-gray-500">PNG, JPG, PDF up to 50MB</p>
                            </label>
                        </div>
                        <div id="adoptableClaimPhotoPreview" class="mt-3" style="display: none;">
                            <p class="mb-2 text-xs font-medium text-gray-700">Uploaded Files:</p>
                            <div id="adoptableClaimPhotoGrid" class="grid grid-cols-3 gap-2"></div>
                        </div>
                    </div>

                    <div class="space-y-2 text-xs">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            <span>I confirm all information is true</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            <span>I understand the vet department will verify my claim</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeClaimModalFromAdoptable()" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 font-semibold text-white bg-orange-600 rounded-md hover:bg-orange-700">Submit Claim Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Adoptable Claim Photo Carousel Modal -->
<div id="adoptableClaimPhotoCarousel" class="fixed inset-0 z-[9999] p-4 bg-black/30 backdrop-blur-sm flex items-center justify-center" style="display: none;" onclick="if(event.target.id === 'adoptableClaimPhotoCarousel') closeAdoptableClaimPhotoCarousel()">
    <div class="relative w-full max-w-2xl max-h-[85vh]">
        <button onclick="closeAdoptableClaimPhotoCarousel()" class="absolute right-0 z-10 text-gray-100 -top-10 hover:text-white">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <button id="adoptableClaimCarouselPrev" type="button" onclick="prevAdoptableClaimPhoto()" class="absolute px-3 py-2 text-white -translate-y-1/2 rounded-lg -left-12 top-1/2 bg-black/30 hover:bg-black/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="adoptableClaimCarouselNext" type="button" onclick="nextAdoptableClaimPhoto()" class="absolute px-3 py-2 text-white -translate-y-1/2 rounded-lg -right-12 top-1/2 bg-black/30 hover:bg-black/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <img id="adoptableClaimCarouselImage" src="" alt="Photo" class="w-full h-auto rounded-lg shadow-2xl">
        <div class="mt-3 text-center">
            <p id="adoptableClaimCarouselCounter" class="text-sm text-white"></p>
        </div>
    </div>
</div>
@endif

{{-- CLAIM MODAL (Compact design for impounded pets) --}}
@if($pet->status === 'impounded')
<div id="claimModal" class="fixed inset-0 z-[9999] p-4 bg-black/30 backdrop-blur-sm flex items-center justify-center" style="display: none;">
    <div class="relative mx-auto p-4 border w-full max-w-2xl shadow-xl rounded-lg bg-white max-h-[95vh] overflow-y-auto">
        <div class="mb-2">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-bold text-gray-900">Pet Claim Request</h3>
                <button onclick="closeClaimModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mb-4 space-y-3">
                <div class="p-3 border border-red-200 rounded-lg bg-red-50">
                    <p class="text-xs text-red-700"><strong>Claim Fees:</strong> ₱1,025 base fine + ₱150/day if delayed beyond the deadline</p>
                </div>
                <p class="text-sm text-gray-600">Complete this form to claim {{ $pet->display_code }} as your pet.</p>
            </div>

                <form action="{{ route('pets.request', $pet) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="type" value="claim">
                {{-- Visible fields below now include name attributes so values are submitted. Hidden duplicates removed. --}}

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 1: Your Information</h5>
                    <p class="mb-3 text-xs text-gray-600">Your profile info is auto-filled. Review for accuracy.</p>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-3">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Last Name</label>
                            <input name="last_name" type="text" value="{{ auth()->user()->last_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">First Name</label>
                            <input name="first_name" type="text" value="{{ auth()->user()->first_name ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Middle Name</label>
                            <input name="middle_name" type="text" value="{{ auth()->user()->middle_name ?? '' }}" class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Address</label>
                        <input name="address" type="text" value="{{ (auth()->user()->street ?? '') . ', ' . (auth()->user()->barangay ?? '') . ', ' . (auth()->user()->city_municipality ?? '') }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>
                    <div class="grid grid-cols-1 gap-3 mb-3 md:grid-cols-2">
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Contact</label>
                            <input name="contact_number" type="tel" value="{{ auth()->user()->contact_number ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                        <div>
                            <label class="block mb-1 text-xs font-medium text-gray-700">Email</label>
                            <input name="email" type="email" value="{{ auth()->user()->email ?? '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Date of Birth</label>
                        <input name="date_of_birth" type="date" value="{{ auth()->user()->birthday ? auth()->user()->birthday->format('Y-m-d') : '' }}" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md bg-gray-50" readonly>
                    </div>

                    @if(auth()->user()->id_photo)
                        <div class="mb-3">
                            <label class="block mb-1 text-xs font-medium text-gray-700">ID Photo</label>
                            <div onclick="document.getElementById('petsShowIdPhotoModal2').classList.remove('hidden')"
                                 class="flex flex-col items-center justify-center w-20 transition duration-150 ease-in-out bg-black border-2 border-gray-400 rounded cursor-pointer h-14 hover:bg-gray-900">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.75 4h2.5a2 2 0 011.664.89l.812 1.22a2 2 0 001.664.89H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <!-- Modal for Full Size ID Photo -->
                            <div id="petsShowIdPhotoModal2"
                                 class="fixed inset-0 z-[9999] flex items-center justify-center hidden p-4 transition-opacity duration-300 bg-black/30 backdrop-blur-sm"
                                 onclick="if(event.target.id === 'petsShowIdPhotoModal2') this.classList.add('hidden')">
                                <div class="relative max-w-3xl overflow-hidden bg-white rounded-lg shadow-2xl">
                                    <div class="sticky top-0 z-10 flex items-center justify-between p-3 bg-white border-b border-gray-200">
                                        <h3 class="text-lg font-semibold text-gray-800">Your ID Photo</h3>
                                        <button onclick="document.getElementById('petsShowIdPhotoModal2').classList.add('hidden')"
                                                class="p-2 text-gray-500 transition duration-150 rounded-full hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 max-h-[80vh] overflow-y-auto">
                                        <img src="{{ asset('storage/' . auth()->user()->id_photo) }}"
                                             alt="ID Photo"
                                             class="w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_photo_path" value="{{ auth()->user()->id_photo }}">
                    @endif
                </div>

                <div class="mb-6">
                    <h5 class="pb-2 mb-3 text-base font-semibold text-gray-800 border-b">Section 2: Proof of Ownership</h5>
                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Describe unique features of your pet</label>
                        <textarea name="proof_of_ownership_description" rows="2" required class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="E.g., scar, specific mark, behavioral trait..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="block mb-1 text-xs font-medium text-gray-700">Upload proof (vet records, photos, barangay reg, etc.)</label>
                        <div id="impoundedClaimPhoto-dropzone" class="p-4 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-red-400 hover:bg-red-50">
                            <input type="file" name="photos[]" multiple accept="image/*, .pdf" class="hidden" id="impoundedClaimPhotoUpload">
                            <label for="impoundedClaimPhotoUpload" class="block cursor-pointer">
                                <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm font-medium text-red-600">Drag and drop or click to upload</p>
                                <p class="mt-0.5 text-xs text-gray-500">PNG, JPG, PDF up to 50MB</p>
                            </label>
                        </div>
                        <div id="impoundedClaimPhotoPreview" class="mt-3" style="display: none;">
                            <p class="mb-2 text-xs font-medium text-gray-700">Uploaded Files:</p>
                            <div id="impoundedClaimPhotoGrid" class="grid grid-cols-3 gap-2"></div>
                        </div>
                    </div>

                    <div class="space-y-2 text-xs">
                        <label class="flex items-center">
                            <input type="checkbox" name="certify_info" required class="mr-2">
                            <span>I confirm all information is true</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="agree_terms" required class="mr-2">
                            <span>I understand I must pay the settlement fee (₱1,025 + daily charges if late) and visit the vet department to pick up my pet</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeClaimModal()" class="px-4 py-2 text-gray-700 bg-gray-300 rounded-md hover:bg-gray-400">Cancel</button>
                    <button type="submit" class="px-6 py-3 font-semibold text-white bg-red-600 rounded-md hover:bg-red-700">Submit Claim Request</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Impounded Claim Photo Carousel Modal -->
<div id="impoundedClaimPhotoCarousel" class="fixed inset-0 z-[9999] p-4 bg-black/30 backdrop-blur-sm flex items-center justify-center" style="display: none;" onclick="if(event.target.id === 'impoundedClaimPhotoCarousel') closeImpoundedClaimPhotoCarousel()">
    <div class="relative w-full max-w-2xl max-h-[85vh]">
        <button onclick="closeImpoundedClaimPhotoCarousel()" class="absolute right-0 z-10 text-gray-100 -top-10 hover:text-white">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <button id="impoundedClaimCarouselPrev" type="button" onclick="prevImpoundedClaimPhoto()" class="absolute px-3 py-2 text-white -translate-y-1/2 rounded-lg -left-12 top-1/2 bg-black/30 hover:bg-black/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button id="impoundedClaimCarouselNext" type="button" onclick="nextImpoundedClaimPhoto()" class="absolute px-3 py-2 text-white -translate-y-1/2 rounded-lg -right-12 top-1/2 bg-black/30 hover:bg-black/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
        <img id="impoundedClaimCarouselImage" src="" alt="Photo" class="w-full h-auto rounded-lg shadow-2xl">
        <div class="mt-3 text-center">
            <p id="impoundedClaimCarouselCounter" class="text-sm text-white"></p>
        </div>
    </div>
</div>
@endif
@endauth

@if($pet->photo)
<!-- Pet Photo Modal -->
<div id="petPhotoModal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-black/30 backdrop-blur-sm" style="display: none;" onclick="closePetPhotoModal()">
    <button onclick="closePetPhotoModal()" class="absolute text-white top-6 right-6 hover:text-gray-100">
        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    <img src="{{ asset('storage/' . $pet->photo) }}" alt="Full Size Pet Photo" class="max-w-4xl max-h-[85vh] rounded-lg shadow-2xl">
</div>
@endif

<script>
    // Assuming you have these JavaScript functions to control the modals
    function openAdoptModal() {
        const modal = document.getElementById('adoptModal');
        if (modal) modal.style.display = 'flex';
    }
    function closeAdoptModal() {
        const modal = document.getElementById('adoptModal');
        if (modal) modal.style.display = 'none';
    }
    function openClaimModal() {
        const modal = document.getElementById('claimModal');
        if (modal) modal.style.display = 'flex';
    }
    function openClaimModalFromAdoptable() {
        try {
            console.log('openClaimModalFromAdoptable called');
            const modal = document.getElementById('claimModalFromAdoptable');
            console.log('Modal element:', modal);
            if (modal) {
                modal.style.display = 'flex';
                console.log('Modal display set to flex');
            } else {
                console.error('Modal element not found!');
            }
        } catch(e) {
            console.error('Error in openClaimModalFromAdoptable:', e);
        }
    }
    function closeClaimModal() {
        const modal = document.getElementById('claimModal');
        if (modal) modal.style.display = 'none';
    }
    function closeClaimModalFromAdoptable() {
        const modal = document.getElementById('claimModalFromAdoptable');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Button event listeners
    // Simple handlers for adoptable pet buttons
    function handleAdoptBtnClick(event) {
        console.log('Adopt button clicked');
        // Close claim modal if it's open
        const claimModal = document.getElementById('claimModalFromAdoptable');
        if (claimModal) {
            claimModal.style.display = 'none';
        }
        // Open adoption modal
        const adoptModal = document.getElementById('adoptModal');
        if (adoptModal) {
            adoptModal.style.display = 'flex';
        }
    }

    function handleClaimAdoptableBtnClick(event) {
        console.log('=== Claim Button Click Handler ===');
        console.log('Claim adoptable button clicked');
        console.log('Event:', event);

        // Close adoption modal if it's open
        const adoptModal = document.getElementById('adoptModal');
        console.log('Adopt modal found:', adoptModal);
        if (adoptModal) {
            console.log('Closing adopt modal');
            adoptModal.style.display = 'none';
        }

        // Open claim modal
        console.log('About to call openClaimModalFromAdoptable()');
        openClaimModalFromAdoptable();
        console.log('=== End Claim Click Handler ===');
    }

    function openPetPhotoModal() {
        const modal = document.getElementById('petPhotoModal');
        if (modal) modal.style.display = 'flex';
    }

    function closePetPhotoModal() {
        const modal = document.getElementById('petPhotoModal');
        if (modal) modal.style.display = 'none';
    }

    // Close modal when clicking outside the image
    const petPhotoModalElement = document.getElementById('petPhotoModal');
    if (petPhotoModalElement) {
        petPhotoModalElement.addEventListener('click', function(event) {
            if (event.target === this) {
                closePetPhotoModal();
            }
        });
    }

    // Enhanced keyboard event listener for backspace key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Backspace') {
            // Check pet photo modal first
            const petModal = document.getElementById('petPhotoModal');
            if (petModal && !petModal.classList.contains('hidden')) {
                closePetPhotoModal();
                return;
            }

            // Check ID photo modals
            const idPhotoModal1 = document.getElementById('petsShowIdPhotoModal');
            if (idPhotoModal1 && !idPhotoModal1.classList.contains('hidden')) {
                idPhotoModal1.classList.add('hidden');
                return;
            }

            const idPhotoModal2 = document.getElementById('petsClaimIdPhotoModalAdoptable');
            if (idPhotoModal2 && !idPhotoModal2.classList.contains('hidden')) {
                idPhotoModal2.classList.add('hidden');
                return;
            }

            const idPhotoModal3 = document.getElementById('petsShowIdPhotoModal2');
            if (idPhotoModal3 && !idPhotoModal3.classList.contains('hidden')) {
                idPhotoModal3.classList.add('hidden');
                return;
            }

            // Check adoption modal
            const adoptModal = document.getElementById('adoptModal');
            if (adoptModal && !adoptModal.classList.contains('hidden')) {
                closeAdoptModal();
                return;
            }

            // Check claim modal for adoptable
            const claimModalAdoptable = document.getElementById('claimModalFromAdoptable');
            if (claimModalAdoptable && !claimModalAdoptable.classList.contains('hidden')) {
                closeClaimModalFromAdoptable();
                return;
            }

            // Check claim modal for impounded
            const claimModal = document.getElementById('claimModal');
            if (claimModal && !claimModal.classList.contains('hidden')) {
                closeClaimModal();
                return;
            }
        }

        // Also handle escape key
        if (event.key === 'Escape') {
            closePetPhotoModal();
            // Close ID photo modals
            const idPhotoModal1 = document.getElementById('petsShowIdPhotoModal');
            if (idPhotoModal1) idPhotoModal1.classList.add('hidden');

            const idPhotoModal2 = document.getElementById('petsClaimIdPhotoModalAdoptable');
            if (idPhotoModal2) idPhotoModal2.classList.add('hidden');

            const idPhotoModal3 = document.getElementById('petsShowIdPhotoModal2');
            if (idPhotoModal3) idPhotoModal3.classList.add('hidden');

            closeAdoptModal();
            closeClaimModalFromAdoptable();
            closeClaimModal();
        }
    });

    // Photo upload handlers for all three forms
    const adoptPhotoUpload = document.getElementById('adoptPhotoUpload');
    const adoptableClaimPhotoUpload = document.getElementById('adoptableClaimPhotoUpload');
    const impoundedClaimPhotoUpload = document.getElementById('impoundedClaimPhotoUpload');

    // Store uploaded photos for each form
    let adoptPhotos = [];
    let adoptableClaimPhotos = [];
    let impoundedClaimPhotos = [];

    // Adoption form photo handlers
    if (adoptPhotoUpload) {
        const adoptDropzone = document.getElementById('adoptPhoto-dropzone');
        if (adoptDropzone) {
        adoptDropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            adoptDropzone.style.backgroundColor = '#f0fdf4';
            adoptDropzone.style.borderColor = '#4ade80';
        });
        adoptDropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            adoptDropzone.style.backgroundColor = '';
            adoptDropzone.style.borderColor = '#d1d5db';
        });
        adoptDropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            adoptDropzone.style.backgroundColor = '';
            adoptDropzone.style.borderColor = '#d1d5db';
            handleAdoptPhotoSelect(e.dataTransfer.files);
        });
        adoptPhotoUpload.addEventListener('change', (e) => {
            handleAdoptPhotoSelect(e.target.files);
        });
        }
    }

    function handleAdoptPhotoSelect(files) {
        adoptPhotos = Array.from(files);
        const dataTransfer = new DataTransfer();
        adoptPhotos.forEach(f => dataTransfer.items.add(f));
        adoptPhotoUpload.files = dataTransfer.files;
        updateAdoptPhotoPreview();
    }

    function updateAdoptPhotoPreview() {
        if (adoptPhotos.length === 0) {
            document.getElementById('adoptPhotoPreview').style.display = 'none';
            return;
        }
        document.getElementById('adoptPhotoPreview').style.display = 'block';
        const grid = document.getElementById('adoptPhotoGrid');
        grid.innerHTML = '';
        adoptPhotos.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'relative overflow-hidden border border-gray-200 rounded-lg cursor-pointer';
            const reader = new FileReader();
            reader.onload = (e) => {
                div.innerHTML = `<img src="${e.target.result}" alt="Photo ${index+1}" class="object-cover w-full h-24 hover:opacity-75" onclick="openAdoptPhotoCarousel(${index})">
                    <button type="button" onclick="removeAdoptPhoto(${index})" class="absolute flex items-center justify-center w-6 h-6 text-sm text-white bg-red-500 rounded-full top-1 right-1 hover:bg-red-600">×</button>`;
            };
            reader.readAsDataURL(file);
            grid.appendChild(div);
        });
    }

    function removeAdoptPhoto(index) {
        adoptPhotos.splice(index, 1);
        const dataTransfer = new DataTransfer();
        adoptPhotos.forEach(f => dataTransfer.items.add(f));
        adoptPhotoUpload.files = dataTransfer.files;
        updateAdoptPhotoPreview();
    }

    // Adoptable claim form photo handlers
    if (adoptableClaimPhotoUpload) {
        const dropzone = document.getElementById('adoptableClaimPhoto-dropzone');
        if (dropzone) {
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '#fffbeb';
            dropzone.style.borderColor = '#fb923c';
        });
        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '';
            dropzone.style.borderColor = '#d1d5db';
        });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '';
            dropzone.style.borderColor = '#d1d5db';
            handleAdoptableClaimPhotoSelect(e.dataTransfer.files);
        });
        adoptableClaimPhotoUpload.addEventListener('change', (e) => {
            handleAdoptableClaimPhotoSelect(e.target.files);
        });
        }
    }

    function handleAdoptableClaimPhotoSelect(files) {
        adoptableClaimPhotos = Array.from(files);
        const dataTransfer = new DataTransfer();
        adoptableClaimPhotos.forEach(f => dataTransfer.items.add(f));
        adoptableClaimPhotoUpload.files = dataTransfer.files;
        updateAdoptableClaimPhotoPreview();
    }

    function updateAdoptableClaimPhotoPreview() {
        if (adoptableClaimPhotos.length === 0) {
            document.getElementById('adoptableClaimPhotoPreview').style.display = 'none';
            return;
        }
        document.getElementById('adoptableClaimPhotoPreview').style.display = 'block';
        const grid = document.getElementById('adoptableClaimPhotoGrid');
        grid.innerHTML = '';
        adoptableClaimPhotos.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'relative overflow-hidden border border-gray-200 rounded-lg cursor-pointer';
            const reader = new FileReader();
            reader.onload = (e) => {
                div.innerHTML = `<img src="${e.target.result}" alt="File ${index+1}" class="object-cover w-full h-16 hover:opacity-75" onclick="openAdoptableClaimPhotoCarousel(${index})">
                    <button type="button" onclick="removeAdoptableClaimPhoto(${index})" class="absolute top-0.5 right-0.5 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">×</button>`;
            };
            reader.readAsDataURL(file);
            grid.appendChild(div);
        });
    }

    function removeAdoptableClaimPhoto(index) {
        adoptableClaimPhotos.splice(index, 1);
        const dataTransfer = new DataTransfer();
        adoptableClaimPhotos.forEach(f => dataTransfer.items.add(f));
        adoptableClaimPhotoUpload.files = dataTransfer.files;
        updateAdoptableClaimPhotoPreview();
    }

    // Impounded claim form photo handlers
    if (impoundedClaimPhotoUpload) {
        const dropzone = document.getElementById('impoundedClaimPhoto-dropzone');
        if (dropzone) {
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '#fef2f2';
            dropzone.style.borderColor = '#f87171';
        });
        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '';
            dropzone.style.borderColor = '#d1d5db';
        });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.style.backgroundColor = '';
            dropzone.style.borderColor = '#d1d5db';
            handleImpoundedClaimPhotoSelect(e.dataTransfer.files);
        });
        impoundedClaimPhotoUpload.addEventListener('change', (e) => {
            handleImpoundedClaimPhotoSelect(e.target.files);
        });
        }
    }

    function handleImpoundedClaimPhotoSelect(files) {
        impoundedClaimPhotos = Array.from(files);
        const dataTransfer = new DataTransfer();
        impoundedClaimPhotos.forEach(f => dataTransfer.items.add(f));
        impoundedClaimPhotoUpload.files = dataTransfer.files;
        updateImpoundedClaimPhotoPreview();
    }

    function updateImpoundedClaimPhotoPreview() {
        if (impoundedClaimPhotos.length === 0) {
            document.getElementById('impoundedClaimPhotoPreview').style.display = 'none';
            return;
        }
        document.getElementById('impoundedClaimPhotoPreview').style.display = 'block';
        const grid = document.getElementById('impoundedClaimPhotoGrid');
        grid.innerHTML = '';
        impoundedClaimPhotos.forEach((file, index) => {
            const div = document.createElement('div');
            div.className = 'relative overflow-hidden border border-gray-200 rounded-lg cursor-pointer';
            const reader = new FileReader();
            reader.onload = (e) => {
                div.innerHTML = `<img src="${e.target.result}" alt="File ${index+1}" class="object-cover w-full h-16 hover:opacity-75" onclick="openImpoundedClaimPhotoCarousel(${index})">
                    <button type="button" onclick="removeImpoundedClaimPhoto(${index})" class="absolute top-0.5 right-0.5 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600">×</button>`;
            };
            reader.readAsDataURL(file);
            grid.appendChild(div);
        });
    }

    function removeImpoundedClaimPhoto(index) {
        impoundedClaimPhotos.splice(index, 1);
        const dataTransfer = new DataTransfer();
        impoundedClaimPhotos.forEach(f => dataTransfer.items.add(f));
        impoundedClaimPhotoUpload.files = dataTransfer.files;
        updateImpoundedClaimPhotoPreview();
    }

    // Carousel functions
    let adoptCurrentIndex = 0;
    let adoptableClaimCurrentIndex = 0;
    let impoundedClaimCurrentIndex = 0;

    function openAdoptPhotoCarousel(index) {
        if (adoptPhotos.length === 0) return;
        adoptCurrentIndex = index;
        updateAdoptCarousel();
        const modal = document.getElementById('adoptPhotoCarousel');
        if (modal) modal.style.display = 'flex';
    }

    function updateAdoptCarousel() {
        const file = adoptPhotos[adoptCurrentIndex];
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('adoptCarouselImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
        document.getElementById('adoptCarouselCounter').textContent = `${adoptCurrentIndex + 1} / ${adoptPhotos.length}`;
        document.getElementById('adoptCarouselPrev').style.display = adoptPhotos.length > 1 ? 'block' : 'none';
        document.getElementById('adoptCarouselNext').style.display = adoptPhotos.length > 1 ? 'block' : 'none';
    }

    function nextAdoptPhoto() {
        adoptCurrentIndex = (adoptCurrentIndex + 1) % adoptPhotos.length;
        updateAdoptCarousel();
    }

    function prevAdoptPhoto() {
        adoptCurrentIndex = (adoptCurrentIndex - 1 + adoptPhotos.length) % adoptPhotos.length;
        updateAdoptCarousel();
    }

    function closeAdoptPhotoCarousel() {
        const modal = document.getElementById('adoptPhotoCarousel');
        if (modal) modal.style.display = 'none';
    }

    function openAdoptableClaimPhotoCarousel(index) {
        if (adoptableClaimPhotos.length === 0) return;
        adoptableClaimCurrentIndex = index;
        updateAdoptableClaimCarousel();
        const modal = document.getElementById('adoptableClaimPhotoCarousel');
        if (modal) modal.style.display = 'flex';
    }

    function updateAdoptableClaimCarousel() {
        const file = adoptableClaimPhotos[adoptableClaimCurrentIndex];
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('adoptableClaimCarouselImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
        document.getElementById('adoptableClaimCarouselCounter').textContent = `${adoptableClaimCurrentIndex + 1} / ${adoptableClaimPhotos.length}`;
        document.getElementById('adoptableClaimCarouselPrev').style.display = adoptableClaimPhotos.length > 1 ? 'block' : 'none';
        document.getElementById('adoptableClaimCarouselNext').style.display = adoptableClaimPhotos.length > 1 ? 'block' : 'none';
    }

    function nextAdoptableClaimPhoto() {
        adoptableClaimCurrentIndex = (adoptableClaimCurrentIndex + 1) % adoptableClaimPhotos.length;
        updateAdoptableClaimCarousel();
    }

    function prevAdoptableClaimPhoto() {
        adoptableClaimCurrentIndex = (adoptableClaimCurrentIndex - 1 + adoptableClaimPhotos.length) % adoptableClaimPhotos.length;
        updateAdoptableClaimCarousel();
    }

    function closeAdoptableClaimPhotoCarousel() {
        const modal = document.getElementById('adoptableClaimPhotoCarousel');
        if (modal) modal.style.display = 'none';
    }

    function openImpoundedClaimPhotoCarousel(index) {
        if (impoundedClaimPhotos.length === 0) return;
        impoundedClaimCurrentIndex = index;
        updateImpoundedClaimCarousel();
        const modal = document.getElementById('impoundedClaimPhotoCarousel');
        if (modal) modal.style.display = 'flex';
    }

    function updateImpoundedClaimCarousel() {
        const file = impoundedClaimPhotos[impoundedClaimCurrentIndex];
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('impoundedClaimCarouselImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
        document.getElementById('impoundedClaimCarouselCounter').textContent = `${impoundedClaimCurrentIndex + 1} / ${impoundedClaimPhotos.length}`;
        document.getElementById('impoundedClaimCarouselPrev').style.display = impoundedClaimPhotos.length > 1 ? 'block' : 'none';
        document.getElementById('impoundedClaimCarouselNext').style.display = impoundedClaimPhotos.length > 1 ? 'block' : 'none';
    }

    function nextImpoundedClaimPhoto() {
        impoundedClaimCurrentIndex = (impoundedClaimCurrentIndex + 1) % impoundedClaimPhotos.length;
        updateImpoundedClaimCarousel();
    }

    function prevImpoundedClaimPhoto() {
        impoundedClaimCurrentIndex = (impoundedClaimCurrentIndex - 1 + impoundedClaimPhotos.length) % impoundedClaimPhotos.length;
        updateImpoundedClaimCarousel();
    }

    function closeImpoundedClaimPhotoCarousel() {
        const modal = document.getElementById('impoundedClaimPhotoCarousel');
        if (modal) modal.style.display = 'none';
    }

    // Keyboard navigation for carousels
    document.addEventListener('keydown', function(event) {
        // Adopt photo carousel
        const adoptCarousel = document.getElementById('adoptPhotoCarousel');
        if (adoptCarousel && !adoptCarousel.classList.contains('hidden')) {
            if (event.key === 'ArrowLeft') {
                prevAdoptPhoto();
                event.preventDefault();
            } else if (event.key === 'ArrowRight') {
                nextAdoptPhoto();
                event.preventDefault();
            } else if (event.key === 'Escape') {
                closeAdoptPhotoCarousel();
                event.preventDefault();
            }
            return;
        }

        // Adoptable claim photo carousel
        const adoptableClaimCarousel = document.getElementById('adoptableClaimPhotoCarousel');
        if (adoptableClaimCarousel && !adoptableClaimCarousel.classList.contains('hidden')) {
            if (event.key === 'ArrowLeft') {
                prevAdoptableClaimPhoto();
                event.preventDefault();
            } else if (event.key === 'ArrowRight') {
                nextAdoptableClaimPhoto();
                event.preventDefault();
            } else if (event.key === 'Escape') {
                closeAdoptableClaimPhotoCarousel();
                event.preventDefault();
            }
            return;
        }

        // Impounded claim photo carousel
        const impoundedClaimCarousel = document.getElementById('impoundedClaimPhotoCarousel');
        if (impoundedClaimCarousel && !impoundedClaimCarousel.classList.contains('hidden')) {
            if (event.key === 'ArrowLeft') {
                prevImpoundedClaimPhoto();
                event.preventDefault();
            } else if (event.key === 'ArrowRight') {
                nextImpoundedClaimPhoto();
                event.preventDefault();
            } else if (event.key === 'Escape') {
                closeImpoundedClaimPhotoCarousel();
                event.preventDefault();
            }
            return;
        }
    });
</script>
@endsection
