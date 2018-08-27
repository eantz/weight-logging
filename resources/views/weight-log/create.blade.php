@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Weight Log</div>

                <div class="card-body">
                    @if (count($errors->all()) > 0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('weight-log.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="log-date">Date</label>
                            <input type="text" name="log_date" id="log-date" class="form-control" 
                                value="{{ old('log_date') }}" placeholder="Format: YYYY-MM-DD">
                        </div>

                        <div class="form-group">
                            <label for="min">Min</label>
                            <input type="number" name="min" id="min" class="form-control" 
                                value="{{ old('min') }}">
                        </div>

                        <div class="form-group">
                            <label for="max">Max</label>
                            <input type="number" name="max" id="max" class="form-control" 
                                value="{{ old('max') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
