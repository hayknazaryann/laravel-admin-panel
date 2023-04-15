@extends('dashboard.layouts.app')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="card m-auto">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Create Company') }}</h5>

                        <form class="row g-3" method="post" action="{{route('companies.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-12">
                                <div class="col-md-8 m-auto">
                                    <div class="form-floating has-validation mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" placeholder="{{__('Company name')}}"
                                               value="{{old('name')}}">
                                        @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <label for="name">{{ __('Company name') }}</label>
                                    </div>
                                    <div class="form-floating has-validation mb-3">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                               id="email" name="email" placeholder="{{__('Company email')}}"
                                               value="{{old('email')}}">
                                        @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <label for="name">{{ __('Company email') }}</label>
                                    </div>
                                    <div class="form-floating has-validation mb-3">
                                        <input type="text" class="form-control @error('website') is-invalid @enderror"
                                               id="website" name="website" placeholder="{{__('Company website')}}"
                                               value="{{old('website')}}">
                                        @error('website')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        <label for="name">{{ __('Company website') }}</label>
                                    </div>
                                    <div class="mb-3">
                                        <h6 >{{ __('Company logo') }}</h6>
                                        <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                               id="logo" name="logo" placeholder="{{__('Company logo')}}"
                                               value="{{old('logo')}}">
                                        @error('logo')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success" id="save">{{__('Create')}}</button>
                                        <button type="reset" class="btn btn-secondary">{{__('Reset')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
