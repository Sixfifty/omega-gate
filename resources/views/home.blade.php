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
		    <p>Start a research to improve resources, add scans and create new types of ships!</p>

		    <div id="research1" class="researchBox">
		    	<span class="researchName">Solar Power Station</span>
		    	<p class="researchDescription">Allows the creation of Power Cells which produce Energy.</p>
		    	<div class="costContainer">
			    	Time: <span class="timeCost">36</span>
			    	Metal: <span class="metalCost">50000</span>
			    	Energy: <span class="energyCost">50000</span>
			    </div>
			    <button class="researchButton" value="1">Select</button>
		    </div>

		    <div id="accordion">
			  <h3>Resources</h3>
			  <div>
			    <table class="researchTable">
		    	<tr>
		    		<td></td>
		    		<td>
					    <div id="research2" class="researchBox"></div>
					<td>
				</tr>
				<tr><td colspan="3"><img src="resourceTier1Img.png"></td></tr>
				<tr>
					<td>
						<div id="research3" class="researchBox"></div>
					</td>
					<td>
						<div id="research4" class="researchBox"></div>
					</td>
					<td>
						<div id="research5" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="resourceTier2Img.png"></td></tr>
				<tr>
					<td>
						<div id="research6" class="researchBox"></div>
					</td>
					<td>
						<div id="research7" class="researchBox"></div>
					</td>
					<td>
						<div id="research8" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="resourceTier3Img.png"></td></tr>
				<tr>
					<td></td>
					<td>
						<div id="research9" class="researchBox"></div>
					</td>
				</tr>
			</table>
			  </div>
			  <h3>Scans</h3>
			  <div>
			  	<table class="researchTable">
		    	<tr>
		    		<td><img class="midTier" src="researchGap.png"></td>
		    		<td>
					    <div id="research10" class="researchBox"></div>
					<td><img class="midTier" src="researchGap.png"></td>
				</tr>
				<tr><td colspan="3"><img src="scanTierImg.png"></td></tr>
				<tr>
					<td></td>
		    		<td>
					    <div id="research11" class="researchBox"></div>
					<td>
				</tr>
				<tr><td colspan="3"><img src="scanTierImg.png"></td></tr>
				<tr>
					<td></td>
		    		<td>
					    <div id="research12" class="researchBox"></div>
					<td>
				</tr>
				<tr><td colspan="3"><img src="scanTierImg.png"></td></tr>
				<tr>
					<td></td>
		    		<td>
					    <div id="research13" class="researchBox"></div>
					<td>
				</tr>
			</table>
			  </div>
			  <h3>Ship Dock</h3>
			  <div>
			  	<table class="researchTable">
		    	<tr>
		    		<td></td>
		    		<td>
					    <div id="research14" class="researchBox"></div>
					<td>
				</tr>
				<tr><td colspan="3"><img src="dockTier1Img.png"></td></tr>
				<tr>
					<td></td>
					<td>
						<div id="research15" class="researchBox"></div>
					</td>
					<td>
						<div id="research16" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="dockTier2Img.png"></td></tr>
				<tr>
					<td></td>
					<td><img class="midTier" src="midTier.png"></td>
					<td>
						<div id="research17" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="dockTier3Img.png"></td></tr>
				<tr>
					<td>
						<div id="research18" class="researchBox"></div>
					</td>
					<td>
						<div id="research19" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="dockTier4Img.png"></td></tr>
				<tr>
					<td></td>
					<td>
						<div id="research20" class="researchBox"></div>
					</td>
				</tr>
			</table>
			  </div>
			  <h3>Armory</h3>
			  <div>
			  	<table class="researchTable">
		    	<tr>
		    		<td></td>
		    		<td>
					    <div id="research21" class="researchBox"></div>
					<td>
				</tr>
				<tr><td colspan="3"><img src="armoryTier1Img.png"></td></tr>
				<tr>
					<td>
						<div id="research22" class="researchBox"></div>
					</td>
					<td>
						<div id="research23" class="researchBox"></div>
					</td>
					<td>
						<div id="research24" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="armoryTier2Img.png"></td></tr>
				<tr>
					<td><img class="midTier" src="midTier.png"></td>
					<td>
						<div id="research25" class="researchBox">
					</td>
					<td>
						<div id="research26" class="researchBox"></div>
					</td>
				</tr>
				<tr><td colspan="3"><img src="armoryTier2Img.png"></td></tr>
				<tr>
					<td>
						<div id="research27" class="researchBox"></div>
					</td>
					<td><img class="midTier" src="midTier.png"></td>
					<td><img class="midTier" src="midTier.png"></td>
				</tr>
				<tr><td colspan="3"><img src="armoryTier3Img.png"></td></tr>
				<tr>
					<td></td>
					<td>
						<div id="research28" class="researchBox"></div>
					</td>
				</tr>
			</table>
			  </div>
			</div>
		  </div>
		  <div id="tabs-5">
		    <p>Section to show 'communications' received from other players and the option to send a new communication to another player.</p>
		  </div>
		  <div id="tabs-6">
		    <p>Help. Comes with a basic how to play and local samaritan number.</p>
		  </div>
		</div>
    </div>

    <script>
		$(function() {
		    $("#tabs").tabs();
		    $( "#accordion" ).accordion({
		    	active: false,
  				collapsible: true,});
		    $("input[type=submit], button").button();

		   $(".researchBox").html("<span class='researchName'>Solar Power Station</span><p class='researchDescription'>Allows the creation of Power Cells which produce Energy.</p><div class='costContainer'>Time: <span class='timeCost'>36</span>Metal: <span class='metalCost'>50000</span>Energy: <span class='energyCost'>50000</span></div><button class='researchButton' value='1'>Select</button>");

		    console.log('boop!');

		    function updateUser() {
			    $.ajax({url: '/api/user/whoami', success: function(data) {
			    	var user = data.user;
			    	window.currentUser = user;

			    	$('#asteroidsTotal').html(user.asteroids);
			    	$('#powerCellsTotal').html(user.power_cells);
			    }});
		    }

		    function researchGrab() {
		    	$.ajax({url: '/api/research', success: function(data) {
			    	
			    }});
		    }

		    function placeOrder(asteroids, powerCells) {
	    		$.ajax({
	    			method: "POST",
	    			url: '/api/user/placeOrder',
	    			headers: {
	    				'X-CSRF-TOKEN': $('#token').attr('value')
	    			},
	    			data: {
	    				asteroids: asteroids,
	    				powercells: powerCells
	    			},
	    			success: function(data) {
	    				console.log('derp');
	    				console.log(data);
	    			}
	    		});
		    }

		    window.placeOrder = placeOrder;

		    updateUser();
		    researchGrab();
		});
	</script>
@stop