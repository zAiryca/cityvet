<!-- Verify the claim form conditional and show/hide -->
@if($pet->status === 'impounded')
    <p style="color: red; background: yellow; padding: 10px;">DEBUG: Impounded pet detected. Claim modal should be visible.</p>
@else
    <p style="color: blue; background: yellow; padding: 10px;">DEBUG: This pet has status: {{ $pet->status }}. Claim modal will NOT show.</p>
@endif
