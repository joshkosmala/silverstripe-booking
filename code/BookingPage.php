<?php

class BookingPage extends Page {

	function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}

}
 
class BookingPage_Controller extends Page_Controller {
 	private static $allowed_actions = array('Form');
	
	function init() {
		parent::init();
		Requirements::javascript('silverstripe-booking/javascript/TermsAgree.jquery.js');
	}


	public function Form() {
		$arrDate = new DateField('ArrivalDate');
		$arrDate->setTitle('Arrival Date');
		$arrDate->setLocale("en_NZ");
		$arrDate->setConfig("showcalendar", true);
		$depDate = new DateField('DepartureDate');
		$depDate->setTitle('Departure Date');
		$depDate->setLocale("en_NZ");
		$depDate->setConfig("showcalendar", true);
		$fields = new FieldList(
		LiteralField::create('BookHead', '<h2>Booking Details</h2>'),
		TextField::create('FirstName')->setTitle('First Name'),
		TextField::create('Surname'),
		EmailField::create('Email'),
		TextField::create('Phone'),
		$arrDate,
		TimeField::create('ArrivalTime')->setTitle('Time (example: 3pm)'),
		$depDate,
		new DropdownField('RoomType', 'Room Type', singleton('Booking')->dbObject('RoomType')->enumValues()),
		TextareaField::create('Comments')->setRows(5)->setColumns(50),
		new DropdownField("TermsAndConditions", "I have read the <a href=\"make-a-booking/cancellation-policy\">cancellation policy</a>", $source = array(
				"0" => "No",
				"1" => "Yes"
			))
		

	);
	$actions = new FieldList(FormAction::create("placeBooking")->setTitle("Place Booking"));
	$validator = new RequiredFields('FirstName','Surname','Email','ArrivalDate');
	return new Form($this, "form", $fields, $actions, $validator);
	
	}
	
	public function placeBooking($data, $form) {
        $config = SiteConfig::current_site_config();
		$booking = new Booking();
		$form->saveInto($booking);
		$booking->write();
		$content = "<p>" . $data['FirstName'] . " " . $data['Surname'] . "<br />" . $data['Email'] . "<br />" . $data['Phone'] . "<br />" . $data['ArrivalDate'] . "<br />" . $data['ArrivalTime'] . "<br />" . $data['DepartureDate'] . "<br />" . $data['RoomType'] . "<br />"  . $data['Comments'] . "</p>";
		$email = new Email();
		$email->setTo(Email::getAdminEmail());
		$email->setFrom($data['Email']);
		$email->setSubject("New Booking from " . $config->Title);
		$email->setBody($form->forTemplate());
		$email->send();
		return array(
		            'Content' => '<p>Your Booking request has been sent.</p><p>&nbsp;</p>',
		            'form' => ''
		        );
		
	}

}


?>
