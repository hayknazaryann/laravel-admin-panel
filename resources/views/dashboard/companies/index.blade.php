@extends('dashboard.layouts.app')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Companies</h5>
                        <h5 class="card-title">
                            <a href="{{ route('companies.create') }}" class="btn btn-sm btn-outline-success text-capitalize">
                                + Create
                            </a>
                        </h5>
                        <div class="table-responsive" id="data-list">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Logo</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Website</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($companies as $company)
                                    <tr>
                                        <th scope="row">{{ $company->id }}</th>
                                        <td>
                                            <img src="{{ $company->logo_full_path }}" alt="">
                                        </td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->website }}</td>
                                        <td>
                                            <a href="{{ route('companies.edit', $company->id) }}"
                                               title="{{ __('Edit') }}"
                                               type="button"
                                               class="btn btn-sm btn-outline-primary"
                                            >
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form method="post" action="{{ route('companies.destroy', $company->id) }}" class="d-inline-block">
                                                @method('DELETE')
                                                @csrf
                                                <a type="button" class="btn btn-sm btn-outline-danger delete btn-delete"
                                                   title="{{ __('Delete') }}"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">
                                            Empty data
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {!! $companies->links('dashboard.partials.pagination') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
