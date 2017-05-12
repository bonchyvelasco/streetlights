@extends('layouts.master')

@section('title')
    Smart Stoplights - About
@endsection
    

@section('content-header')
    About
@endsection

@section('content')
<div class="col-sm-8">
   <div class="tab-content">
    <div id="content" class="tab-pane fade in active">
      <h3>HOME</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    <div id="content1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="content2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="content3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>
<div class="col-sm-2">
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a data-toggle="pill" href="#content" style = "">Home</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;"href="#content1">Menu 1</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content2">Menu 2</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content3">Menu 2</a></li>
    </ul>
</div>
@endsection