@extends('layouts.app')

@section('title', 'Services')

@push('styles')
<link
    rel="stylesheet"
    href="{{ asset('assets/css/services.css') }}"
>
@endpush

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                Services
            </h2>

            <p class="text-muted">
                Manage all services
            </p>
        </div>

        <button
            class="btn btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#addServiceModal"
        >
            + Add Service
        </button>

    </div>

    {{-- SEARCH --}}
    <div class="row mb-4">

        <div class="col-md-4">

            <input
                type="text"
                id="searchInput"
                class="form-control"
                placeholder="Search service..."
            >

        </div>

    </div>

    {{-- STATS --}}
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="stats-card">

                <div class="stats-title">
                    Total Services
                </div>

                <div class="stats-number">
                    {{ count($services) }}
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
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($services as $service)

                <tr>

                    <td>{{ $service['id'] }}</td>

                    <td>{{ $service['name'] }}</td>

                    <td>
                        Rp {{ number_format($service['price']) }}
                    </td>

                    <td>
                        {{ $service['description'] }}
                    </td>

                    <td>

                        @if($service['status'])

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

                            <button
                                class="btn btn-sm btn-warning editBtn"

                                data-id="{{ $service['id'] }}"
                                data-name="{{ $service['name'] }}"
                                data-price="{{ $service['price'] }}"
                                data-description="{{ $service['description'] }}"

                                data-bs-toggle="modal"
                                data-bs-target="#editServiceModal"
                            >
                                Edit
                            </button>

                            <form
                                action="{{ route('services.destroy', $service['id']) }}"
                                method="POST"
                                class="deleteForm"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                >
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="text-center py-4">
                        No service data
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ADD MODAL --}}
<div
    class="modal fade"
    id="addServiceModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add Service
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <form
                action="{{ route('services.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary-custom"
                    >
                        Save Service
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- EDIT MODAL --}}
<div
    class="modal fade"
    id="editServiceModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Edit Service
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <form
                id="editForm"
                method="POST"
            >

                @csrf
                @method('PATCH')

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="editName"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Price
                        </label>

                        <input
                            type="number"
                            name="price"
                            id="editPrice"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            id="editDescription"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary-custom"
                    >
                        Update Service
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/services.js') }}"></script>
@endpush