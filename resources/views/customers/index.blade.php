@extends('layouts.app')

@section('title', 'Customers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/customers.css') }}">
@endpush

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="row mb-4">

                <div class="col-md-4">

                    <input type="text" id="searchInput" class="form-control" placeholder="Search customer...">

                </div>

            </div>
            <div>
                <h2 class="fw-bold">
                    Customers
                </h2>

                <p class="text-muted">
                    Manage all customer data
                </p>
            </div>

            <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                + Add Customer
            </button>
        </div>

        {{-- STATS --}}
        <div class="row mb-4">

            <div class="col-md-4">

                <div class="stats-card">

                    <div class="stats-title">
                        Total Customers
                    </div>

                    <div class="stats-number">
                        {{ count($customers) }}
                    </div>

                </div>

            </div>

        </div>

        {{-- TABLE --}}
        <div class="custom-table">

            <table class="table">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($customers as $customer)
                        <tr>

                            <td>
                                {{ $customer['id'] }}
                            </td>

                            <td>
                                {{ $customer['name'] }}
                            </td>

                            <td>
                                {{ $customer['email'] }}
                            </td>

                            <td>
                                {{ $customer['phone'] }}
                            </td>

                            <td>

                                @if (isset($customer['status']) && $customer['status'])
                                    <span class="badge-active">
                                        Active
                                    </span>
                                @else
                                    <span class="badge-inactive">
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            <td>

                                <div class="d-flex gap-2">

                                    <button class="btn btn-sm btn-warning editBtn" data-id="{{ $customer['id'] }}"
                                        data-name="{{ $customer['name'] }}" data-email="{{ $customer['email'] }}"
                                        data-phone="{{ $customer['phone'] }}" data-address="{{ $customer['address'] }}"
                                        data-bs-toggle="modal" data-bs-target="#editCustomerModal">
                                        Edit
                                    </button>

                                    <form action="{{ route('customers.destroy', $customer['id']) }}" method="POST"
                                        class="deleteForm">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-4">
                                No customer data
                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- ADD MODAL --}}
    <div class="modal fade" id="addCustomerModal" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Add Customer
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <form action="{{ route('customers.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Name
                            </label>

                            <input type="text" name="name" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Phone
                            </label>

                            <input type="text" name="phone" class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea name="address" class="form-control" rows="3"></textarea>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit" class="btn btn-primary-custom">
                            Save Customer
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
    {{-- EDIT MODAL --}}
    <div class="modal fade" id="editCustomerModal" tabindex="-1">

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        Edit Customer
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>

                <form id="editForm" method="POST">

                    @csrf
                    @method('PATCH')

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">
                                Name
                            </label>

                            <input type="text" name="name" id="editName" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email" name="email" id="editEmail" class="form-control" required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Phone
                            </label>

                            <input type="text" name="phone" id="editPhone" class="form-control">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <textarea name="address" id="editAddress" class="form-control" rows="3"></textarea>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit" class="btn btn-primary-custom">
                            Update Customer
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    @push('scripts')
        <script src="{{ asset('assets/js/customers.js') }}"></script>
    @endpush

@endsection
