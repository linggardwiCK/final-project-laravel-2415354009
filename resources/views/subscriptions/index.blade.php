@extends('layouts.app')

@section('title', 'Subscriptions')

@push('styles')
<link
    rel="stylesheet"
    href="{{ asset('assets/css/subscriptions.css') }}"
>
@endpush

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                Subscriptions
            </h2>

            <p class="text-muted">
                Manage subscriptions
            </p>
        </div>

        <button
            class="btn btn-primary-custom"
            data-bs-toggle="modal"
            data-bs-target="#addSubscriptionModal"
        >
            + Add Subscription
        </button>

    </div>

    {{-- SEARCH --}}
    <div class="row mb-4">

        <div class="col-md-4">

            <input
                type="text"
                id="searchInput"
                class="form-control"
                placeholder="Search subscription..."
            >

        </div>

    </div>

    {{-- STATS --}}
    <div class="row mb-4">

        <div class="col-md-4">

            <div class="stats-card">

                <div class="stats-title">
                    Total Subscriptions
                </div>

                <div class="stats-number">
                    {{ count($subscriptions) }}
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
                    <th>Customer</th>
                    <th>Service</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($subscriptions as $subscription)

                <tr>

                    <td>
                        {{ $subscription['id'] }}
                    </td>

                    <td>
                        {{ $subscription['customer']['name'] ?? '-' }}
                    </td>

                    <td>
                        {{ $subscription['service']['name'] ?? '-' }}
                    </td>

                    <td>
                        {{ $subscription['start_date'] }}
                    </td>

                    <td>
                        {{ $subscription['end_date'] }}
                    </td>

                    <td>

                        @php
                            $status = $subscription['status'];
                        @endphp

                        <span class="status-badge status-{{ $status }}">
                            {{ ucfirst($status) }}
                        </span>

                    </td>

                    <td>

                        <form
                            action="{{ route('subscriptions.status', $subscription['id']) }}"
                            method="POST"
                            class="statusForm"
                        >

                            @csrf
                            @method('PATCH')

                            <select
                                name="status"
                                class="form-select form-select-sm statusSelect"
                            >

                                <option value="active">
                                    Active
                                </option>

                                <option value="inactive">
                                    Inactive
                                </option>

                                <option value="trial">
                                    Trial
                                </option>

                                <option value="isolir">
                                    Isolir
                                </option>

                                <option value="dismantle">
                                    Dismantle
                                </option>

                            </select>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center py-4">
                        No subscription data
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
    id="addSubscriptionModal"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Add Subscription
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>

            <form
                action="{{ route('subscriptions.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Customer
                        </label>

                        <select
                            name="customer_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Customer
                            </option>

                            @foreach($customers as $customer)

                            <option value="{{ $customer['id'] }}">
                                {{ $customer['name'] }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Service
                        </label>

                        <select
                            name="service_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Service
                            </option>

                            @foreach($services as $service)

                            <option value="{{ $service['id'] }}">
                                {{ $service['name'] }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            class="form-control"
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            End Date
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            class="form-control"
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="active">
                                Active
                            </option>

                            <option value="inactive">
                                Inactive
                            </option>

                            <option value="trial">
                                Trial
                            </option>

                            <option value="isolir">
                                Isolir
                            </option>

                        </select>

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
                        Save Subscription
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/js/subscriptions.js') }}"></script>
@endpush