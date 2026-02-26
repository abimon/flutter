@extends('layouts.wedding', ['title' => 'Contributions Dashboard'])
@section('content')
<div class="container mt-5 profile-card">
    <h1>Wedding Contributions</h1>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(auth()->user()->role === 'treasurer')
    <button data-bs-toggle="modal" data-bs-target="#contributionModal" class="btn btn-primary mb-3">Add Contribution</button>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Contributor</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Added by</th>
                @if(auth()->user()->role === 'treasurer')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($contributions as $c)
            <tr>
                <td>{{ $c->created_at->format('Y-m-d') }}</td>
                <th>{{ $c->contributor_name }}</th>
                <td>{{ number_format($c->amount) }}</td>
                <td class="text-capitalize">{{ $c->payment_method }}</td>
                <td>{{ $c->payment_status }}</td>
                <td>{{ optional($c->addedBy)->name }}</td>
                <td>
                    <button class="btn btn-sm btn-info view-btn"
                        data-date="{{ $c->created_at->format('Y-m-d') }}"
                        data-amount="{{ $c->amount }}"
                        data-method="{{ $c->payment_method }}"
                        data-status="{{ $c->payment_status }}"
                        data-description="{{ e($c->description) }}"
                        data-addedby="{{ optional($c->addedBy)->name }}">
                        View
                    </button>
                </td>
                @if(auth()->user()->role === 'treasurer')
                <td>
                    <button class="btn btn-sm btn-secondary edit-btn"
                        data-id="{{ $c->id }}"
                        data-amount="{{ $c->amount }}"
                        data-method="{{ $c->payment_method }}"
                        data-status="{{ $c->payment_status }}"
                        data-description="{{ e($c->description) }}"
                        data-action="{{ route('contributions.update', $c) }}">
                        Edit
                    </button>
                    <form action="{{ route('contributions.destroy', $c) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');">Delete</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('wedding.index') }}">← Back to Wedding Page</a>
</div>

<!-- create/edit modal -->
<div class="modal fade" id="contributionModal" tabindex="-1" aria-labelledby="contributionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contributionModalLabel">Add Contribution</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="contributionForm" method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="contributor_name" class="form-label">Contributor Name</label>
                        <input type="text" name="contributor_name" id="modal_contributor_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" name="amount" id="modal_amount" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Category</label>
                        <select name="payment_method" id="modal_payment_method_select" class="form-select">
                            <option value="target">Personal Target</option>
                            <option value="challenge">Periodic Challenge</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <input type="text" name="payment_status" id="modal_payment_status" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea name="description" id="modal_description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="modalSubmitButton">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- view modal -->
<div class="modal fade" id="contributionViewModal" tabindex="-1" aria-labelledby="contributionViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contributionViewModalLabel">Contribution Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Date:</strong> <span id="view_date"></span></p>
                <p><strong>Amount:</strong> <span id="view_amount"></span></p>
                <p><strong>Method:</strong> <span id="view_method"></span></p>
                <p><strong>Status:</strong> <span id="view_status"></span></p>
                <p><strong>Description:</strong> <span id="view_description"></span></p>
                <p><strong>Entered by:</strong> <span id="view_addedby"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var contributionModal = new bootstrap.Modal(document.getElementById('contributionModal'));
        var viewModal = new bootstrap.Modal(document.getElementById('contributionViewModal'));

        document.getElementById('addContributionBtn') && document.getElementById('addContributionBtn').addEventListener('click', function() {
            document.getElementById('contributionModalLabel').textContent = 'Add Contribution';
            var form = document.getElementById('contributionForm');
            form.action = "{{ route('contributions.store') }}";
            form.method = 'POST';
            // remove _method if exists
            var methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
            form.reset();
            contributionModal.show();
        });

        document.querySelectorAll('.edit-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('contributionModalLabel').textContent = 'Edit Contribution';
                var form = document.getElementById('contributionForm');
                form.action = btn.getAttribute('data-action');
                form.method = 'POST';
                // ensure _method=PUT exists
                var methodInput = form.querySelector('input[name="_method"]');
                if (!methodInput) {
                    methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    form.appendChild(methodInput);
                }
                methodInput.value = 'PUT';
                // populate fields
                document.getElementById('modal_amount').value = btn.getAttribute('data-amount');
                document.getElementById('modal_payment_method').value = btn.getAttribute('data-method');
                document.getElementById('modal_payment_status').value = btn.getAttribute('data-status');
                document.getElementById('modal_description').value = btn.getAttribute('data-description');
                contributionModal.show();
            });
        });

        document.querySelectorAll('.view-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('view_date').textContent = btn.getAttribute('data-date');
                document.getElementById('view_amount').textContent = btn.getAttribute('data-amount');
                document.getElementById('view_method').textContent = btn.getAttribute('data-method');
                document.getElementById('view_status').textContent = btn.getAttribute('data-status');
                document.getElementById('view_description').textContent = btn.getAttribute('data-description');
                document.getElementById('view_addedby').textContent = btn.getAttribute('data-addedby');
                viewModal.show();
            });
        });
    });
</script>
@endsection