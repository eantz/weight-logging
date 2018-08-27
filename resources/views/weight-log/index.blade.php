@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Weight Logs</div>

                <div class="card-body">
                    <a href="{{ route('weight-log.create') }}" class="btn btn-success">Add</a>
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Min</th>
                                <th>Max</th>
                                <th>Variance</th>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weight_logs as $weight)
                                <tr>
                                    <td>{{ $weight->log_date }}</td>
                                    <td>{{ $weight->min }}</td>
                                    <td>{{ $weight->max }}</td>
                                    <td>{{ $weight->variance }}</td>
                                    <td>
                                        <a href="{{ route('weight-log.show', $weight) }}" class="btn btn-success">Show</a>
                                        <a href="{{ route('weight-log.edit', $weight) }}" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger"
                                            onclick="event.preventDefault();
                                                document.getElementById('delete-{{ $weight->id }}').submit();">
                                            Delete
                                        </a>

                                        <form action="{{ route('weight-log.destroy', $weight) }}" method="POST" 
                                            style="display:none;" id="delete-{{ $weight->id }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                        @if ($weight_logs_average)
                            <tfoot>
                                <tr>
                                    <th>Average</th>
                                    <td>{{ round($weight_logs_average->avg_min, 1) }}</td>
                                    <td>{{ round($weight_logs_average->avg_max, 1) }}</td>
                                    <td>{{ round($weight_logs_average->avg_variance, 1) }}</td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
