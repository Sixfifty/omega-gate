@extends('layouts.default')
@section('content')
    <div class="container">
        <h1>Home</h1>
        <p>You are logged in, JavaScript happen!</p>

        <div id="tabs">
  <ul>
    <li><a href="#tabs-1">Resources</a></li>
    <li><a href="#tabs-2">Army</a></li>
    <li><a href="#tabs-3">Conquer</a></li>
    <li><a href="#tabs-4">Research</a></li>
    <li><a href="#tabs-5">Communication</a></li>
    <li><a href="#tabs-6">Help</a></li>
  </ul>
  <div id="tabs-1">
    <p>Open by default. Shows the user their current number of asteroids and power cells, also includes order form to order more asteroids/power cells.</p>

    Asteroids: <div id="asteroidsTotal"></div><br/>
    Power Cells: <div id="powerCellsTotal"></div><br/>

    [Order Form Test]<br/>
    <form>
    	Asteroids: 
    	<input type="number" id="asteroidOrder"> Current Cost: <span id="asteroidCost"/><br/>
    	Power Cells: 
    	<input type="number" id="powerCellOrder"> Current Cost: <span id="powerCellCost"/><br/>
    	<input type="submit">
    </form>
  </div>
  <div id="tabs-2">
    <p>Section to show current army and order form to order additional units.</p>
  </div>
  <div id="tabs-3">
    <p>Section to show current invasions, scan other planets (when available), and order invasions.</p>
  </div>
  <div id="tabs-4">
    <p>Section to show tech tree, what the user has completed, and to start new research.</p>
  </div>
  <div id="tabs-5">
    <p>Section to show 'communications' received from other players and the option to send a new communication to another player.</p>
  </div>
  <div id="tabs-6">
    <p>Help. Comes with a basic how to play and local samaritan number.</p>
  </div>
</div>
    </div>
@stop