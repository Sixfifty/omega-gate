@extends('layouts.default')
@section('content')
    <div class="container">
        <h1 id="welcome"></h1>

        <div id="tabs">
		  <ul>
		    <li><a href="#tabs-1">Resources</a></li>
		    <li><a href="#tabs-2">Army</a></li>
		    <li><a href="#tabs-3">Conquer</a></li>
		    <li><a href="#tabs-4">Research</a></li>
		  </ul>
		  <div id="tabs-1">
		  	<div id="currentResourceContainer">
			  	<h4>Current Resources:</h4>
			    <div>Asteroids: <span id="asteroidsTotal"></span></div>
			    <div>Power Cells: <span id="powerCellsTotal"></span></div>
			</div>

		    <div id="resourceOrderForm">
		    	<h4>[Order Form]</h4>
			    <form>
			    	<table>
			    		<tr>
			    			<td>Asteroids:</td>
			    			<td><input type="number" id="asteroidOrder"></td> 
			    			<td>Current Cost: <span id="asteroidCost"/></td>
			    		</tr>
			    		<tr>
			    			<td>Power Cells:</td>
			    			<td><input type="number" id="powerCellOrder"></td>
			    			<td>Current Cost: <span id="powerCellCost"/></td>
			    		</tr>
			    		<tr>
			    			<td colspan=3><input type="submit" id="resourceSubmit"></td>
			    	</table>
			    </form>
			</div>
		  </div>
		  <div id="tabs-2">
		    <p>Section to show current army and order form to order additional units.</p>
		  </div>
		  <div id="tabs-3">
		    <p>Section to show current invasions, scan other planets (when available), and order invasions.</p>
		  </div>
		  <div id="tabs-4">
		    <p>Start a research to improve resources, add scans and create new types of ships!</p>
		    <div id="researchError" class='ui-state-error ui-corner-all' hidden>
		    	<p>
		    		<span class="ui-icon ui-icon-alert"></span> 
		    		<strong>Alert:</strong>You cannot afford that research!
		    </div>

		    <div id="research1" class="researchBox"></div>

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
				<tr><td colspan="3"><img src="dockTier1Img.png"></td></tr>
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
			  <h3>Armoury</h3>
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
		</div>
    </div>

    <script>
    	var RESEARCH_COMPLETE = "researchComplete",
    		RESEARCH_AVAILABLE = "researchAvailable",
    		RESEARCH_IN_PROG = "researchInProg";

		$(function() {
		    $("#tabs").tabs();
		    $( "#accordion" ).accordion({
		    	active: false,
  				collapsible: true,});
		    $("input[type=submit], button").button();

		    function updateUser() {
			    $.ajax({url: '/api/user/whoami', success: function(data) {
			    	var user = data.user,
			    		research = user.research;
			    	window.currentUser = user;

					updateResources();
					$('#userPlanet').html('Planet ' + user.planet_name);
					$('#welcome').html('Greetings, Commander ' + user.username + '!');
			    	$('#asteroidsTotal').html(user.asteroids);
			    	$('#powerCellsTotal').html(user.power_cells);

			    	var researchClass;

			    	for(var i = 0; i < user.research.length; i++) {
			    		researchClass = getResearchClass(research[i].state);
			    		$("#research" + research[i].id).html("<span class='researchName'>" + research[i].name + "</span><p class='researchDescription'>" + research[i].description + "</p><div class='costContainer'>Time: <span class='timeCost'>" + research[i].time_cost + "</span>Metal: <span class='metalCost'>" + research[i].metal_cost + "</span>Energy: <span class='energyCost'>" + research[i].energy_cost + "</span></div><button id='researchButton" + research[i].id + "' class='researchButton' disabled onClick='beginResearch(" + research[i].id + ")'>Select</button><span class='researchPending hidden'>Researching...</span>");

			    		$("#research" + research[i].id).addClass(researchClass);
			    		if (researchClass === RESEARCH_COMPLETE) {
			    			$("#researchButton" + research[i].id).hide();
			    			$("#research" + research[i].id).children(".costContainer").hide();
				    	} else if (researchClass === RESEARCH_AVAILABLE) {
				    		$("#researchButton" + research[i].id).removeAttr('disabled');
				    	} else if (researchClass === RESEARCH_IN_PROG) {
				    		$("#researchButton" + research[i].id).hide();
				    		$("#research" + research[i].id).children(".costContainer").hide();
				    		$("#research" + research[i].id).children(".researchPending").removeClass("hidden");
				    	}
			    	}
			    }});
		    }

		    function updateResources() {
		    	$('#userMetal').html('Metal: ' + window.currentUser.metal);
				$('#userEnergy').html('Energy: ' + window.currentUser.energy);
		    }

		    function getResearchClass(state) {
		    	var researchCls;

		    	switch(state) {
		    		case 1: 
		    			researchCls = RESEARCH_COMPLETE;
		    			break;
		    		case 2:
		    			researchCls = RESEARCH_AVAILABLE;
		    			break;
		    		case 3:
		    			researchCls = RESEARCH_IN_PROG;
		    			break;

		    		//Case 4 default: not available
		    	}

		    	return researchCls;
		    }

		    function placeOrder(asteroids, powerCells) {
	    		$.ajax({
	    			method: "POST",
	    			url: '/api/user/order/place',
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

		    function beginResearch(researchId) {
		    	$("#researchError").hide();
		    	if (window.currentUser.metal >= $('#research' + researchId).find('.metalCost').text() && window.currentUser.energy >= $('#research' + researchId).find('.energyCost').text()) {
		    		$.ajax({
		    			method: "POST",
		    			url: '/api/user/research/begin',
		    			headers: {
		    				'X-CSRF-TOKEN': $('#token').attr('value')
		    			},
		    			data: {
		    				researchId: researchId
		    			},
		    			success: function(data) {
		    				$("#research" + researchId).addClass(RESEARCH_IN_PROG);
		    				$("#researchButton" + researchId).hide();
					    	$("#research" + researchId).children(".costContainer").hide();
					    	$("#research" + researchId).children(".researchPending").removeClass("hidden");
		    				//update metal and energy totals
		    				window.currentUser.metal = data.user.metal;
		    				window.currentUser.energy = data.user.energy;
		    				updateResources();
		    			}
		    		});
	    		} else {
	    			$("#researchError").show();
	    		}
		    }

		    window.beginResearch = beginResearch;

		    

		    updateUser();
		});
	</script>
@stop