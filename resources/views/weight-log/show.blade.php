@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Weight Log</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Date</td>
                            <td>{{ $weightLog->log_date }}</td>
                        </tr>
                        <tr>
                            <td>Max</td>
                            <td>{{ $weightLog->max }}</td>
                        </tr>
                        <tr>
                            <td>Min</td>
                            <td>{{ $weightLog->min }}</td>
                        </tr>
                        <tr>
                            <td>Variance</td>
                            <td>{{ $weightLog->variance }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
