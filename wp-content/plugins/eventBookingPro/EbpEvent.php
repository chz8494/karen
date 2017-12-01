<?php
require_once dirname( __FILE__ ) . '/include.php';

// ================================================
// ================ Event Class ===================
// ================================================

class EbpEvent {
  public static function getTablesSQL() {
    //event table
    $eventTable = EbpDatabase::getTableName("events");
    $eventsSQL = "CREATE TABLE " . $eventTable ." (
            id INT NOT NULL AUTO_INCREMENT ,
            name VARCHAR(255) NOT NULL  ,
            paypal VARCHAR(6) default 'false',
            modal VARCHAR(6) default 'false',
            showPrice VARCHAR(7) default 'true',
            showSpots VARCHAR(7) default 'true',
            info TEXT,
            image VARCHAR(255),
            background VARCHAR(255),
            mapAddressType VARCHAR(20) default 'address',
            mapAddress VARCHAR(255) default '',
            address VARCHAR(255) default '',
            mapZoom int default '16',
            mapType VARCHAR(15) default 'ROADMAP',
            form int default '-1',
            maxSpots int default '-1',
            gateways VARCHAR(255) default '',
            ownerEmail VARCHAR(255) default 'default',
            emailTemplateID int default '-1',
            eventStatus VARCHAR(50) default 'active',
            currency VARCHAR(3) default '',
            PRIMARY KEY (id)
          );";

