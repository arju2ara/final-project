@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Parcel Report</h2>
    <form action="{{ route('parcels.report') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Show Report</button>
    </form>

    @if (request()->isMethod('post'))
        @if ($parcels->isEmpty())
            <p class="mt-5">No parcels found for the selected dates.</p>
        @else
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sender Name</th>
                        <th>Recipient Name</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parcels as $parcel)
                        <tr>
                            <td>{{ $parcel->id }}</td>
                            <td>{{ $parcel->sender_name }}</td>
                            <td>{{ $parcel->recipient_name }}</td>
                            <td>{{ $parcel->status }}</td>
                            <td>{{ $parcel->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
</div>
@endsection
