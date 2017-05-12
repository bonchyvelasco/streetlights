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
    <div id="content1" class="tab-pane fade in active">
      <h3>What is the system and the service it provides?</h3>
      <p>
    </p>
    </div>
    <div id="content2" class="tab-pane fade">
      <h3>How is this a smart cities solution?</h3>
      <p>

        </p>
    </div>
    <div id="content3" class="tab-pane fade">
      <h3>Why is there a need for such a system?<br/><small>What benefits would we get from get from connecting this &ldquo;thing&rdquo; to the Internet?</small></h3>
      <p>
      
      </p>
    </div>
    <div id="content4" class="tab-pane fade">
      <h3>How is the system implemented?</h3>
      <p>
        <figure class = "text-center">
            <img src = "{{ asset('img/Asset 2.png') }}" alt = "Architecture" style = "width: 90%; display: block; margin: 0 auto;"/>
            <figcaption class = "text-center"><i>System Architecture</i></figcaption>
        </figure>
        <br/><br/>
        <p>The system is composed of three parts. The sensing side, the server side, and the web-app side.</p>
        <br/>
        <h4>Sensing Side</h4>
        <p>This represents the hardware component of the system. It is composed of three color sensors, each designated for each light in a stoplight. Each sensor reads the color of a light continuously through time. All sensors are connected to an Arduino which then sends the live readings or “raw data” to the server.</p>
        <br/>
        <h4>Server Side</h4>
        <p>The server does the analysis of the readings gathered from the sensors. In this side, the “raw data” is processed and analyzed. The data is going to be interpreted and these interpretations is finally sent to the web application.</p>
        <br/>
        <h4>Web Application Side</h4>
        <p>The web application is the medium from which end users can benefit from. It is responsible for displaying the interpreted data from the server. The data is presented in a visually pleasant way (in this case we added a Google map interface).</p>

      </p>
    </div>
  </div>
</div>
<div class="col-sm-3">
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a data-toggle="pill" href="#content1" style = "">What is the system and the service it provides?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content2">How is this a smart cities solution?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content3">Why is there a need for such a system?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content4">How is the system implemented?</a></li>
    </ul>
</div>
@endsection