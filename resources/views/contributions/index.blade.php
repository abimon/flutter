<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contributions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0824c4 0%, #eb1241 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Section */
        .header {
            text-align: center;
            color: white;
            padding: 40px 20px;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 3.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 300;
            letter-spacing: 2px;
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.95;
        }

        /* Main Grid */
        .wedding-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .card h2 {
            color: #0824c4;
            margin-bottom: 20px;
            font-size: 1.8em;
            border-bottom: 3px solid #eb1241;
            padding-bottom: 15px;
        }

        /* Date & Venue */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-box {
            background: linear-gradient(135deg, #0824c415 0%, #eb124115 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #0824c4;
        }

        .info-box h3 {
            color: #0824c4;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-box p {
            font-size: 1.3em;
            color: #333;
            font-weight: 500;
        }

        .venue-address {
            font-size: 0.95em !important;
            color: #666 !important;
            font-weight: 400 !important;
            margin-top: 5px;
        }

        /* Bride & Groom Profiles */
        .couple-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeIn 0.6s ease-out;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            align-items: baseline;
            margin: 0 auto 20px;
            border: 4px solid #0824c4;
            display: block;
        }

        .profile-name {
            font-size: 1.8em;
            color: #333;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .profile-title {
            font-size: 1em;
            color: #eb1241;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Progress Bar */
        .progress-section h3 {
            color: #0824c4;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.95em;
        }

        .progress-bar {
            width: 100%;
            height: 25px;
            background: #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0824c4 0%, #eb1241 100%);
            width: 65%;
            transition: width 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 10px;
            color: white;
            font-size: 0.8em;
            font-weight: bold;
        }

        .currency {
            font-size: 0.9em;
            color: #666;
        }

        /* QR Code Section */
        .qr-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: linear-gradient(135deg, #0824c415 0%, #eb124115 100%);
            border-radius: 15px;
        }

        .qr-section h3 {
            color: #0824c4;
            margin-bottom: 20px;
            font-size: 1.2em;
            text-align: center;
        }

        .qr-code-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
        }

        .qr-code-container svg {
            max-width: 100%;
            height: auto;
        }

        .qr-instruction {
            font-size: 0.95em;
            color: #666;
            text-align: center;
            margin-top: 15px;
        }

        /* Photos Section */
        .photos-section {
            grid-column: 1 / -1;
        }

        .photos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .photo-item {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            aspect-ratio: 1;
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-item:hover img {
            transform: scale(1.1);
        }

        .no-photos {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }

            .couple-grid {
                grid-template-columns: 1fr;
                margin-bottom: 30px;
            }

            .profile-image {
                width: 120px;
                height: 120px;
            }

            .profile-name {
                font-size: 1.4em;
            }

            .wedding-grid {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .qr-code-container {
                max-width: 300px;
            }

            .photos-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.6s ease-out;
        }

        .card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card:nth-child(3) {
            animation-delay: 0.4s;
        }

        .card:nth-child(4) {
            animation-delay: 0.6s;
        }

        .profile-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .profile-card:nth-child(2) {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body>
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
                    <th>Amount</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Description</th>
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
                    <td>{{ number_format($c->amount) }}</td>
                    <td class="text-capitalize">{{ $c->payment_method }}</td>
                    <td>{{ $c->payment_status }}</td>
                    <td>{{ $c->description }}</td>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>