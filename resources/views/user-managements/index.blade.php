@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <x-common.breadcrumb :title="'Users'"
                         :breadcrumbs="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Manage users']]"/>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">All users</h3>
                    <div>
                        <button class="btn btn-sm btn-secondary d-flex align-items-center" data-bs-toggle="modal"
                                data-bs-target="#addOrEditModal">
                            <i class="ph ph-plus me-1"></i>
                            Add
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <x-table id="dataTable"
                             :thead="[
                            [
                                'label' => '#',
                                'class' => 'th-sn',
                            ],
                            [
                                'label' => 'Name',
                                'class' => 'th-name',
                            ],
                            [
                                'label' => 'Email',
                                'class' => 'th-email',
                            ],
                            [
                                'label' => 'Roles',
                                'class' => 'th-roles',
                            ],
                            [
                                'label' => 'Actions',
                                'class' => 'th-actions',
                            ],
                        ]"
                    />
                </div>
            </div>
        </div>
    </div>

    @include('components.common.datatable-css')
    @include('components.common.datatable-script')
@endsection
@section('page-script')
    <script>
        $(document).ready(function () {
            let table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'roles',
                        name: 'roles'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'asc']
                ]
            });
        });
    </script>
@endsection

