<!-- Mark Pet as Returned Modal -->
<div id="returnPetModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full max-h-screen overflow-y-auto">
        <div class="sticky top-0 flex items-center justify-between p-6 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Mark Pet as Returned</h3>
            <button onclick="document.getElementById('returnPetModal').style.display = 'none';" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('admin.pets.mark-returned', $pet) }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="return_reason" class="block text-sm font-medium text-gray-700 mb-2">
                    Reason for Return <span class="text-red-500">*</span>
                </label>
                <select name="return_reason" id="return_reason" class="block w-full border border-gray-300 rounded-md p-2 text-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">-- Select a reason --</option>
                    <option value="Owner Relocation/Moving">Owner Relocation/Moving</option>
                    <option value="Owner Illness/Death">Owner Illness/Death</option>
                    <option value="Financial Hardship">Financial Hardship</option>
                    <option value="Landlord/Housing Restriction">Landlord/Housing Restriction</option>
                    <option value="Lifestyle/Schedule Change">Lifestyle/Schedule Change</option>
                    <option value="Incompatibility with Existing Pets">Incompatibility with Existing Pets</option>
                    <option value="Incompatibility with Children">Incompatibility with Children</option>
                    <option value="Household Allergies">Household Allergies</option>
                    <option value="Needs More Space/Exercise">Needs More Space/Exercise</option>
                    <option value="Behavioral Issues">Behavioral Issues (Requires Detail in Notes)</option>
                </select>
                @error('return_reason')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="return_notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Additional Notes <span class="text-gray-500">(Optional)</span>
                </label>
                <textarea name="return_notes" id="return_notes" rows="3" class="block w-full border border-gray-300 rounded-md p-2 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Any additional details about the return..."></textarea>
                @error('return_notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-2 pt-4">
                <button type="button" onclick="document.getElementById('returnPetModal').style.display = 'none';" class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 rounded-md transition" onclick="return confirm('Mark this pet as RETURNED and set to adoptable?')">
                    <svg class="inline w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Confirm Return
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openReturnModal() {
        document.getElementById('returnPetModal').style.display = 'flex';
    }

    // Close modal when clicking outside
    document.getElementById('returnPetModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            this.style.display = 'none';
        }
    });
</script>
