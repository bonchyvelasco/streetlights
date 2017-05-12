@extends('layouts.master')

@section('title')
    Smart Stoplights - About
@endsection
    

@section('content-header')
    About
@endsection

@section('content')
<div class="col-sm-3">
    <ul class="nav nav-pills nav-stacked">
      <li class="active"><a data-toggle="pill" href="#content1" style = "">What is the system and the service it provides?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content2">How is this a smart cities solution?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content3">Why is there a need for such a system?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content4">How is the system implemented?</a></li>
      <li><a data-toggle="pill" style = "margin-top: -22px;" href="#content5">The Developers</a></li>
    </ul>
</div>
<div class="col-sm-8">
   <div class="tab-content">
    <div id="content1" class="tab-pane fade in active">
      <h3>What is the system and the service it provides?</h3>
      <br/><br/>
      <figure class = "text-center">
          <img src = "{{ asset('img/Asset 4.png') }}" alt = "WebApp" style = "width: 90%; display: block; margin: 0 auto;"/>
          <figcaption class = "text-center"><i>Web Application</i></figcaption>
      </figure>
      <br/><br/>
      <p>
      <strong>The Smart Stoplight System is a Smart City IoT (Internet of Things) system.</strong> The main goal of the system is to monitor the stoplights in the city, checking if each stoplight still functions as it’s supposed to, and if the sequence of lights displayed by nearby stoplights go in a sensical manner with respect to others.
      </p>
      <p>
      The service the system provides is a web application. The web application includes a Google map interface and displays the readings of light sequences of each stoplight. The areas that have stoplights are marked on the map. Each stoplight’s readings will be analyzed and once the readings don’t make sense, an error message will be displayed on the interface. In summary, the web application displays the status (whether it’s working or not) of each stoplight on the map. 
      </p>
    </div>
    <div id="content2" class="tab-pane fade">
      <h3>How is this a smart cities solution?</h3>
      <br/><br/>
      <figure class = "text-center">
          <img src = "{{ asset('img/Asset 5.png') }}" alt = "IoT" style = "width: 50%; min-width: 300px; display: block; margin: 0 auto;"/>
          <figcaption class = "text-center"><i>Internet of Things</i></figcaption>
      </figure>
      <br/><br/>
      <p>
      Smart cities solutions improves the quality of life of people by making city operations more efficient.</p>

      <p>A non-functioning traffic light causes traffic and stress to commuters and drivers.  Using our system, the MMDA can easily figure out if there's a non-functioning traffic light. They can easily respond to the said problem by immediately sending a traffic officer to manage the traffic in the meantime, or they can repair the non-functioning traffic light as soon as possible.
        </p>
    </div>
    <div id="content3" class="tab-pane fade">
      <h3>Why is there a need for such a system?<br/><small>What benefits would we get from get from connecting this &ldquo;thing&rdquo; to the Internet?</small></h3>
      <p>
      The status of stoplights at different cities in the Philippines are currently checked manually by authorities. In this case, no automated notifications about the status of a stoplight are being sent to the authorities so they only depend on individual reports. These individual reports are not sent immediately after a stop light malfunctions due to lack of proper communications with the authorities. This scenario results to disturbances in the road where the stoplight is located which could cause accidents and heavy traffic. This could happen because traffic depends on the synchronization of stoplights within an area. Therefore, if one stoplight is defective then the synchronization will be disrupted.
      </p>
      <p>
      The project provides a solution to this problem by installing sensors on stoplights to detect their output. The architecture of the project requires an Arduino to send the data from the sensors to a server where it will be stored in a database. Each reading on every stoplight will be analyzed to determine if a specific stoplight is defective. The status of the stoplights will be updated in the database and displayed on a website. A map is also included in the website to easily pinpoint the location of a defective stoplight. The project allows the authorities to determine the status of the stoplights in a quick and efficient way so they can perform the necessary actions to prevent road disturbances. Individual reports and manual checking will no longer be needed because the delivery and analysis of the stoplights status is automated in the project. 
      </p>
    </div>
    <div id="content4" class="tab-pane fade">
      <h3>How is the system implemented?</h3>
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
        <br/><br/>
        <figure class = "text-center">
            <img src = "{{ asset('img/Asset 3.png') }}" alt = "Schema" style = "width: 90%; display: block; margin: 0 auto;"/>
            <figcaption class = "text-center"><i>Database Schema</i></figcaption>
        </figure>
        <br/><br/>
        <p>The schema shown previously shows the blueprint of how the <i>Stoplights</i> database is constructed. The tables, readings and stoplights, have a relationship of many-to-one. They’re also related using the stoplight_id as the foreign key.</p>
        <br/><br/>
        <br/><br/>
    </div>
    <div id="content5" class="tab-pane fade">
      <h3>The Developers</h3>
        <br/><br/>
        <figure class = "text-center">
            <img src = "{{ asset('img/Asset 6.png') }}" alt = "Us" style = "width: 90%; display: block; margin: 0 auto;"/>
        </figure>
        <br/><br/>
        <br/><br/>
        <h5>Wijangco, Iya</h5>
        <h5>Maraon, Renee</h5>
        <h5>Bilaw, Nicole</h5>
        <h5>Cornelio, Lea</h5>
        <h5>Velasco, Bonchy</h5>
        <h5><i>from left to right</i></h5>
        <br/><br/>
    </div>
  </div>
</div>
@endsection