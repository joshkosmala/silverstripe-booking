<?php

class Booking extends DataObject {

static $db = array(
	'FirstName' => "Varchar",
	'Surname' => "Varchar",
	'Email' => "Varchar",
	'Phone' => "Varchar",
	'ArrivalDate' => "Date",
	'ArrivalTime' => "Time",
	'DepartureDate' => "Date",
	'RoomType' => "Enum('Single,Double,Twin,Triple', 'Single')",
	'Comments' => "Text"
);


}

?>