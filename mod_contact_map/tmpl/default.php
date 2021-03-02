<?php

jimport( 'joomla.environment.request' );
// no direct access
defined( '_JEXEC' ) or die();
require_once ( JPATH_ROOT . "/components/com_content/helpers/route.php" );

$lang = JFactory::getLanguage();
$tag = $lang->getTag();
?>


<!--Виводим блок карти з контактами-->
<div class="b-popup_load" id="popup_load">
	<div id="floatingCirclesG">
		<div class="f_circleG" id="frotateG_01"></div>
		<div class="f_circleG" id="frotateG_02"></div>
		<div class="f_circleG" id="frotateG_03"></div>
		<div class="f_circleG" id="frotateG_04"></div>
		<div class="f_circleG" id="frotateG_05"></div>
		<div class="f_circleG" id="frotateG_06"></div>
		<div class="f_circleG" id="frotateG_07"></div>
		<div class="f_circleG" id="frotateG_08"></div>
	</div>
</div>

<div id="map_container">
	<div id="map"></div>
	<div class="container">
		<div class="row">
			<div class="wrap">
				<div id="contacts">
					<h3><?php echo JText::_('MOD_CONTACT_MAP_CONTACTS'); ?></h3>
					<h5><?php echo JText::_('MOD_CONTACT_MAP_WAIT'); ?></h5>
					<p class="street"><?php echo $street.' '.$house; ?></p>
					<?php if ($town != '') $adres = $town; ?>
					<?php if ($region != '') $adres .= ','.$region; ?>
					<?php if ($index != '') $adres .= ','.$index; ?>
					<p class="city"><?php echo $adres; ?></p>
					<?php if ($link1 != '' && ($phone1 != '' || $phone2 != '')) echo '<p class="contact">' . $link1 . ':</p>'; ?>
					<?php if ($phone1 != '') : ?>
						<p class="phone1"><?php echo $phone1; ?></p>
					<?php endif; ?>
					<?php if ($phone2 != '') : ?>
						<p class="phone2"><?php echo $phone2; ?></p>
					<?php endif; ?>
					<?php if ($link2 != '' && ($phone3 != '' || $phone4 != '' || $phone5 != '')) echo '<p class="contact">' . $link2 . ':</p>'; ?>
					<?php if ($phone3 != '') : ?>
						<p class="phone3"><?php echo $phone3; ?></p>
					<?php endif; ?>
					<?php if ($phone4 != '') : ?>
						<p class="phone4"><?php echo $phone4; ?></p>
					<?php endif; ?>
					<?php if ($phone5 != '') : ?>
						<p class="phone5"><?php echo $phone5; ?></p>
					<?php endif; ?>
					<p class="email"><?php echo $email; ?></p>
					<button id="button_callback" class="button_callback"><?php echo JText::_('MOD_CONTACT_MAP_WRITE'); ?></button>
				</div>
				<div id="callback">
					<div class="callback_form">
						<h3><?php echo JText::_('MOD_CONTACT_MAP_FORM'); ?></h3>
						<h5><?php echo JText::_('MOD_CONTACT_MAP_BACK'); ?></h5>
						<form id="callback_form" class="pop_form">
							<input type="hidden" name="repicient" value="<?php echo $email; ?>" />
							<input type="hidden" name="sitename" value="<?php echo $host; ?>" />
							<input type="text" class="text validation noempty" name="name" placeholder="<?php echo JText::_('MOD_CONTACT_MAP_NAME');
							?>" required />
							<input type="email" class="text validation noempty email" name="email" placeholder="E-mail" required />
							<input type="text" class="file validation noempty" name="message" placeholder="<?php echo JText::_('MOD_CONTACT_MAP_MESSAGE'); ?>" required /><br>
							<button class="button_send" type="submit"><?php echo JText::_('MOD_CONTACT_MAP_SEND');
								?></button>
						</form>
					</div>
					<div id="callback_message">
						<h3><?php echo JText::_('MOD_CONTACT_MAP_THENK'); ?></h3>
						<h5><?php echo JText::_('MOD_CONTACT_MAP_FORMAIL'); ?></h5>
						<button class="return" type="submit"><?php echo JText::_('MOD_CONTACT_MAP_RETURN'); ?></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>


    var geocoder;
    var map;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        //Если введенные координаты, то ставим маркер за координатами
		<?php if ($lat != '' && $lng != '') :?>
        var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
        var latlng = new google.maps.LatLng(<?php echo $lat-0.009; ?>, <?php echo $lng+0.01; ?>);
		<?php else : ?>
        var latlng = new google.maps.LatLng(50.340425,30.940393);
		<?php endif;?>
        var mapOptions = {
            zoom: 14,
            center: latlng,
            styles : [
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
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var marker = new google.maps.Marker({
			<?php if ($lat != '' && $lng != '') :?>
			<?php echo 'position: uluru,';?>
			<?php endif;?>
            map: map,
            icon: '/images/maker_pink.png',
        });
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
        google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        codeAddress();
    }

    function codeAddress() {
        //Получаем координаты для маркера за адресом
		<?php $address = $street.' '.$house.' '.$town.' '.$region;?>
        var address = "<?php echo $address; ?>";
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == 'OK') {
				<?php if ($lat != '' && $lng != '') :?>
                var center = map.getCenter();
                map.setCenter(center);
                var uluru = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};
				<?php else : ?>
                map.setCenter(results[0].geometry.location);
                var centr = map.getCenter();
                var latn = centr.lat() - 0.009;
                var long = centr.lng() + 0.01;
                var latlng = new google.maps.LatLng(latn,long);
                var mapOptions = {
                    zoom: 14,
                    center: latlng
                }
                map = new google.maps.Map(document.getElementById('map'), mapOptions);
				<?php endif;?>
                var marker = new google.maps.Marker({
                    map: map,
					<?php if ($lat == '' && $lng == '') :?>
					<?php echo 'position: results[0].geometry.location,';?>
					<?php else :?>
					<?php echo 'position: uluru,';?>
					<?php endif;?>
                    icon: '/images/maker_pink.png',
                });
            } else {
                alert('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $APIkey; ?>&callback=initialize&language=<?php echo substr($tag, 0, 2); ?>" async
        defer></script>