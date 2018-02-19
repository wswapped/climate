<!DOCTYPE html>
<html lang="en">
<?php
    include_once('db.php');
    include_once('function.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="aqvert team">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>AquaVert</title>
    <!-- Bootstrap Core CSS -->
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="../assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <p class="logoname">AquaVert</p>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                    	<li id="head-title">Systems Map</li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="javascript:void()" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../assets/images/users/1.jpg" alt="user" class="profile-pic m-r-10" />H Placide</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar sep">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <div class="sys-title">
                        <h2>Our Systems</h2>
                    </div>
                    <ul id="sidebarnav">
                    <?php
                        $Systems = get_systems();
                        $syslocation = "";

                        foreach ($Systems as $value) {
                        	$sysname = "HYDRO".$value['id'];
                        	$syslocation .= "{point:{".$value['location']."}, title:'$sysname', locationName:'".$value['locationName']."'},";
                           ?>
                                <li><a class="waves-effect waves-dark litem sys-elem sys<?php echo $value['id']; ?>" href="#" aria-expanded="false" data-marker = "<?php echo "$sysname,'$value[locationName]"  ?>"><span><img class="img-responsive indic-item" src="../assets/images/hydro-icon.png"></span> <span><?php echo $sysname; ?></span> <span class="sys-status">&nbsp;</span></a>
                                </li>
                           <?php
                        }
                    ?>
                        
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <div class="sidebar-footer">
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
                <!-- item--><a href="" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
            <!-- End Bottom points-->
        </aside>
        <div class="page">
        	<div class="page-wrapper">
        		<div class="container-fluid">
	                <div class="row">
	                    <div class="col-sm-12">
                            <!-- <h1>Systems Map</h1> -->
                            <div id="map"></div>
                        </div>
                        <div class="col-sm-12">
                            <!-- <h1>Systems Map</h1> -->
                            <div id="sysdet" style="display: none;">
                                <div class="clink">
                                    <ul>
                                        <li class="men-nav"><i class="mdi mdi-backspace"></i> Back</li>
                                        <li id="sysname"></li>
                                    </ul>
                                </div>
                                <div class="stats-data">
                                    <div id="stats"></div>
                                </div>
                                <div class="action-menu">
                                    <ul>
                                        <li><a href="https://thingspeak.com/channels/428882" target="_blank" class="btn btn-primary" id="openPipe">Moisture</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
	                </div>
	            </div>
        	</div>            
            <footer class="footer"> © 2017 AquaVert</footer>
        </div>
        <div>
            
        </div>
    </div>


    	<!-- Modal -->
    	<div>
			<!-- Modal -->
			<div class="modal fade" id="mapDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <h5 class="modal-title" id="exampleModalLabel" data-type='title'>OK</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        ...
			      </div>
			    </div>
			  </div>
			</div>

    	</div>

        <!-- Statistics -->
        <div>
            <div class="stats">

             </div>
        </div>



    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script>
    	var map;
    	var markers=[];

    	function initMap() {
	        var map = new google.maps.Map(document.getElementById('map'), {
	          center: {lat: -1.9688044, lng: 30.0919184},
	          zoom:15
	        });
	        bounds  = new google.maps.LatLngBounds();
	        var locations = [<?php echo "$syslocation"; ?>];
	        for(var i = 0; i < locations.length; i++) 
	        {
	        	var position = locations[i].point;
	        	var title = locations[i].title;

	        	var optdata = {};
	        	optdata = {'name':title, 'locationName': locations[i].locationName};

		        var marker = new google.maps.Marker({
		        	position : position,
		        	map : map,
		        	title : title,
		        	data: optdata
		        });

		        

		        //Maps autocenter
		        loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
				bounds.extend(loc);


				markers.push(marker);
				var infowindow = new google.maps.InfoWindow();

				marker.addListener('click', function() {
				    mapModal(this);
                    log(this)
	    		});
	    	}

	    	//Fit bounds
	    	map.fitBounds(bounds);       // auto-zoom
			map.panToBounds(bounds);     // auto-center
   		 }
   		var ret = 0;
   		function geocode(data, type='latlng'){
   			//Function to do geocoding and reverse geocoding
   			var url = "https://maps.googleapis.com/maps/api/geocode/json?"+type+"="+data.lat+", "+data.lng+"&key=AIzaSyAaLSH8p67bkCheCNUQ_okZoqJHHuuzY_g";
   			okman = $.get(url, function(data, status){
	        	if(status){
	        		addresses = data.results;
	        		if(addresses.length>0){
	        			ret = addresses[0].formatted_address;
	        			stupid(ret)
	        		}else{
	        			ret = "Error no address found!"
	        		}
	        	}else{
	        		log("Error: ");
	        	}
	        });


	        var temp = setInterval(function(){
	        	data = okman.responseText;   	
		        if(data){		        	
		        	ret = data;
		        	clearInterval(temp);
		        	return ret;
		        }
	        }, 1000);

   		}
   		function Displaymarker(marker, infowindow) {
   		 	if(infowindow.marker != marker) {
   		 		infowindow.marker = marker;
   		 		infowindow.setContent('<i">'+marker.title+"</i>");
   		 		infowindow.open(map, marker);
   		 	}
   		}
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaLSH8p67bkCheCNUQ_okZoqJHHuuzY_g&callback=initMap"
    async defer></script>


    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="../assets/plugins/chartist-js/dist/chartist.min.js"></script>
    <script src="../assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="../assets/plugins/d3/d3.min.js"></script>
    <script src="../assets/plugins/c3-master/c3.min.js"></script>
    <!-- Chart JS -->
    <script src="js/dashboard1.js"></script>
    <script src="js/highcharts.js"></script>
    <!-- Google maps -->
    <script type="text/javascript">
    	function log(data){
    		console.log(data)
    	}
    </script>
<script type="text/javascript">
    Highcharts.setOptions({
        global: {
            useUTC: false
        }
        });

    Highcharts.chart('stats', {
        chart: {
            type: 'spline',
            animation: Highcharts.svg, // don't animate in old IE
            marginRight: 1,
            events: {
                load: function () {
                    // set up the updating of the chart each second
                    var series = this.series[0];

                    setInterval(function () {
                        // Checking new data
                        $.get("../api?action=get_pipe", function(data, status){
                            // var pipe_mode = data['data']['mode'];                            
                            try{
                                data = JSON.parse(data);
                                data = data.data;
                                var pipe_mode = data.mode;
                                log("pipe is: "+pipe_mode)

                                if(pipe_mode == 'open'){
                                    //Generating random data
                                    flow = rand(14, 27);
                                    time = (new Date()).getTime();
                                    log(flow+" "+time)
                                    series.addPoint([time, flow], true, true);
                                }else{

                                }
                            }catch(err){
                                log(err)
                            }
                        })
                        // var x = (new Date()).getTime(), // current time
                        //     y = Math.random();
                        // series.addPoint([x, y], true, true);
                    }, 2000);
                }
            }
        },
        title: {
            text: 'Water flow in system'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150
        },
        yAxis: {
            title: {
                text: 'Value'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + '</b><br/>' +
                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                    Highcharts.numberFormat(this.y, 2);
            }
        },
        legend: {
            enabled: false
        },
        exporting: {
            enabled: false
        },
        series: [{
            name: 'System Life Data',
            data: (function () {
                // generate an array of random data
                var data = [],
                    time = (new Date()).getTime(),
                    i;

                for (i = -19; i <= 0; i += 1) {
                    data.push({
                        x: time + i * 1000,
                        y: Math.random()
                    });
                }
                return data;
            }())
            // data: <?php echo "[".get_data('Temperature')."]"; ?>
            // data: {1,2,3,4}, {32,4,66,4}
        }]
    });
</script>

<script type="text/javascript">
    $(".sys-elem").on('click', function(){
        data = $(this).data('marker');
        str = data.split(",'")
        data = {'data':{'name':str[0], 'locationName':str[1]}};
        mapModal(data);
    });

    $(".men-nav").on("click", function(){
        $("#sysdet").hide('100');
        $("#map").show(200);
    })
</script>

<?php
    function get_data($sensor = 'water'){
        global $conn;
        $query = mysqli_query($conn, "SELECT * FROM data WHERE type= \"$sensor\"");

        $data = "";
        $times = "";
        $data = array("y"=>array(), "x"=>array());        
        while ($temp = mysqli_fetch_assoc($query)) {
            $ok = $temp['value'];
            $time = date("H:i:s", strtotime($temp['time']));

            $data['y'] = array_merge( $data['y'], array($ok));
            $data['x'] = array_merge( $data['x'], array($time));
        }

        // return json_encode($data);

        $data['y'] = "\"".implode("\", \"", $data['y'])."\"";
        $data['x'] = "\"".implode("\", \"", $data['x'])."\"";

        return $data['y'];
    }
?>

</body>
</html>
