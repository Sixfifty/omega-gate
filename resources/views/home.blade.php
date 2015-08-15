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
		  	<div id="resourceError" class='ui-state-error ui-corner-all' hidden>
		    	<p>
		    		<span class="ui-icon ui-icon-alert"></span> 
		    		<strong>Alert:</strong>You cannot afford that resource!
		    	</p>
		    </div>
		    <div id="resourceOrderForm">
			    <h4>Current Resources:</h4>
			    <table>
			    	<tr>
			    		<td></td>
			    		<td>Quantity</td>
			    		<td>Pending</td>
			    		<td>Yield</td>
			    		<td>Cost</td>
			    		<td></td>
			    	</tr>
			    	<tr>
			    		<td>Asteroid</td>
			    		<td><span id="asteroidTotal"></span></td>
			    		<td><span id="asteroidPending"></span></td>
			    		<td><span id="asteroidYield"></span></td>
			    		<td><span id="asteroidCost"></span></td>
			    		<td><input type='button' id="resourceSubmit" onClick="placeResourceOrder(1,0)" value='Buy Asteroid'/></td>
			    	</tr>
			    	<tr id="powerCellFull" hidden>
			    		<td>Power Cell</td>
			    		<td><span id="powercellTotal"></span></td>
			    		<td><span id="powercellPending"></span></td>
			    		<td><span id="powercellYield"></span></td>
			    		<td><span id="powercellCost"></span></td>
			    		<td><input type='button' id="resourceSubmit" onClick="placeResourceOrder(0,1)" value='Buy Power Cell'/></td>
			    	</tr>
			    	<tr id="powerCellLock">
			    		<td>Power Cell</td>
			    		<td colspan="5">
			    			<div class='solarLock'><p><span class='ui-icon ui-icon-locked'></span>You must research Solar Power Station to unlock this feature.</p></div>
			    		</td>
			    	</tr>
			    </table>
			</div>
		  </div>
		  <div id="tabs-2">
		  	<div id="armyError" class='ui-state-error ui-corner-all' hidden>
		    	<p>
		    		<span class="ui-icon ui-icon-alert"></span> 
		    		<strong>Alert:</strong>You cannot afford all entered ships!
		    	</p>
		    </div>
		    <div id="armyOrderForm">
			</div>
		  </div>
		  <div id="tabs-3">
		  	<div id="conquerContainer">
			    <div id='scanContainer'>
			    	<h4>Planetary Scanning</h4>
			    	<div id='scanInner'></div>
			    	<div id='scanResults'></div>
			    </div>
			    <div id="invasionError" class='ui-state-error ui-corner-all' hidden>
			    	<p>
			    		<span class="ui-icon ui-icon-alert"></span> 
			    		<strong>Alert:</strong>You do not own all entered attack ships!
			    	</p>
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

			    	/* Populate Header */
					updateResources();
					$('#userPlanet').html('Planet ' + user.planet_name);
					$('#welcome').html('Greetings, Commander ' + user.username + '!');
			    	if (user.defending_attacks.length > 0) {
			    		var defendingAttacks = user.defending_attacks,
			    			shortestAttack = 8,
			    			attackPlanetCount = 0;

			    		for (var i = 0; i < defendingAttacks.length; i++) {
			    			if (defendingAttacks[i].ticks_remaining > 0) {
				    			if (defendingAttacks[i].ticks_remaining < shortestAttack) {
				    				shortestAttack = defendingAttacks[i].ticks_remaining;
				    			}
				    			attackPlanetCount++;
				    		}
			    		}

			    		if (attackPlanetCount > 0) {
				    		var warningHtml = "<p><span class='ui-icon ui-icon-alert'></span><strong>WARNING:</strong> You are under attack from " + defendingAttacks.length + " planet(s)! Earliest attack will arrive in <strong>" + shortestAttack + " ticks!</strong></p>";
				    		$("#attackWarning").html(warningHtml);
				    		$("#attackWarning").show();
			    		}
			    	}

			    	/* Populate Resources */
			    	if (checkResearch(1)) {
			    		$("#powerCellLock").hide();
			    		$("#powerCellFull").show();
			    	}
			    	updateResourceTable();

			    	/* Populate Army */
			    	updateArmyTable();


					/* Populate Conquer	*/
					var scanHtml,
						invasionHtml,
						defenceHtml,
						defences = user.logs.defence,
						selectHtml = "<table><tr><td>Select Planet:</td><td><select class='selectMenu'>",
						scanResearch = checkResearch(10);
						for (var i = 0; i < data.planets.length; i++) {
							if (data.planets[i].id !== user.id) {
								selectHtml += "<option value=" + data.planets[i].id + ">" + data.planets[i].name + "</option>";
							}
						}
						selectHtml += "</select></td><td class='buttonColumn'></td></table>";

					if(scanResearch) {
						scanHtml = "Scan Accuracy: <span>" + getScanStatus() + "</span><br/>";
						scanHtml += selectHtml;
					} else {
						scanHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>You must research Scanning to unlock this feature.</p></div>";
					}
					$('#scanInner').html(scanHtml);
					if (scanResearch) {
						$('#scanInner').find('.buttonColumn').html("<input type='button' id='scanSubmit' onClick='submitScan()' value='Scan Planet'/>");
					}

					if(checkResearch(14)) {
						if (user.attacks.length > 0) {
							if (user.attacks[0].ticks_remaining > 0) {
							invasionHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>Currently attacking. ETA: " + user.attacks[0].ticks_remaining + " ticks.</p></div>";
							} else {
								invasionHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>Currently returning home. ETA: " + user.attacks[0].home_ticks_remaining + " ticks.</p></div>";
							}
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
						    		invasionHtml += "<td><input type='number' class='invasionOrderField' id='invasionField" + ships[i].id + "' shipid='" + ships[i].id + "' min='0'></td></tr>";
						    	}
					    	}
					    	invasionHtml += "<tr><td colspan=7><input type='button' id='invasionSubmit' onClick='formAttack()' value='Submit'/></td></tr></table></form>";	
					    }
					} else {
						invasionHtml = "<div class='featureLock'><p><span class='ui-icon ui-icon-locked'></span>You must research Warp Travel to unlock this feature.</p></div>";
					}
					$('#invasionInner').html(invasionHtml);
					$('.selectMenu').selectmenu();


					if (defences.length > 0) {
						defenceHtml = "<table><tr><td>Planet</td><td>Invaded on</td></tr>";
						for (var i = 0; i < defences.length; i++) {
							defenceHtml += "<tr><td>" + defences[i].source_name + "</td><td>" + defences[i].created_at + "</td></tr>";
						}
						defenceHtml += "</table>";
					} else {
						defenceHtml = "No attacks have occured on your planet.";
					}

					$("#defenceInner").html(defenceHtml);

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

		    function updateResourceTable() {
		    	$('#asteroidTotal').html(window.currentUser.asteroids);
		    	$('#powercellTotal').html(window.currentUser.power_cells);
		    	$('#asteroidPending').html(window.currentUser.asteroids_pending);
		    	$('#powercellPending').html(window.currentUser.power_cells_pending);
		    	$('#asteroidYield').html(window.currentUser.metal_yield + "[M] per tick");
		    	$('#powercellYield').html(window.currentUser.energy_yield + "[E] per tick");
		    	$('#asteroidCost').html(window.currentUser.asteroid_cost + "[M]");
		    	$('#powercellCost').html(window.currentUser.power_cell_cost + "[M]");
		    }

		    function updateArmyTable() {
		    	var prerequisiteId,
		    		state,
		    		ships = window.currentUser.ships,
		    		research = window.currentUser.research;

		    	var armyTable = "<h4>Army Status</h4><form><table><tr><td>Unit</td><td>Quantity</td><td>Pending</td><td>Cost</td><td>Order</td><td>Total</td></tr>";
		    	for(var i = 0; i < ships.length; i++) {
		    		prerequisiteId = ships[i].prerequisite_id;
		    		state = (prerequisiteId !== null) ? research[prerequisiteId - 1].state : 1;

		    		if (state === 1) {
			    		armyTable += "<tr><td>" + ships[i].name + "</td>";
			    		armyTable += "<td>" + ships[i].quantity + "</td>";
			    		armyTable += "<td>" + ships[i].quantity_pending + "</td>";
			    		armyTable += "<td>" + ships[i].metal_cost + "[M] / " + ships[i].energy_cost + "[E]</td>";
			    		armyTable += "<td><input type='number' class='armyOrderField' id='armyField" + ships[i].id + "' shipid='" + ships[i].id + "' metal='" + ships[i].metal_cost + "' energy='" + ships[i].energy_cost + "' min='0'></td>";
			    		armyTable += "<td><span class='armyMetalTotal' id='armyMetalTotal" + ships[i].id + "'>0</span>[M] / <span class='armyEnergyTotal' id='armyEnergyTotal" + ships[i].id + "'>0</span>[E]</td></tr>";
			    	}
		    	}
		    	armyTable += "<tr></tr><tr><td colspan=4></td><td>Grand Total:</td><td><span id='armyMetalGrandTotal'></span>[M] / <span  id='armyEnergyGrandTotal'></span>[E]</td></tr><tr><td colspan=6><input type='button' id='armySubmit' onClick='placeArmyOrder()' value='Submit'/></td></tr></table></form>";
		    	$('#armyOrderForm').html(armyTable);
		    	updateArmyGrandTotal();
		    	$('.armyOrderField').each(function(){
		    		$(this).on('input', function() {
		    			var metal = $(this).attr('metal') * $(this).val(),
		    				energy = $(this).attr('energy') * $(this).val();

		    			$("#armyMetalTotal" + $(this).attr('shipId')).html(metal);
		    			$("#armyEnergyTotal" + $(this).attr('shipId')).html(energy);
		    			updateArmyGrandTotal();
		    		});
		    	});
		    }

		    function getScanStatus() {
		    	var result;

		    	if (checkResearch(11)) {
		    		result = "Exact unit numbers, ";
		    	} else {
		    		result = "Rough unit estimates, ";
		    	}

		    	if (checkResearch(13)) {
		    		result += "exact stealthed unit numbers.";
		    	} else if (checkResearch(12)) {
		    		result += "rough stealthed unit estimates.";
		    	} else {
		    		result += "no stealth unit detection.";
		    	}
		    	return result;
		    }

		    function updateScanResults(data) {
		    	var scanHtml,
		    		army = data.targetArmy;
				$("#scanResults").empty();

				scanHtml = "<span>Scan results of <strong>Planet " + data.targetName + ":</strong><span>";

				if (army.length > 0) {
					scanHtml += "<table><tr><td>Unit</td><td>Quantity</td></tr>";
					for(var i = 0; i < army.length; i++) {
						scanHtml += "<tr><td>" + army[i].name + "</td>";
						scanHtml += "<td>" + army[i].quantity + "</td></tr>";
					}
					scanHtml += "</table>";
				} else {
					scanHtml += "<span> This planet has no army!</span>";
				}

		    	$("#scanResults").html(scanHtml);
		    }

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

		    function placeResourceOrder(asteroid, powercell) {
		    	$("#resourceError").hide();

		    	var affordable = false;
		    	if (asteroid && window.currentUser.metal >= window.currentUser.asteroid_cost) {
		    		affordable = true;
		    	} else if (powercell && window.currentUser.metal >= window.currentUser.power_cell_cost) {
		    		affordable = true;
		    	}

		    	if (affordable) {
		    		$.ajax({
		    			method: "POST",
		    			url: '/api/user/resource/order',
		    			headers: {
		    				'X-CSRF-TOKEN': $('#token').attr('value')
		    			},
		    			data: {
		    				asteroids: asteroid,
		    				powercells: powercell
		    			},
		    			success: function(data) {
		    				window.currentUser = data.user;
		    				updateResources();
		    				updateResourceTable();
		    			}
		    		});
		    	} else {
		    		$("#resourceError").show();
		    	}
		    }
		    window.placeResourceOrder = placeResourceOrder;

		    function updateArmyGrandTotal() {
		    	var metal = 0,
		    		energy = 0;

		    	$(".armyMetalTotal").each(function(){
		    		metal += parseInt($(this).html());
		    	});
		    	$(".armyEnergyTotal").each(function(){
		    		energy += parseInt($(this).html());
		    	});
		    	$("#armyMetalGrandTotal").html(metal);
		    	$("#armyEnergyGrandTotal").html(energy);
		    }

		    function placeArmyOrder() {
		    	var orders = [],
		    		shipId,
		    		quantity;

		    	$("#armyError").hide();
		    	if (window.currentUser.metal >= $("#armyMetalGrandTotal").html() && window.currentUser.energy >= $("#armyEnergyGrandTotal").html()) {
			    	//For each input field in the orders table
			    	$('#armyOrderForm').find('.armyOrderField').each(function () {
			    		shipId = $(this).attr('shipid');
			    		quantity = $(this).val();

			    		if (quantity > 0) {
			    			orders.push({
			    				ship_id: shipId,
			    				quantity: quantity,
			    			});
			    		}
			    	});

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
			    				window.currentUser = data.user;
			    				$('#armyOrderForm').empty();
			    				updateResources();
			    				updateArmyTable();

			    			}
			    		});
				    }
				} else {
					$("#armyError").show();
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

		    function submitScan() {
		    	var targetId = $("#scanInner").find(".selectMenu").val();

		    	$.ajax({
	    			method: "POST",
	    			url: '/api/user/scan',
	    			headers: {
	    				'X-CSRF-TOKEN': $('#token').attr('value')
	    			},
	    			data: {
	    				target_id: targetId
	    			},
	    			success: function(data) {
	    				updateScanResults(data);
	    			}
	    		});
		    }
		    window.submitScan = submitScan;

		    function formAttack() {
		    	var shipsList = [],
		    		targetId,
		    		attack,
		    		currentQuantity,
		    		armyCheck = true;

		    	$("#invasionError").hide();

		    	//For each input field in the attack table
		    	$('#invasionInner').find('.invasionOrderField').each(function () {
		    		shipId = $(this).attr('shipid');
		    		quantity = $(this).val();
		    		currentQuantity = $(this).parent().prev().html();

		    		if(quantity !== "" && parseInt(quantity) > parseInt(currentQuantity)) {
		    			armyCheck = false;
		    		}

		    		if (quantity > 0) {
		    			shipsList.push({
		    				ship_id: shipId,
		    				quantity: quantity,
		    			});
		    		}
		    	});

		    	if (shipsList.length > 0) {
		    		if (armyCheck) {
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
									window.currentUser = data.user;
			    					updateArmyTable();
			    				}
			    			}
			    		});
					} else {
						$("#invasionError").show();
					}
		    	}
		    }
		    window.formAttack = formAttack;

		    updateUser();
		});
	</script>
@stop