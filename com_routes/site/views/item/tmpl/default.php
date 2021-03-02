<?php

defined('_JEXEC') or exit();

$pink = $this->item->backgound_color;
//Передадим параметр включения розового фона
JFactory::getApplication()->setUserState( 'com_routes.view.backgound_color', $pink );

//Получаем меню
$menu =& JSite::getMenu();
$menutype = $menu->getActive()->menutype;
$titlePage = $menu->getActive()->title;
$menu_items = $menu->getItems('menutype',$menutype);

$lang = JFactory::getLanguage();
$tag = $lang->getTag();

$db = &JFactory::getDBO();
$query = $db->getQuery(true);
$query->select('`id`, `title`, `start_point_name`, `finish_point_name`');
$query->from('#__routes');
$query->where($db->quoteName('published'). '=' . $db->quote('1'),'AND')
	->where($db->quoteName('language'). '=' . $db->quote($tag));
$db->setQuery($query);
$list = $db->loadObjectList();

$lang = JFactory::getLanguage();
$tag = $lang->getTag();

?>

<!--Выведем блок навигации по маршрутах-->
<div class="routes_info">
    <div class="container">
        <div class="col-md-12">
            <div class="content-text">
                <div class="row">
                    <div class="col-md-6">
                        <div class="our_routes">
                            <div class="icon_our_routes">
                            </div>
                            <p><?php echo $this->item->title;?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!--<ul class="nav_routes slider multiple-items">-->
						<ul class="nav_routes slider">

							<?php foreach ($list as $route) : ?>
								<?php foreach ($menu_items as $item_menu) : ?>
									<?php if (trim($route->title) == trim($item_menu->title)) : ?>
                                        <li class="route_item" style="width: 
													<?php if (strlen(preg_replace('~[^0-9]+~','',trim($route->title))) == 1) : ?>
														<?php echo '20px'; ?>			  
													<?php elseif (strlen(preg_replace('~[^0-9]+~','',trim($route->title))) == 2) : ?>
														<?php echo '30px'; ?>			  
													<?php elseif (strlen(preg_replace('~[^0-9]+~','',trim($route->title))) == 3) : ?>
														<?php echo '40px'; ?>			  
													<?php elseif (strlen(preg_replace('~[^0-9]+~','',trim($route->title))) == 4) : ?>
														<?php echo '50px'; ?>			  
													<?php else : ?>
														<?php echo '60px'; ?>			  
													<?php endif; ?>
	"><a href="<?php echo JRoute::_("index.php?Itemid=".
												$item_menu->id); ?>" class="button transition"><?php echo preg_replace('~[^0-9]+~','',trim($route->title)); ?></a>
                                            <ul class="route_desc" >
                                                <li><?php echo $route->start_point_name;?><br><?php echo
													$route->finish_point_name;?></li>
                                            </ul>
                                        </li>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endforeach; ?>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Маршрут и карта маршрута-->
