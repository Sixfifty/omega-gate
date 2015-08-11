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
			    			<td colspan=3><input type='button' id="resourceSubmit" onClick="placeResourceOrder()" value='Submit'/></td>
			    	</table>
			    </form>
			</div>
		  </div>
		  <div id="tabs-2">
		    <div id="armyOrderForm">
			</div>
		  </div>
		  <div id="tabs-3">
		  	<div id="conquerContainer">
			    <div id='scanContainer'>
			    	<h4>Planetary Scanning</h4>
			    	<div id='scanInner'></div>
			    </div>
			    <div id='invasionContainer'>
			    	<h4>Invasion</h4>
			    	<div id='invasionInner'></div>
			    </div>

			    <div id='invasionHistoryContainer'>
			    	<h4>Defence Log</h4>
			    	<div id='defenceInner'></div>
			    </div>
			</div>
		  </div>
		  <div id="tabs-4">
		    <p>Start a research to improve resources, add scans and create new types of ships!</p>
		    <div id="researchError" class='ui-state-error ui-corner-all' hidden>
		    	<p>
		    		<span class="ui-icon ui-icon-alert"></span> 
		    		<strong>Alert:</strong>You cannot afford that research!
		    	</p>
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
						<div id="research4" class="researchBox" hidden></div>
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
			    		research = user.research,
			    		ships = user.ships;
			    	window.currentUser = user;

			    	/* Populate Header and Resources */
					updateResources();
					$('#userPlanet').html('Planet ' + user.planet_name);
					$('#welcome').html('Greetings, Commander ' + user.username + '!');
			    	$('#asteroidsTotal').html(user.asteroids);
			    	$('#powerCellsTotal').html(user.power_cells);

			    	if (user.defending_attacks.length > 0) {
			    		var defendingAttacks = user.defending_attacks,
			    			shortestAttack = defendingAttacks[0].ticks_remaining;

			    		for (var i = 0; i < defendingAttacks.length; i++) {
			    			if (defendingAttacks[i].ticks_remaining < shortestAttack) {
			    				shortestAttack = defendingAttacks[i].ticks_remaining;
			    			}
			    		}
			    		var warningHtml = "<p><span class='ui-icon ui-icon-alert'></span><strong>WARNING:</strong> You are under attack from " + defendingAttacks.length + " planet(s)! Earliest attack will arrive in <strong>" + shortestAttack + " ticks!</strong></p>";
			    		$("#attackWarning").html(warningHtml);
			    		$("#attackWarning").show();
			    	}

			    	/* Populate Army */
			    	var prerequisiteId,
			    		state;
			    	var armyTable = "<h4>Army Status</h4><form><table><tr><td>Unit</td><td>Quantity</td><td>Pending</td><td>Cost</td><td>Order</td></tr>";
			    	for(var i = 0; i < ships.length; i++) {
			    		prerequisiteId = ships[i].prerequisite_id;
			    		state = (prerequisiteId !== null) ? research[prerequisiteId - 1].state : 1;

			    		if (state === 1) {
				    		armyTable += "<tr><td>" + ships[i].name + "</td>";
				    		armyTable += "<td>" + ships[i].quantity + "</td>";
				    		armyTable += "<td>" + ships[i].quantity_pending + "</td>";
				    		armyTable += "<td>" + ships[i].metal_cost + "[M] / " + ships[i].energy_cost + "[E]</td>";
				    		armyTable += "<td><input type='number' class='armyOrderField' id='armyField" + ships[i].id + "'' shipid='" + ships[i].id + "'></td></tr>";
				    	}
			    	}
			    	armyTable += "<tr><td colspan=5><input type='button' id='armySubmit' onClick='placeArmyOrder()' value='Submit'/></td></tr></table></form>";

			    	$('#armyOrderForm').html(armyTable);


			    	/****** Update order form!!  ******/
					/*$('#asteroidOrder').on('input', function() {
					    //alert("changed");

					});*/


					/* Populate Conquer	*/
					var scanHtml,
						invasionHtml,
						selectHtml = "<table><tr><td>Select Planet:</td><td><select class='selectMenu'>";
						for (var i = 0; i < data.planets.length; i++) {
							if (data.planets[i].id !== user.id) {
								selectHtml += "<option value=" + data.planets[i].id + ">" + data.planets[i].name + "</option>";
							}
						}
						selectHtml += "</select></td></table>";

					if(checkResearch(10)) {
						scanHtml = selectHtml;
					} else {
						scanHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>You must research Scanning to unlock this feature.</p></div>";
					}
					$('#scanInner').html(scanHtml);

					if(checkResearch(14)) {
						if (user.attacks.length > 0) {
							invasionHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>Currently attacking. ETA: " + user.attacks[0].ticks_remaining + " ticks.</p></div>";
						} else {
							var stealth;
							invasionHtml = selectHtml;
							invasionHtml += "<form><table><tr><td>Unit</td><td>Stealth</td><td>Att</td><td>HP</td><td>Speed</td><td>Quantity</td><td>Send</td></tr>";
							for(var i = 0; i < ships.length; i++) {
					    		if (ships[i].quantity > 0) {
					    			stealth = (ships[i].stealth === "1") ? "Yes" : "No";
						    		invasionHtml += "<tr><td>" + ships[i].name + "</td>";
						    		invasionHtml += "<td>" + stealth + "</td>";
						    		invasionHtml += "<td>" + ships[i].attack + "</td>";
						    		invasionHtml += "<td>" + ships[i].hp + "</td>";
						    		invasionHtml += "<td>" + ships[i].speed + "</td>";
						    		invasionHtml += "<td>" + ships[i].quantity + "</td>";
						    		invasionHtml += "<td><input type='number' class='invasionOrderField' id='invasionField" + ships[i].id + "' shipid='" + ships[i].id + "'></td></tr>";
						    	}
					    	}
					    	invasionHtml += "<tr><td colspan=7><input type='button' id='invasionSubmit' onClick='formAttack()' value='Submit'/></td></tr></table></form>";	
					    }
					} else {
						invasionHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>You must research Warp Travel to unlock this feature.</p></div>";
					}
					$('#invasionInner').html(invasionHtml);

					$('.selectMenu').selectmenu();



			    	/* Populate Research */
			    	var researchClass;

			    	for(var i = 0; i < research.length; i++) {
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

		    function placeResourceOrder() {
		    	var asteroids = $('#asteroidOrder').val(),
		    		powerCells = $('#powerCellOrder').val();
	    		$.ajax({
	    			method: "POST",
	    			url: '/api/user/resource/order',
	    			headers: {
	    				'X-CSRF-TOKEN': $('#token').attr('value')
	    			},
	    			data: {
	    				asteroids: asteroids,
	    				powercells: powerCells
	    			},
	    			success: function(data) {
	    				console.log(data);
	    			}
	    		});
		    }
		    window.placeResourceOrder = placeResourceOrder;

		    function placeArmyOrder() {
		    	var orders = [],
		    		shipId,
		    		quantity;

		    	//For each input field in the orders table
		    	$('#armyOrderForm').find('.armyOrderField').each(function () {
		    		//Strip text from id
		    		shipId = $(this).attr('shipid');
		    		quantity = $(this).val();

		    		console.log(shipId);

		    		if (quantity > 0) {
		    			orders.push({
		    				ship_id: shipId,
		    				quantity: quantity,
		    			});
		    		}
		    	});

		    	console.log(orders);

		    	if (orders.length > 0) {
			    	$.ajax({
		    			method: "POST",
		    			url: '/api/user/army/order',
		    			headers: {
		    				'X-CSRF-TOKEN': $('#token').attr('value')
		    			},
		    			data: {
		    				orders: JSON.stringify(orders)
		    			},
		    			success: function(data) {		    				
		    				console.log(data);
		    			}
		    		});
			    }
		    }
		    window.placeArmyOrder = placeArmyOrder;

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

		    function formAttack() {
		    	var shipsList = [],
		    		targetId,
		    		attack;

		    	//For each input field in the attack table
		    	$('#invasionInner').find('.invasionOrderField').each(function () {
		    		//Strip text from id
		    		shipId = $(this).attr('shipid');
		    		quantity = $(this).val();

		    		if (quantity > 0) {
		    			shipsList.push({
		    				ship_id: shipId,
		    				quantity: quantity,
		    			});
		    		}
		    	});

		    	if (shipsList.length > 0) {
		    		targetId = $("#invasionInner").find(".selectMenu").val();

		    		attack = {
		    			target_id: targetId,
		    			ships: shipsList
		    		}

		    		$.ajax({
		    			method: "POST",
		    			url: '/api/user/attack/create',
		    			headers: {
		    				'X-CSRF-TOKEN': $('#token').attr('value')
		    			},
		    			data: {
		    				attack: JSON.stringify(attack)
		    			},
		    			success: function(data) {
		    				if (data.attack) {
		    					$("#invasionInner").empty();

		    					var progressHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>Currently attacking. ETA: " + data.attack.ticks_remaining + " ticks.</p></div>";
		    					$("#invasionInner").html(progressHtml);
		    				}
		    			}
		    		});
		    	}
		    }
		    window.formAttack = formAttack;

		    
		    function checkResearch(researchId) {
		    	var research = window.currentUser.research,
		    		result = false;

		    	for (var i = 0; i < research.length; i++) {
		    		if(research[i].id === researchId) {
		    			result = (research[i].state === 1) ? true : false;
		    			break;
		    		}
		    	}

		    	return result;
		    }

		    updateUser();
		});
	</script>
@stop