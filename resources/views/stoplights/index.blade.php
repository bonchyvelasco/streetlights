@extends('layouts.master')

@section('title')
    Smart Stoplights - Stoplights
@endsection
    

@section('content-header')
    Stoplights
@endsection

@section('content')
<div class="col-sm-8">
    <table class="table">
    <thead>
      <tr>
        <th>Stoplight</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Status</th>
        <th>Error</th>
      </tr>
    </thead>
    <tbody>
    @forelse($stoplights as $stoplight)
      <tr>
        <td>{{ $stoplight->name }}</td>
        <td>{{ $stoplight->longitude }}</td>
        <td>{{ $stoplight->latitude }}</td>
        <td>{{ $stoplight->status }}</td>
        <td>{{ $stoplight->error }}</td>
      </tr>
    @empty
        <tr colspan = "3">There are no readings to show.</tr>
    @endforelse
    </tbody>
  </table>
</div>
@endsection