<div class="rout">
	<?php if ($pink) : ?>
    <div class="abt_rout" style="background-image: url(/images/route_01.jpg);">
		<?php else : ?>
        <div class="abt_rout" style="background-image: url(/images/route_01_blue.jpg);">
			<?php endif; ?>
            <div class="route">
                <div class="title">
                    <h3><?php echo explode(" ", $this->item->title)[0] . "<br />" . substr($this->item->title, strlen(explode(" ", $this->item->title)[0])+1);?></h3>
                    <h5><?php echo $this->item->start_point_name;?><br><?php echo $this->item->finish_point_name;?></h5>
                </div>
                <div class="route_icons">
                    <div class="interval">
                        <div class="interval_icon">
                        </div>
                        <p><?php echo $this->item->interval; ?></p>
                    </div>
                    <div class="date">
                        <div class="date_icon">
                        </div>
                        <p><?php echo $this->item->days; ?></p>
                    </div>
                    <div class="daily">
                        <div class="daily_icon">
                        </div>
                        <p><?php echo $this->item->time; ?></p>
                    </div>
                </div>
                <p><?php if ($this->item->description) : ?>
						<?php echo $this->item->description; ?>
					<?php else : ?>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio enim expedita illum mollitia neque porro praesentium, reiciendis reprehenderit, sed tempora temporibus, vel vitae voluptate. Dicta eveniet nisi quasi qui repudiandae.
					<?php endif; ?>
                </p>
            </div>
            <div class="buttns rout">
				<?php if ($this->item->but_tickets) : ?>
                    <a href="http://busfor.ua" target="_blank" class="button tickets"><?php echo JText::_('COM_ROUTES_BUTTICKETS'); ?></a>
				<?php endif; ?>
				<?php if ($this->item->but_memorandum) :?>
                    <a href="#" class="button memorandum show_popup fancybox" rel="memor"><?php echo JText::_('COM_ROUTES_BUTMEMORANDUM'); ?></a>
				<?php endif; ?>
            </div>
            <div class="popup memor">
                <a class="close" href="#">Close</a>
                <div class="text_memor">
                    <p>
						<?php echo $this->item->memorandum_desc; ?>
                    </p>
                </div>
            </div>

        </div>
        <div id="map_routes_container">
            <div id="map_routes"></div>
        </div>
    </div>
	<?php
	$start_point = explode(',', $this->item->start_point);
	$lats = trim($start_point[0]);
	$lngs = trim($start_point[1]);

	$finish_point = explode(',', $this->item->finish_point);
	$latf = trim($finish_point[0]);
	$lngf = trim($finish_point[1]);

	?>
    <script>
        var markers = [
            {
                "lat": '<?php echo $lats; ?>',
                "lng": '<?php echo $lngs; ?>'
            },
			<?php if ($this->item->intermediate_point1) : ?>
			<?php $int1 = explode(',', $this->item->intermediate_point1); ?>
            {
                "lat": '<?php echo trim($int1[0]); ?>',
                "lng": '<?php echo trim($int1[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point2) : ?>
			<?php $int2 = explode(',', $this->item->intermediate_point2); ?>
            {
                "lat": '<?php echo trim($int2[0]); ?>',
                "lng": '<?php echo trim($int2[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point3) : ?>
			<?php $int3 = explode(',', $this->item->intermediate_point3); ?>
            {
                "lat": '<?php echo trim($int3[0]); ?>',
                "lng": '<?php echo trim($int3[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point4) : ?>
			<?php $int4 = explode(',', $this->item->intermediate_point4); ?>
            {
                "lat": '<?php echo trim($int4[0]); ?>',
                "lng": '<?php echo trim($int4[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point5) : ?>
			<?php $int5 = explode(',', $this->item->intermediate_point5); ?>
            {
                "lat": '<?php echo trim($int5[0]); ?>',
                "lng": '<?php echo trim($int5[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point6) : ?>
			<?php $int6 = explode(',', $this->item->intermediate_point6); ?>
            {
                "lat": '<?php echo trim($int6[0]); ?>',
                "lng": '<?php echo trim($int6[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point7) : ?>
			<?php $int7 = explode(',', $this->item->intermediate_point7); ?>
            {
                "lat": '<?php echo trim($int7[0]); ?>',
                "lng": '<?php echo trim($int7[1]); ?>'
            },
			<?php endif; ?>
			<?php if ($this->item->intermediate_point8) : ?>
			<?php $int8 = explode(',', $this->item->intermediate_point8); ?>
            {
                "lat": '<?php echo trim($int8[0]); ?>',
                "lng": '<?php echo trim($int8[1]); ?>'
            },
			<?php endif; ?>
            {
                "lat": '<?php echo $latf; ?>',
                "lng": '<?php echo $lngf; ?>'
            }
        ];

        function animatePath(map, route, marker, pathCoords) {
            var index = 0;
            route.setPath([]);
            for (var index = 0; index < pathCoords.length; index++)
                setTimeout(function(offset) {
                    route.getPath().push(pathCoords.getAt(offset));
                    marker.setPosition(pathCoords.getAt(offset));
                }, index * <?php echo $speed = 100 - (int)$this->item->speed; ?> , index);
        }

        function initialize() {

            var mapOptions = {
                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
                zoom: 20,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "all",
                        "stylers": [
                            {
                                "hue": "#008eff"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": "0"
                            },
                            {
                                "lightness": "0"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            },
                            {
                                "saturation": "-60"
                            },
                            {
                                "lightness": "-20"
                            }
                        ]
                    }
                ]
            };

            var map = new google.maps.Map(document.getElementById("map_routes"), mapOptions);

            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            for (i = 0; i < markers.length; i++) {
                var data = markers[i];
                markers[i].latLng = new google.maps.LatLng(data.lat, data.lng);

                if (i == 0) {

                    var marker = new google.maps.Marker({
                        position: markers[i].latLng,
                        map: map,
						<?php if ($pink) : ?>
                        icon: '/images/maker_pink.png',
						<?php else : ?>
                        icon: '/images/maker_blue.png',
						<?php endif; ?>
                    });
                }else {
                    var marker = new google.maps.Marker({
                        position: markers[i].latLng,
                        map: map,
                        icon: '/images/maker_blue1.png',
                    });
                }

                marker.description = markers[i].description;
                latlngbounds.extend(marker.position);
                google.maps.event.addListener(marker, "click", function(e) {
                    infoWindow.setContent(this.description);
                    infoWindow.open(map, this);
                });
            }
            map.setCenter(latlngbounds.getCenter());
            map.fitBounds(latlngbounds);

            google.maps.event.addDomListener(window, "resize", function() {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
            });

            //Initialize the Path Array
            var path = new google.maps.MVCArray();

            //Initialize the Direction Service
            var service = new google.maps.DirectionsService();

            // Get the route between the points on the map
            var wayPoints = [];
            for (var i = 1; i < markers.length - 1; i++) {
                wayPoints.push({
                    location: markers[i].latLng,
                    stopover: false
                });
            }


            // Initialize the path
            var poly = new google.maps.Polyline({
                map: map,
				<?php if ($pink) :?>
                strokeColor: "#c16591",
				<?php else : ?>
                strokeColor: "#413e64",
				<?php endif; ?>
                strokeOpacity: 0.5,
                strokeWeight: 6
            });
            var traceMarker = new google.maps.Marker({
                map: map,
				<?php if ($pink) : ?>
                icon: '/images/maker_pink.png',
				<?php else : ?>
                icon: '/images/maker_blue.png',
				<?php endif; ?>
            });

            if (markers.length >= 2) {
                service.route({
                    origin: markers[0].latLng,
                    destination: markers[markers.length - 1].latLng,
                    waypoints: wayPoints,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                }, function(result, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        for (var j = 0, len = result.routes[0].overview_path.length; j < len; j++) {
                            path.push(result.routes[0].overview_path[j]);
                        }
                        animatePath(map, poly, traceMarker, path);
                    }
                });
            }


        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->item->apikey;
    ?>&callback=initialize&language=<?php echo substr($tag, 0, 2); ?>"
            async defer></script>
</div>

	<?php if ($this->item->published_table) : ?>
    <div class="container-fluid">
        <div class="time_table">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
	                    <?php if (!empty($this->item->timetable)) : ?>
                            <div class="timetable">
                                <table class="table">
				                    <?php $val = json_decode($this->item->timetable); ?>
				                    <?php $i = 1; ?>

				                    <?php foreach ($val as $key => $value) : ?>
										<?php if($i == 1) $first = $value; ?>
					                    <?php if ($value != '') : ?>
						                    <?php if ($i%5 == 1) :?>
                                                <tr>
						                    <?php endif; ?>
                                            <td><?php echo $value; ?></td>
					                    <?php endif; ?>
					                    <?php if ($i%5 == 0) : ?>
                                            </tr>
					                    <?php endif; ?>

					                    <?php $i++; ?>
				                    <?php endforeach; ?>
                                </table>
			                    <?php if ($this->item->note) : ?>
									<?php if ($first != '') : ?>
                                    	<p><?php echo $this->item->note; ?></p>
									<?php else : ?>
										<p style="margin-top: -20px; font-size: 12px;"><?php echo $this->item->note; ?></p>
									<?php endif; ?>
			                    <?php endif; ?>
                            </div>
	                    <?php endif; ?>
                        <style>
                            .timetable tr:last-child td {
                            <?php if ($pink) : ?>
                                border-bottom: 2px solid #f081a8;
                            <?php else : ?>
                                border-bottom: 2px solid #8bc4f2;
                            <?php endif; ?>
                            }
                        </style>
                    </div>
                    <div class="col-md-5">
                        <div class="tram_schedule">
							<?php if ($this->item->phone_dispatcher1) : ?>
                            <h3><?php echo JText::_('COM_ROUTES_DISPATCHER'); ?></h3>
							<?php endif; ?>
                            <p>
								<?php if ($this->item->phone_dispatcher1) : ?>
									<?php echo $this->item->phone_dispatcher1; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher2) : ?>
									<?php echo $this->item->phone_dispatcher2; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher3) : ?>
									<?php echo $this->item->phone_dispatcher3; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher4) : ?>
									<?php echo $this->item->phone_dispatcher4; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher5) : ?>
									<?php echo $this->item->phone_dispatcher5; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher6) : ?>
									<?php echo $this->item->phone_dispatcher6; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher7) : ?>
									<?php echo $this->item->phone_dispatcher7; ?>
                                    <br>
								<?php endif; ?>
								<?php if ($this->item->phone_dispatcher8) : ?>
									<?php echo $this->item->phone_dispatcher8; ?>
                                    <br>
								<?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

	<?php if ($this->item->published_img) : ?>
    <div class="main_routes">
        <div class="container">
            <div class="col-md-12">
				<?php $img_start = json_decode($this->item->img_start); ?>
				<?php if ($img_start->image_start != '') : ?>
			<?php if ($pink) : ?>
                <div class="aeroport" style="border-top: 20px solid #c16591;">
					<?php else : ?>
                    <div class="aeroport" style="border-top: 20px solid #8bc4f2;">
						<?php endif; ?>
						<?php if ($img_start->image_start != '') :?>
                            <div class="aeroport_img" style="background-image: url('/<?php echo $img_start->image_start;?>')"></div>
						<?php endif; ?>
						<?php if ($this->item->img_start_title != '') : ?>
                            <h3><?php echo $this->item->img_start_title; ?></h3>
						<?php endif; ?>
						<?php if ($this->item->img_start_desc != '') :?>
                            <p>
								<?php echo $this->item->img_start_desc; ?>
                            </p>
						<?php endif; ?>
                    </div>
					<?php endif; ?>

					<?php $img_finish = json_decode($this->item->img_finish); ?>
					<?php if ($img_finish->image_finish != '') : ?>
					<?php if ($pink) : ?>
                    <div class="vokzal" style="border-top: 20px solid #c16591;">
						<?php else : ?>
                        <div class="vokzal" style="border-top: 20px solid #8bc4f2;">
							<?php endif; ?>
							<?php if (!empty($this->item->img_finish)) :?>
                                <div class="vokzal_img" style="background-image: url('/<?php echo $img_finish->image_finish;?>')"></div>
							<?php endif; ?>
							<?php if ($this->item->img_finish_title != '') : ?>
                                <h3><?php echo $this->item->img_finish_title; ?></h3>
							<?php endif; ?>
							<?php if ($this->item->img_finish_desc != '') :?>
                                <p>
									<?php echo $this->item->img_finish_desc; ?>
                                </p>
							<?php endif; ?>
                        </div>
						<?php endif; ?>

						<?php $img_route = json_decode($this->item->img_route); ?>
						<?php if ($img_route->image_route != '') : ?>
						<?php if ($pink) : ?>
                        <div class="marshrut" style="border-top: 20px solid #c16591;">
							<?php else : ?>
                            <div class="marshrut" style="border-top: 20px solid #8bc4f2;">
								<?php endif; ?>
								<?php if (!empty($this->item->img_route)) :?>
                                    <div class="marshrut_img" style="background-image: url('/<?php echo $img_route->image_route; ?>')"></div>
								<?php endif; ?>
								<?php if ($this->item->img_route_title != '') : ?>
                                    <h3><?php echo $this->item->img_route_title; ?></h3>
								<?php endif; ?>
								<?php if ($this->item->img_route_desc != '') :?>
                                    <p>
										<?php echo $this->item->img_route_desc; ?>
                                    </p>
								<?php endif; ?>
                            </div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
				<?php endif; ?>

				<?php if ($this->item->published_slider) : ?>
                    <?php if (!empty($this->item->buses)) : ?>
                        <?php $buses = json_decode($this->item->buses); ?>
                        <?php if (count((array)$buses) > 1) : ?>
                    <div class="container-fluid">
                        <div class="rout_slider">
                            <div class="container">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="sider_container">
                                            <h3><?php echo JText::_('COM_ROUTES_BUS_ROUTE'); ?></h3>
                                            <div class="next_button"></div>
                                            <div class="prev_button"></div>
                                            <div class="carousel">
	                                            <?php foreach ($buses as $key => $value) : ?>
                                                <?php
                                                $db = JFactory::getDbo();
                                                $query = $db->getQuery(true);
                                                $id = htmlspecialchars( $this->value, ENT_COMPAT, 'UTF-8' );
                                                //'SELECT `id`, `title`, `alias`, `published`'
                                                $query->select('`id`, `brand`, `model`, `images`');
                                                //FROM #__routes
                                                $query->from('#__buses');
                                                $query->where('id='.(int)$value);
                                                $db->setQuery($query);
                                                $listBuses = $db->loadObjectList();
                                                ?>
                                                    <?php $bus_number = 1; ?>
													<?php foreach ($listBuses as $bus) : ?>
														<?php $img = json_decode($bus->images); ?>
                                                        <div class="slide_item" style="background-image: url(/<?php echo $img->image1; ?>);
                                                                background-size: cover;background-repeat: no-repeat;background-position: center center;">
                                                            <p><?php echo $bus->brand; ?><br><?php echo $bus->model; ?><br><br>
	                                                            <?php foreach ($menu_items as $menus_item) : ?>
	                                                                <?php if (trim($menus_item->title) == JText::_('COM_ROUTES_BUSES')) : ?>
                                                                        <a href="<?php echo JRoute::_("index.php?Itemid=". $menus_item->id); ?>/#bus<?php echo $bus->id; ?>" class="but_our_buses transition"><?php echo JText::_('COM_ROUTES_MORE'); ?></a>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </p>
                                                        </div>
                                                        <?php $bus_number++; ?>
													<?php endforeach; ?>
												<?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php endif; ?>
                    <?php endif; ?>
				<?php endif; ?>
                <style>
                    .sider_container .slide_item:hover:before {
                        background: rgba(0,0,0,0.5);
                    <?php if ($pink) : ?>
                        border-top: 20px solid #c16591;
                    <?php else : ?>
                        border-top: 20px solid #8bc4f2;
                    <?php endif; ?>
                    }
                </style>

				<?php if ($this->item->published_additionally) : ?>
					<?php if ($this->item->text_additionally) : ?>
                        <div class="container">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="additionally">
                                        <h3><?php echo JText::_('COM_ROUTES_ADDITION'); ?></h3>
                                        <p>
											<?php echo $this->item->text_additionally; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endif; ?>
				<?php endif; ?>