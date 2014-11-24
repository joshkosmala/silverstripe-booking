<?php

class BookingAdmin extends ModelAdmin {
   
  public static $managed_models = array(   //since 2.3.2
      'Booking'
   );
 
  static $url_segment = 'bookings'; // will be linked as /admin/clients
  static $menu_title = 'Bookings';
 
 
 function init() {
 	parent::init();
 	
 	Requirements::javascript('jsparty/jquery/ui/ui.datepicker.js');
 	Requirements::css('jsparty/jquery/themes/default/ui.datepicker.css');
 	Requirements::javascript('jsparty/jquery/plugins/livequery/jquery.livequery.js');
 	Requirements::customScript("jQuery('.date input').livequery(function() { jQuery(this).datepicker({ altFormat: 'dd/mm/yyyy' });});");
 	Requirements::customScript("");
 }
}