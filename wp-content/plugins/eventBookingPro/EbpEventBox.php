<?php
require_once dirname( __FILE__ ) . '/include.php';

class EbpEventBox {

  public static function getEventBoxHTML($eventId, $occurrenceId, $show_all_tickets, $width) {
    global $wpdb;
    if ($occurrenceId != -1) {
      $isAvilable = $wpdb->get_var("SELECT count(*) FROM " . EbpDatabase::getTableName("eventDates")." where id='$occurrenceId' && event='$eventId'");
      if ($isAvilable == 0) {
        return '<div class="eventNotFound" style="width:auto;">Event Occurrence not found</div>';
      }
    };

    $eventData = $wpdb->get_row( "SELECT * FROM " . EbpDatabase::getTableName("events")." where id= '$eventId' ");
    $settingsOption = EventBookingHelpers::getStyling($width, 1);

    if ($show_all_tickets != NULL) {
      $settingsOption["settings"]->showAllTickets = $show_all_tickets;
    }

    if ($eventData != NULL) {

      $html = '<div id="' . EbpEvent::getEventUniqueName($eventId, $occurrenceId, "box_") . '" class="eventDisplayCnt" data-init-width="'.$settingsOption['width'].'" style="'.$settingsOption["box"].'">';

      $markUp = EbpEventBox::getEventMarkUp($eventId, $occurrenceId, $eventData, $settingsOption);

      $html .= $markUp["html"];
      $html .= '</div>';
    } else {
      $html = '<div class="eventNotFound" style="width:auto;">Event not found</div>';
    }

    return $html;
  }

