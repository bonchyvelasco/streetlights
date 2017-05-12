@extends('layouts.master')

@section('title')
    Smart Stoplights - Readings
@endsection
    

@section('content-header')
    Readings
@endsection

@section('content')
<div class="col-sm-8">
    <table class="table">
    <thead>
      <tr>
        <th>Stoplight</th>
        <th>Red</th>
        <th>Yellow</th>
        <th>Green</th>
        <th>Time</th>
      </tr>
    </thead>
    <tbody>
    @forelse($readings as $reading)
      <tr>
        <td>{{ $reading->stoplight_id }}</td>
        <td>{{ $reading->r }}</td>
        <td>{{ $reading->y }}</td>
        <td>{{ $reading->g }}</td>
        <td>{{ $reading->time }}</td>
      </tr>
    @empty
        <tr colspan = "5">There are no readings to show.</tr>
    @endforelse
    </tbody>
  </table>
</div>
@endsection