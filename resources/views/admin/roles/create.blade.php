@extends('layouts.admin')

@section('content')

    <div class="card">
        <div class="card-header">{{ __('Add New Role') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf


                <div class="form-group row">
                    <label for="title" class="required col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title">

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="short_code" class="col-md-4 col-form-label text-md-right">{{ __('Short Code') }}</label>

                    <div class="col-md-6">
                        <input id="short_code" type="text" class="form-control @error('short_code') is-invalid @enderror" name="short_code" value="{{ old('short_code') }}" autocomplete="short_code" >

                        @error('short_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        var permission_select = new SlimSelect({
            select: '#permissions-select select',
            //showSearch: false,
            placeholder: 'Select Permissions',
            deselectLabel: '<span>&times;</span>',
            hideSelectedOption: true,
        })

        $('#permissions-select #permission-select-all').click(function(){
            var options = [];
            $('#permissions-select select option').each(function(){
                options.push($(this).attr('value'));
            });

            permission_select.set(options);
        })

        $('#permissions-select #permission-deselect-all').click(function(){
            permission_select.set([]);
        })
    </script>
@endsection