  public static function getEventMarkUp($id, $dateId, $data, $settingsOption, $isCalendarDay=false) {
    global $wpdb;

    $date_id = $dateId;

    $curSymbol = EbpCurrency::getCurrencyForEvent($data, $settingsOption["currency"]);


    $eventClasses = EbpCategories::eventIdentificationClasses($id);

    $html = '';
    $html .= '<input name= "ajaxlink" value="'.site_url().'" type= "hidden"  />';

    $boxHasBoxShadow =  ($settingsOption["settings"]->box_hasBoxShadow == 'true') ? ' hasBoxShadow' : '';

    //title
    $html .= '<div class="ebpBox eb_frontend '.$eventClasses.$boxHasBoxShadow.' ">';
    $html .= '<div class="name" style="display:none;" >'.stripslashes($data->name).'</div>';
    $html .= '<h3 class="title" style="'.$settingsOption["title"].'">'.stripslashes($data->name).'</h3>';

    //image
    if ($data->image != "") {
      $html .= '<div class="eventImage" style="'.$settingsOption["imageStyle"].'" data-image="'.$data->image.'" data-image-crop="'.$settingsOption["imageCrop"].'" data-image-height="'.$settingsOption["imageHeight"].'" data-image-width="'.$settingsOption["imgWidth"].'" ></div>';
    }

    //map
    $displayAddress = ($data->address != '') ? $data->address : $data->mapAddress;
    if ($displayAddress != '' && $settingsOption['settings']->eventBoxIncludeAddress == 'true') {
      $address = preg_replace('/\s+/','+',$data->mapAddress);

      $html .= '<div class="EBP--Location"><a href="http://maps.google.com/?q='.$address.'" target="_blank">'.$displayAddress.'</a></div>';
    }

    if ($settingsOption['settings']->googleMapsEnabled == 'true') {
      $html .= '<div class="map_canvas" style="display:none; height:'.$settingsOption["settings"]->mapHeight.'px;" data-address="'.$data->mapAddress.'" data-zoom="'.$data->mapZoom.'" data-maptype="'.$data->mapType.'" data-addressType="'.$data->mapAddressType.'" ></div>';
    }

    //info
    if ($data->info != "") {
      $infoDeactive = ($settingsOption["settings"]->infoNoButton == "true") ? '' : 'deactive';
      $html .= '<div class="info '.$infoDeactive.'" style="'.$settingsOption["info"].'" data-closeTxt="'.$settingsOption["closeTextTxt"].'" data-expandTxt="'.$settingsOption["ExpandTextTxt"].'" data-height="'.$settingsOption["infoHeight"].'">';
          $html .= '<div class="cnt">';
              $html .= stripslashes ($data->info);
          $html .= '</div>';
      $html .= '</div>';
    }

    //get date
    list ($passedDates, $upcomingDates) = EbpEventOccurrence::getEventDatesAsPassedUpcoming($id);

    $allDates = array_merge($passedDates, $upcomingDates);

    $dateMarkUp = EbpEventOccurrence::getEventDateMarkUp($data, $dateId, $upcomingDates, $passedDates, $settingsOption['settings'], $settingsOption['settings']->includeEndsOn == 'true');

    $html .= $dateMarkUp["html"];
    $date_id = $dateMarkUp["dateID"];
    $date = $dateMarkUp["date"];
    $occurrence = $dateMarkUp["occurrence"];

    //details
    $eventTickets = $wpdb->get_results("SELECT * FROM " . EbpDatabase::getTableName("tickets")." where event='$id' order by id asc");
    $cost = $eventTickets[0]->cost;

    if ($settingsOption["settings"]->showAllTickets == 'false') {
      $left = 0;
      foreach($eventTickets as $ticketInfo) {
        $left += EbpEvent::checkSpots($date_id, $ticketInfo->id);
      }

      $spotsBookedAll = EbpBooking::getSpotsBookedForEvent($id, $date_id, $settingsOption["settings"]->spotsLeftStrict, $settingsOption["settings"]->statusesCountedAsCompleted);

      $maxSpots = intval($data->maxSpots);

      $left = ($maxSpots > 0) ? ($maxSpots - $spotsBookedAll) : $left;

      if ($left < 0) $left = 0; // take into account forced bookings

      if ($data->showPrice == "true" || $data->showSpots == "true") {
        $html .= '<div class="Ebp--EventDetails">';

        if ($data->showPrice == "true") {
          $html .= '<div class="Ebp--Price">';
          if (floatval($cost) == 0) {
              $html .= $settingsOption["settings"]->freeTxt;
          } else if ($data->showPrice == "true") {


            $html .=  EventBookingHelpers::currencyPricingFormat($cost,$curSymbol,$settingsOption["settings"]->currencyBefore,$settingsOption["settings"]->priceDecimalCount,$settingsOption["settings"]->priceDecPoint,$settingsOption["settings"]->priceThousandsSep);
          }
          $html .= '</div>';
        }

        if ($data->showSpots == "true") {
          if (EbpEventOccurrence::occurrenceClosed($occurrence, true)) {

            $buttonText = EbpEventOccurrence::occurenceHasStarted($occurrence) ? $settingsOption['settings']->passedTxt :  $settingsOption['settings']->bookingEndedTxt;

            $html .= '<div class="Ebp--PassedEvent" style="font-size:0.6em;">'.$buttonText.'</div>';
          } else {
            if ($left == 0) {
              $html .= '<div class="Ebp--PassedEvent" style="font-size:0.6em;">'.$settingsOption['settings']->bookedTxt.'</div>';
            } else {
              $html .= '<div class="Ebp--Spots">'.$left.'<span>'.$settingsOption['settings']->spotsLeftTxt.'</span></div>';
            }
          }
        }

        $html .= '</div>';
      }
    } else {
      $html .= EbpEventBox::getEventTicketsHTML($eventTickets, $settingsOption['settings'], $data->showPrice, $data->showSpots, $occurrence, $data);
    }

    // decide if to show/hide book button
    $showBtn = false;

    if ($isCalendarDay) {
      foreach($eventTickets as $ticketInfo) {
        if (EbpEvent::checkSpots($occurrence->id, $ticketInfo->id) > 0) {
          $showBtn = true;
          break;
        }
      }
    } else {
      // check if we have any day with a book button.
      foreach($allDates as $occur) {
        if (EbpEventOccurrence::occurrenceClosed($occur, true)) continue;

        foreach($eventTickets as $ticketInfo) {
          if (EbpEvent::checkSpots($occur->id, $ticketInfo->id) >0) {
            $showBtn = true;
            break;
          }
        }
      }
    }

    $pattern = '/[%=]/';
    $activeGatewaysArr = preg_split($pattern, $data->gateways);
    $showBtn = ($showBtn && ($data->paypal == "true" || $data->modal == "true" || in_array('true', $activeGatewaysArr) )) ;
    $modals = '';

    if ($data->eventStatus != 'active') {
      $showBtn = false;
      $html .= '<div class="buy"><cite>'.$settingsOption["settings"]->eventCancelledTxt.'</cite></div>';
    }

    if ($showBtn) {
      $bookingBtn = EbpEvent::getModalBtn($id, $occurrence, $date_id, $dateId, $settingsOption["settings"]->mobileSeperatePage, true, $settingsOption["btn"],
        $settingsOption["btnTxt"], $settingsOption["settings"]->bookingStartsTxts, $settingsOption["settings"]->bookingEndedTxt, $settingsOption["dateFormat"], $settingsOption["timeFormat"]);
      $html .= $bookingBtn['html'];
      $modals .= $bookingBtn['modal'];
    }

    if ($settingsOption['settings']->addToCalendar == "true" || $settingsOption['settings']->icsCalendar == "true") {
      $startDate = $dateMarkUp["occurrence"]->start_date;
      $startTime = $dateMarkUp["occurrence"]->start_time;
      $endDate = $dateMarkUp["occurrence"]->end_date;
      $endTime = $dateMarkUp["occurrence"]->end_time;

      $html .= '<div class="EBP--AddToCal--Cnt">';

      if ($settingsOption['settings']->addToCalendar == "true") {
        $html .= EbpShare::createGoogleCalLink($data->name, $data->info, $data->address, $startDate.' '.$startTime, $endDate.' '.$endTime, $settingsOption['settings']->timeZone, $settingsOption['settings']->addToCalendarText);
      }

      if ($settingsOption['settings']->icsCalendar == "true") {
        $html .= EbpShare::createICSCalendarLink($data->id, $dateMarkUp["occurrence"]->id, $settingsOption['settings']->icsCalendarTxt);
      }

      $html .= '</div>';
    }

    $html .= '</div>';

    return  array("html"=> $html, "modal"=> $modals);
  }

