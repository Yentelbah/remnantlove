@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Financial Transactions</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Transactions</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('finance.index') }}">Finance</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Transactions</li>
        </ol>
    </nav>
    </div>
</div>

        <div class="card">
            <div class="card-body">
                <div class="justify-between mb-2 d-flex">
                    <h4 class="mb-0 card-title">Transactions</h4>

                </div>

                <div class="p-3 table-responsive">
                    <table class="table align-middle search-table text-nowrap" id="table">
                    <thead class="header-item">
                        <th>#</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th><i class="ti ti-dots-vertical fs-6"></i>
                        </th>
                    </thead>
                    <tbody>
                        <!-- start row -->
                        @php $i = 1; @endphp
                        @foreach ($transactions as $item)

                        <tr class="search-items">
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <span class="usr-ph-no" data-phone="{{ $item->entry_date }}">{{ $item->entry_date }}</span>
                        </td>
                        <td>
                            <span class="usr-ph-no" data-phone="{{ $item->description }}">{{ $item->description }}</span>
                        </td>
                        <td>
                            <span class="usr-location" data-location="{{ $item->amount }}">{{ $item->amount }}</span>
                        </td>

                        <td>
                            <div class="dropdown dropstart">
                                <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li>
                                    <a class="gap-3 dropdown-item d-flex align-items-center" href="{{ route('financeShowDetails',['journalID' => $item->id]) }}">
                                        <i class="fs-4 ti ti-eye"></i>View
                                    </a>
                                </li>

                                <li>
                                    <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" class="dropdown-item" value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal('{{ $item->id }}')"><i class="fs-4 ti ti-edit"></i>Edit</a>
                                </li>
                                <li>
                                        <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" class="dropdown-item" value="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="openDeleteModal('{{ $item->id }}')"><i class="fs-4 ti ti-trash"></i>Delete</a>
                                </li>

                                </ul>
                            </div>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>

                </div>

            </div>
        </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#table').DataTable(); // ID From dataTable with Hover
        });
    </script>

@endsection