    return array($eventsSQL);
  }

  // CRUD OPERATIONS
  public static function saveEvent($POST) {
    global $wpdb;

    $eventTable = EbpDatabase::getTableName("events");
    $eventDateTable = EbpDatabase::getTableName("eventDates");
    $ticketsTable = EbpDatabase::getTableName("tickets");

    $id = $POST['event-id'];
    $name = (string) $POST['name'];
    $image = (string) $POST['image'];
    $info = (string) $POST['info'];
    $offlineBooking = (string) $POST['offlineBooking'];
    $paypal = (string) $POST['paypal'];
    $showPrice = (string) $POST['showPrice'];
    $showSpots = (string) $POST['showSpots'];
    $occurrences = json_decode(stripslashes($POST['occurrences']), true);
    $tickets = json_decode(stripslashes($POST['tickets']), true);
    $mapAddressType = (string) $POST['mapAddressType'];
    $mapAddress = (string) $POST['mapAddress'];
    $mapZoom = (string) $POST['mapZoom'];
    $mapType = (string) $POST['mapType'];
    $maxSpots = (string) $POST['maxSpots'];
    $form = (string) $POST['form'];
    $gateways = (string) $POST['gateways'];
    $background = (string) $POST['background'];
    $address = (string) $POST['address'];
    $currency = (string) $POST['currency'];

    $ownerEmail = (string) $POST['ownerEmail'];
    $ownerEmail = EventBookingHelpers::isValidEmail($ownerEmail) ? $ownerEmail : 'default';
    $emailTemplateID = (string) $POST['emailTemplateID'];


    if ($form == "" || $form == NULL) $form = "-1";

    $isAvilable = $wpdb->get_var( "select COUNT(*) from " . $eventTable ." where id='$id'");

    $settings = EbpSettings::getSettingsById(1, "emailOccurenceDeleted, emailOccurenceCanceledTemplate", "");

    $eventData = array(
      'name'=> $name,
      'paypal'=> $paypal,
      'modal'=> $offlineBooking,
      'showPrice'=> $showPrice,
      'showSpots'=> $showSpots,
      'info'=> $info,
      'mapType'=> $mapType,
      'mapZoom'=> $mapZoom,
      'mapAddress'=> $mapAddress,
      'mapAddressType'=> $mapAddressType,
      'address' => $address,
      'image'=> $image,
      'form'=> $form,
      'maxSpots'=> $maxSpots,
      'gateways'=> $gateways,
      'background'=>$background,
      'ownerEmail'=> $ownerEmail,
      'emailTemplateID' => $emailTemplateID,
      'currency' => $currency
    );

    if ($isAvilable > 0) {
      $wpdb->update($eventTable, $eventData, array('id'=> $id));
      LogsService::eventLog($id, LogsTypes::EVENT_UPDATED, '');
    } else {
      $eventData["id"] = $id;
      $wpdb->insert($eventTable, $eventData );
      $id = $wpdb->insert_id;
      LogsService::eventLog($id, LogsTypes::EVENT_CREATED, '');
    }

    // handle occurrences
    $occurIds = array();
    foreach ($occurrences as $occurData) {
      $occurId = EbpEventOccurrence::addEventOccurence($id, (object) $occurData);
      array_push($occurIds, $occurId);
    }

    $results = $wpdb->get_results("SELECT * FROM " .$eventDateTable." where event='$id'");
    foreach ($results as $result) {
      if (!in_array($result->id, $occurIds)) {
        EbpEventOccurrence::deleteOccurence($result->id, $settings);
      }
    }


    // handle tickets
    $ticketIds = array();
    foreach ($tickets as $ticketItem) {
      $ticketId = EbpEventTickets::addTicket($id, (object) $ticketItem);
      array_push($ticketIds, $ticketId);
    }

    //delete those deleted
    $results = $wpdb->get_results("SELECT * FROM " .$ticketsTable." where event= '$id'");
    foreach ($results as $result) {
      if (!in_array($result->id, $ticketIds)) {
        EbpEventTickets::deleteTicket($result->id);
      }
    }

    // handle emails
    if (EbpAddOnManager::usesEmailRules() && isset($POST['emailRulesData'])) {
      $rules = json_decode(stripslashes($POST['emailRulesData']), true);
      eventBookingProEmailsClass::updateEmailRules($id, $rules);
    }

    return;
  }

  public static function deleteEvent($eventID) {
    global $wpdb;

    // delete event
    $wpdb->delete(EbpDatabase::getTableName("events"), array('id'=> $eventID));

    // delete occurrences of event
    $wpdb->delete(EbpDatabase::getTableName("eventDates"),  array('event'=> $eventID));

    // delete coupons of event
    $wpdb->delete(EbpDatabase::getTableName("eventCoupons"),  array('event'=> $eventID));

    // delete categories of event
    $wpdb->delete(EbpDatabase::getTableName("categoryEvents"),  array('event'=> $eventID));

    // delete tickets of event
    $wpdb->delete(EbpDatabase::getTableName("tickets"),  array('event'=> $eventID));

     // delete booking of event
    $wpdb->delete(EbpDatabase::getTableName("payments"),  array('event_id'=> $eventID));

    return $eventID;
  }

  function setEventActive($id, $eventStatus) {
    global $wpdb;

    $wpdb->update(EbpDatabase::getTableName("events"), array("eventStatus"=>$eventStatus), array('id'=> $id));

    if ($eventStatus == 'active') {
      LogsService::eventLog($id, LogsTypes::EVENT_ACTIVATED, '');
    } else {
      LogsService::eventLog($id, LogsTypes::EVENT_DEACTIVATED, '');
    }

    return;
  }

  function cancelEvent($id) {
    global $wpdb;

    $wpdb->update(EbpDatabase::getTableName("events"), array("eventStatus"=>'canceled'), array('id'=> $id));

    $settings = EbpSettings::getSettingsById(1, "emailEventCanceled, emailEventCanceledTemplate", "");
    $emailsCount = 0;
    if ($settings->emailEventCanceled == 'true' && EbpAddOnManager::usesEmailRules()) {

      list ($passedDates, $upcomingDates) = EbpEventOccurrence::getEventDatesAsPassedUpcoming($id);

      foreach ($upcomingDates as $date) {
        $dateid = $date->id;
        $payments = $wpdb->get_results("SELECT id FROM " . EbpDatabase::getTableName("payments") ." where date_id='$dateid'");
        foreach ($payments as $payment) {
          EmailService::sendCustomEmail($payment->id, $settings->emailEventCanceledTemplate);
          $emailsCount++;
        }
      }
    }
    LogsService::eventLog($id, LogsTypes::EVENT_CANCELED, 'Emails sent to ' . $emailsCount. ' bookers');

    return;
  }

  public static function getEventById($id, $sel='*') {
    global $wpdb;
    // to do handle errors

    return $wpdb->get_row("SELECT " . $sel . " FROM " . EbpDatabase::getTableName("events")." where id='$id'");
  }

  public static function getEventData($id) {
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM " . EbpDatabase::getTableName("events")." where id= '$id' ");
    $result->occur = EbpEventOccurrence::getEventOccurence($id);
    $result->tickets = EbpEventTickets::getTickets($id);

    $formData = EventBookingAdmin::getForms();
    $result->forms = $formData->forms;
    $result->hasForms = $formData->hasForms;

    $emailTemplatesData = EventBookingAdmin::getEmailAddonData($id);
    $result->emailTemplates = $emailTemplatesData->emailTemplates;
    $result->hasEmailTemplates = $emailTemplatesData->hasEmailTemplates;
    $result->hasEmailRules = $emailTemplatesData->hasEmailRules;

    if (property_exists($emailTemplatesData, 'emailRules')) {
      $result->emailRules = $emailTemplatesData->emailRules;
    }

    $result->gateways = EventBookingAdmin::getGateways($result->gateways);

    if ($result != NULL) {
      return json_encode($result);
    } else {
      return "Error";
    }
  }

  public static function getEvents($eventsTypes, $order, $categories, $limit, $months, $nextdays, $showOccurencesAsSeperate) {
    global $wpdb;
    $COND = '';
    switch ($eventsTypes) {
      case 'passed':
        $COND = 'where start_date < CURDATE() or (start_date = CURDATE() and start_time <= CURTIME())';
        break;
      case 'all':
        $COND = '';
        break;
      default:
        $COND = 'where o.start_date > CURDATE() or (o.start_date = CURDATE() and o.start_time > CURTIME())';
        break;
    }

    $results = $wpdb->get_results("SELECT *, o.id as date_id FROM ".EbpDatabase::getTableName("events")." as e right OUTER join ".EbpDatabase::getTableName("eventDates")."  as o on e.id = o.event ".$COND." order by o.start_date ".$order.", o.start_time  ".$order);

    $addedEvents = array();
    $finalResult = array();

    foreach ($results as $result) {
      $id = $result->event;

      if ($showOccurencesAsSeperate == "off" && in_array($id, $addedEvents)) {
        continue;
      }

      if (sizeof($addedEvents) >=  $limit) {
        continue;
      }

      $inMonths = false;
      $isNextdays = false;

      $inMonths = $inMonths || EbpEvent::eventBelongsToMonths($result->start_date, $months);
      $isNextdays = $isNextdays || EbpEvent::eventBelongsToNextDays($result->start_date, $nextdays);

      if (EbpCategories::eventBelongsToCategories($id, $categories) && $inMonths && $isNextdays) {
        array_push($addedEvents, $id);
        array_push($finalResult, $result);
      }
    }

    return $finalResult;
  }

  // HELPER FUNCTIONS

  public static function eventBelongsToMonths($startDate, $months) {
    if ($months == NULL || $months == "") return true;

    $months = preg_replace('/\s+/', '', $months);
    $months = explode(",", $months);

    $eventMonth = intval(substr($startDate, strpos($startDate, '-')+1, strrpos($startDate, '-')-strpos($startDate, '-')-1));

    return in_array($eventMonth, $months);
  }

  public static function eventBelongsToNextDays($startDate, $nextdays) {
    if ($nextdays == NULL || $nextdays == "") return true;

    $startDate = $startDate.' 00:00:00';

    $nextdays = intval($nextdays);

    $eventDate = date_create($startDate);
    $today = new DateTime();
    $today->setTime(0, 0);
    $interval = date_diff($today, $eventDate);
    $diff = intval($interval->format('%R%a'));

    return ($diff  >=  0 && $diff <= $nextdays);
  }

	// Backwards compatibility
	public static function occurenceHasPassed($occur) {
		return !EbpEventOccurrence::occurenceHasEnded($occur);
	}


  public static function getAllSpotsLeft($eventID, $dateId) {
    global $wpdb;

    $event = $wpdb->get_row("SELECT maxSpots FROM " . EbpDatabase::getTableName("events")." where id='$eventID' ");
    $maxSpots = intval($event->maxSpots);

    $eventTickets = $wpdb->get_results("SELECT id, allowed FROM " . EbpDatabase::getTableName("tickets")." where event= '$eventID'");

    $left = 0;
    foreach ($eventTickets as $ticket) {
      $left += self::checkSpots($dateId, $ticket->id, $ticket->allowed, $eventID, $maxSpots);
    }

    if($maxSpots > 0 && $maxSpots < $left) {
      $left = $maxSpots;
    }

    return $left;
  }

	public static function checkSpots($dateId, $ticketId, $ticketAllowed=null, $eventID=null, $maxSpots=null) {
		global $wpdb;

		$spotsLeftStrict = $wpdb->get_var( "SELECT spotsLeftStrict FROM " . EbpDatabase::getTableName("settings")." where id=1 ");

    if ($eventID == null || $ticketAllowed == null) {
      $ticketRow = $wpdb->get_row( "SELECT allowed, event FROM " . EbpDatabase::getTableName("tickets")." where id='$ticketId' ");
      $ticketAllowed = intval($ticketRow->allowed);
      $eventID = $ticketRow->event;
    }

    if ($maxSpots == null) {
      $event = $wpdb->get_row("SELECT maxSpots  FROM " . EbpDatabase::getTableName("events")." where id='$eventID' ");
      $maxSpots = intval($event->maxSpots);
    }


		$bookingsAll = $wpdb->get_results( "SELECT quantity, status FROM " . EbpDatabase::getTableName("payments")." where date_id='$dateId' and event_id='$eventID'");

		$allBookingsForThisDate = 0;

		foreach($bookingsAll as $bookingA) {
			if ($spotsLeftStrict == "false") {
				$allBookingsForThisDate += intval($bookingA->quantity);
			} else {
				$bookingStatus = $bookingA->status;
				if (strcasecmp($bookingStatus,"paid") == 0 ||  strcasecmp($bookingStatus,"not paid") == 0 ||
				strcasecmp($bookingStatus,"completed") == 0 || strcasecmp($bookingStatus, "ok")==0 ||
				strcasecmp($bookingStatus,"success") == 0 || strcasecmp($bookingStatus,"successful") == 0
				|| strcasecmp($bookingStatus,"successfull") == 0 )
					$allBookingsForThisDate += intval($bookingA->quantity);
			}
		}

		$leftFromAll = $maxSpots - $allBookingsForThisDate;


		//For the ticket
		$bookings = $wpdb->get_results( "SELECT quantity, status FROM " . EbpDatabase::getTableName("payments")." where date_id='$dateId' and ticket_id='$ticketId'");

		$ticketBookedCount = 0;

		foreach($bookings as $bookingA) {
			if ($spotsLeftStrict == "false") {
				$ticketBookedCount += intval($bookingA->quantity);
			} else {
				$bookingStatus= $bookingA->status;
				if (strcasecmp($bookingStatus,"paid") == 0 ||  strcasecmp($bookingStatus,"not paid") == 0 ||
				strcasecmp($bookingStatus,"completed") == 0 || strcasecmp($bookingStatus, "ok")==0 ||
				strcasecmp($bookingStatus,"success") == 0 || strcasecmp($bookingStatus,"successful") == 0
				||strcasecmp($bookingStatus,"successfull") == 0 )
					$ticketBookedCount += intval($bookingA->quantity);
			}
		}

		$left = $ticketAllowed - $ticketBookedCount;

		if($maxSpots > 0) {
			$left = ($left > $leftFromAll) ? $leftFromAll : $left;
		}

		if ($left < 0) $left = 0; // take into account the forced bookings.
		return $left;
	}


  public static function getEventStatus($id) {
    global $wpdb;

    return $wpdb->get_var("select eventStatus from " . EbpDatabase::getTableName("events") ." where id= '$id'");
  }


	// VIEW BOOKED FUNCTIONS
	public static function viewBookedBtn($eventId, $dateId, $mobileSeperatePage) {
		$html = '';
		if (EbpAddOnManager::getUsersAddonPath() && EventBookingProUsersClass::viewBooked()) {
			$html .= EventBookingProUsersClass::getWhoBookedBtn($eventId, $dateId, $mobileSeperatePage);
		}

		return $html;
	}

	public static function getModalBtn($id, $occur, $date_id, $dateId, $mobileSeperatePage, $active, $btnStyling, $txt, $notOpenTxt, $bookingEndedTxt, $dateFormat, $timeFormat, $class = 'buy') {
		$html = '';
    $html .= '<input name="ebpMobilegPage" value="'.get_page_link(get_option('ebp_page_id')).'" type= "hidden" />';

		if ($btnStyling == '') {
			$btnStyling['btn'] = '';
			$btnStyling['cnt'] = '';
		}
		if ($date_id > -1)
			$modalLink = $id.$date_id;
		else
			$modalLink = $id;

		$mdtrigger = ($active) ? 'ebp-trigger' : '';
		$deactiveClass = (!$active) ? 'deactive' : '';

		if (EbpAddOnManager::getUsersAddonPath()) {
			$requireLogin = !EventBookingProUsersClass::showBookBtn();
		} else {
			$requireLogin = false;
		}

		$html .= '<div class="'.$class.'" style="'.$btnStyling['cnt'].'">';

		if ($requireLogin) {
			$html .= EventBookingProUsersClass::getRequireLoginHtml();
		} else {
			$bookingStatus = EbpEventOccurrence::bookingOpen($occur);

			if ($bookingStatus == 0) {
        $html .= '<a data-seperatePage="'.$mobileSeperatePage.'" data-modal="offlineBooking'.$modalLink.'" data-id="'.$id.'" data-dateid="'.$dateId.'"  data-to-open="'.$dateId.'" class="EBP--BookBtn  '.$mdtrigger.' '.$deactiveClass.'">'.stripslashes($txt).'</a>';
			} else if ($bookingStatus == 1) {
				$dateFormat = EventBookingHelpers::convertDateFormat($dateFormat);
        $startDate = utf8_encode(strftime($dateFormat, strtotime($occur->startBooking_date)));
        $startTime = date($timeFormat, strtotime($occur->startBooking_time));


				$html .= '<cite>'.str_replace(array('%date%', '%time%'), array($startDate, $startTime), $notOpenTxt).'</cite>';

			} else {
				$html .= '<cite>'.$bookingEndedTxt.'</cite>';
			}
		}

		// get booked people
		if ($active) {
			$html .= self::viewBookedBtn($id, $date_id, $mobileSeperatePage);
		}

		$html .= '</div>';

		return array('html' => $html, 'modal' => '');
	}

  public static function getEventUniqueName($eventId, $occurrenceId, $prefix = "", $suffix = "") {
    if ($occurrenceId != null && $occurrenceId != "" && intval($occurrenceId) < 0) {
      $occurrenceId = "";
    }

    $uniqueName = $eventId;
    if ($occurrenceId != '') {
      $uniqueName .= '_' . $occurrenceId;;
    }

    return "ebp_event_" . $prefix . $uniqueName . $suffix;
  }
}
?>