  public static function getEventTicketsHTML($eventTickets, $settings, $showPrice, $showSpots, $occurrence, $event){
    $html = '';
    if ($showPrice == "false" && $showSpots == "false") {
      return $html;
    }

    foreach($eventTickets as $ticket) {
      $html .= self::getEventTicketHTML($ticket, $settings, $showPrice, $showSpots, $occurrence, $event);
    }
    return $html;
  }

  public static function getEventTicketHTML($ticket, $settings, $showPrice, $showSpots, $occurrence, $event){
    $html = '<div class= "Ebp--EventDetails multipleTickets">';

    $curSymbol = EbpCurrency::getCurrencyForEvent($event, $settings->currency);

    $left = EbpEvent::checkSpots($occurrence->id, $ticket->id);

    $html .= '<div class="Ebp--TicketName">'.$ticket->name.'</div>';
    $html .= '<div>';
    if ($ticket->breakdown != '') {
      $ticket->breakdown = json_decode($ticket->breakdown);
      $html .= '<div class="Ebp--SubTickets">';
      foreach ($ticket->breakdown as $breakdown) {
        $html .= '<div class="Ebp--SubTicket">';
        $html .= $breakdown->name;

        if ($showPrice == "true") {

          if ($breakdown->cost == 0) {
            if ($settings->freeTxt != "") {
              $html .= ' - '.$settings->freeTxt;
            }
          } else {
            $html .= ' - ';
            $html .=  EventBookingHelpers::currencyPricingFormat($breakdown->cost, $curSymbol, $settings->currencyBefore,$settings->priceDecimalCount,$settings->priceDecPoint,$settings->priceThousandsSep);
          }

        }
        $html .= '</div>';
      }
      $html .= '</div>';

    } else {
      if ($showPrice == "true") {
        $html .= '<div class="Ebp--Price">';
        if ($ticket->cost == 0) {
            $html .= $settings->freeTxt;
        } else {
          $html .=  EventBookingHelpers::currencyPricingFormat($ticket->cost, $curSymbol, $settings->currencyBefore,$settings->priceDecimalCount,$settings->priceDecPoint,$settings->priceThousandsSep);
        }
        $html .= '</div>';
      }

    }

    if ($showSpots == "true") {
        if (EbpEventOccurrence::occurenceHasStarted($occurrence)) {
          $html .= '<div class="Ebp--PassedEvent" style="font-size:0.6em;">'.$settings->passedTxt.'</div>';
        } else {
          if ($left == 0) {
            $html .= '<div class="Ebp--PassedEvent" style="font-size:0.6em;">'.$settings->bookedTxt.'</div>';
          } else {
            $html .= '<div class="Ebp--Spots">'.$left.'<span>'.$settings->spotsLeftTxt.'</span></div>';
          }
        }
      }

      $html .= '</div>';
    $html .= '</div>';
    return $html;
  }

}
