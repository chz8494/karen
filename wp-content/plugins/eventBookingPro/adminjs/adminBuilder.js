var EbpAdminBuilder = new function() {
  var DATE_FORMAT = {
    formats: [
      ['F j, Y', 'November 2 , 2015'],
      ['l F j, Y', 'Saturday November 2, 2015'],
      ['D M j Y', 'Sat Nov 2 2014'],
      ['D j. F Y', 'Sat 2. November 2014'],

      ['j F Y', '2 November 2014'],
      ['j. F Y', '2. November 2014'],
      ['l j F Y', 'Saturday 2 November 2014'],
      ['l, j. F Y', 'Saturday, 2. November 2014'],

      ['m.d.y', 'M.D.01'],
      ['m.d.Y', 'M.D.2001'],
      ['d.m.y', 'D.M.14'],
      ['d.m.Y', 'D.M.2014'],

      ['j, n, Y', 'D, M, 2014'],
      ['n, j, Y', 'M, D, 2014'],
      ['j, n, y', 'D, M, 14'],
      ['n, j, y', 'M, D, 14'],

      ['j/n/Y', 'D/M/2014'],
      ['n/j/Y', 'M/D/2014'],
      ['j/n/y', 'D/M/14'],
      ['n/j/y', 'M/D/14'],

      ['j - n - Y', 'D - M - 2014'],
      ['n - j - Y', 'M - D - 2014'],
      ['j - n - y', 'D - M - 14'],
      ['n - j - y', 'M - D - 14'],
      ['Y/m/d', '2015/M/D']
    ],
    init: function () {
      this.getFormats = _.map(this.formats, function(format) { return format[0] });
     this.getLabels =  _.map(this.formats, function(format) { return format[1] });

      return this;
    }
  }.init();

  var TIME_ZONES = {
    formats: [['(GMT-11:00) Midway Island', 'Pacific/Midway'],['(GMT-11:00) Samoa', 'Pacific/Samoa'],['(GMT-10:00) Hawaii', 'Pacific/Honolulu'],['(GMT-09:00) Alaska', 'US/Alaska'],['(GMT-08:00) Pacific Time (US &amp; Canada)', 'America/Los_Angeles'],['(GMT-08:00) Tijuana', 'America/Tijuana'],['(GMT-07:00) Arizona', 'US/Arizona'],['(GMT-07:00) Chihuahua', 'America/Chihuahua'],['(GMT-07:00) La Paz', 'America/Chihuahua'],['(GMT-07:00) Mazatlan', 'America/Mazatlan'],['(GMT-07:00) Mountain Time (US &amp; Canada)', 'US/Mountain'],['(GMT-06:00) Central America', 'America/Managua'],['(GMT-06:00) Central Time (US &amp; Canada)', 'US/Central'],['(GMT-06:00) Guadalajara', 'America/Mexico_City'],['(GMT-06:00) Mexico City', 'America/Mexico_City'],['(GMT-06:00) Monterrey', 'America/Monterrey'],['(GMT-06:00) Saskatchewan', 'Canada/Saskatchewan'],['(GMT-05:00) Bogota', 'America/Bogota'],['(GMT-05:00) Eastern Time (US &amp; Canada)', 'US/Eastern'],['(GMT-05:00) Indiana (East)', 'US/East-Indiana'],['(GMT-05:00) Lima', 'America/Lima'],['(GMT-05:00) Quito', 'America/Bogota'],['(GMT-04:00) Atlantic Time (Canada)', 'Canada/Atlantic'],['(GMT-04:30) Caracas', 'America/Caracas'],['(GMT-04:00) La Paz', 'America/La_Paz'],['(GMT-04:00) Santiago', 'America/Santiago'],['(GMT-03:30) Newfoundland', 'Canada/Newfoundland'],['(GMT-03:00) Brasilia', 'America/Sao_Paulo'],['(GMT-03:00) Buenos Aires', 'America/Argentina/Buenos_Aires'],['(GMT-03:00) Georgetown', 'America/Argentina/Buenos_Aires'],['(GMT-03:00) Greenland', 'America/Godthab'],['(GMT-02:00) Mid-Atlantic', 'America/Noronha'],['(GMT-01:00) Azores', 'Atlantic/Azores'],['(GMT-01:00) Cape Verde Is.', 'Atlantic/Cape_Verde'],['(GMT+00:00) Casablanca', 'Africa/Casablanca'],['(GMT+00:00) Edinburgh', 'Europe/London'],['(GMT+00:00) Greenwich Mean Time : Dublin', 'Etc/Greenwich'],['(GMT+00:00) Lisbon', 'Europe/Lisbon'],['(GMT+00:00) London', 'Europe/London'],['(GMT+00:00) Monrovia', 'Africa/Monrovia'],['(GMT+00:00) UTC', 'UTC'],['(GMT+01:00) Amsterdam', 'Europe/Amsterdam'],['(GMT+01:00) Belgrade', 'Europe/Belgrade'],['(GMT+01:00) Berlin', 'Europe/Berlin'],['(GMT+01:00) Bern', 'Europe/Berlin'],['(GMT+01:00) Bratislava', 'Europe/Bratislava'],['(GMT+01:00) Brussels', 'Europe/Brussels'],['(GMT+01:00) Budapest', 'Europe/Budapest'],['(GMT+01:00) Copenhagen', 'Europe/Copenhagen'],['(GMT+01:00) Ljubljana', 'Europe/Ljubljana'],['(GMT+01:00) Madrid', 'Europe/Madrid'],['(GMT+01:00) Paris', 'Europe/Paris'],['(GMT+01:00) Prague', 'Europe/Prague'],['(GMT+01:00) Rome', 'Europe/Rome'],['(GMT+01:00) Sarajevo', 'Europe/Sarajevo'],['(GMT+01:00) Skopje', 'Europe/Skopje'],['(GMT+01:00) Stockholm', 'Europe/Stockholm'],['(GMT+01:00) Vienna', 'Europe/Vienna'],['(GMT+01:00) Warsaw', 'Europe/Warsaw'],['(GMT+01:00) West Central Africa', 'Africa/Lagos'],['(GMT+01:00) Zagreb', 'Europe/Zagreb'],['(GMT+01:00) Zurich', 'Europe/Zurich'],['(GMT+02:00) Athens', 'Europe/Athens'],['(GMT+02:00) Bucharest', 'Europe/Bucharest'],['(GMT+02:00) Cairo', 'Africa/Cairo'],['(GMT+02:00) Harare', 'Africa/Harare'],['(GMT+02:00) Helsinki', 'Europe/Helsinki'],['(GMT+02:00) Istanbul', 'Europe/Istanbul'],['(GMT+02:00) Jerusalem', 'Asia/Jerusalem'],['(GMT+02:00) Kyiv', 'Europe/Helsinki'],['(GMT+02:00) Pretoria', 'Africa/Johannesburg'],['(GMT+02:00) Riga', 'Europe/Riga'],['(GMT+02:00) Sofia', 'Europe/Sofia'],['(GMT+02:00) Tallinn', 'Europe/Tallinn'],['(GMT+02:00) Vilnius', 'Europe/Vilnius'],['(GMT+03:00) Baghdad', 'Asia/Baghdad'],['(GMT+03:00) Kuwait', 'Asia/Kuwait'],['(GMT+03:00) Minsk', 'Europe/Minsk'],['(GMT+03:00) Nairobi', 'Africa/Nairobi'],['(GMT+03:00) Riyadh', 'Asia/Riyadh'],['(GMT+03:00) Volgograd', 'Europe/Volgograd'],['(GMT+03:30) Tehran', 'Asia/Tehran'],['(GMT+04:00) Abu Dhabi', 'Asia/Muscat'],['(GMT+04:00) Baku', 'Asia/Baku'],['(GMT+04:00) Moscow', 'Europe/Moscow'],['(GMT+04:00) Muscat', 'Asia/Muscat'],['(GMT+04:00) St. Petersburg', 'Europe/Moscow'],['(GMT+04:00) Tbilisi', 'Asia/Tbilisi'],['(GMT+04:00) Yerevan', 'Asia/Yerevan'],['(GMT+04:30) Kabul', 'Asia/Kabul'],['(GMT+05:00) Islamabad', 'Asia/Karachi'],['(GMT+05:00) Karachi', 'Asia/Karachi'],['(GMT+05:00) Tashkent', 'Asia/Tashkent'],['(GMT+05:30) Chennai', 'Asia/Calcutta'],['(GMT+05:30) Kolkata', 'Asia/Kolkata'],['(GMT+05:30) Mumbai', 'Asia/Calcutta'],['(GMT+05:30) New Delhi', 'Asia/Calcutta'],['(GMT+05:30) Sri Jayawardenepura', 'Asia/Calcutta'],['(GMT+05:45) Kathmandu', 'Asia/Katmandu'],['(GMT+06:00) Almaty', 'Asia/Almaty'],['(GMT+06:00) Astana', 'Asia/Dhaka'],['(GMT+06:00) Dhaka', 'Asia/Dhaka'],['(GMT+06:00) Ekaterinburg', 'Asia/Yekaterinburg'],['(GMT+06:30) Rangoon', 'Asia/Rangoon'],['(GMT+07:00) Bangkok', 'Asia/Bangkok'],['(GMT+07:00) Hanoi', 'Asia/Bangkok'],['(GMT+07:00) Jakarta', 'Asia/Jakarta'],['(GMT+07:00) Novosibirsk', 'Asia/Novosibirsk'],['(GMT+08:00) Beijing', 'Asia/Hong_Kong'],['(GMT+08:00) Chongqing', 'Asia/Chongqing'],['(GMT+08:00) Hong Kong', 'Asia/Hong_Kong'],['(GMT+08:00) Krasnoyarsk', 'Asia/Krasnoyarsk'],['(GMT+08:00) Kuala Lumpur', 'Asia/Kuala_Lumpur'],['(GMT+08:00) Perth', 'Australia/Perth'],['(GMT+08:00) Singapore', 'Asia/Singapore'],['(GMT+08:00) Taipei', 'Asia/Taipei'],['(GMT+08:00) Ulaan Bataar', 'Asia/Ulan_Bator'],['(GMT+08:00) Urumqi', 'Asia/Urumqi'],['(GMT+09:00) Irkutsk', 'Asia/Irkutsk'],['(GMT+09:00) Osaka', 'Asia/Tokyo'],['(GMT+09:00) Sapporo', 'Asia/Tokyo'],['(GMT+09:00) Seoul', 'Asia/Seoul'],['(GMT+09:00) Tokyo', 'Asia/Tokyo'],['(GMT+09:30) Adelaide', 'Australia/Adelaide'],['(GMT+09:30) Darwin', 'Australia/Darwin'],['(GMT+10:00) Brisbane', 'Australia/Brisbane'],['(GMT+10:00) Canberra', 'Australia/Canberra'],['(GMT+10:00) Guam', 'Pacific/Guam'],['(GMT+10:00) Hobart', 'Australia/Hobart'],['(GMT+10:00) Melbourne', 'Australia/Melbourne'],['(GMT+10:00) Port Moresby', 'Pacific/Port_Moresby'],['(GMT+10:00) Sydney', 'Australia/Sydney'],['(GMT+10:00) Yakutsk', 'Asia/Yakutsk'],['(GMT+11:00) Vladivostok', 'Asia/Vladivostok'],['(GMT+12:00) Auckland', 'Pacific/Auckland'],['(GMT+12:00) Fiji', 'Pacific/Fiji'],['(GMT+12:00) International Date Line West', 'Pacific/Kwajalein'],['(GMT+12:00) Kamchatka', 'Asia/Kamchatka'],['(GMT+12:00) Magadan', 'Asia/Magadan'],['(GMT+12:00) Marshall Is.', 'Pacific/Fiji'],['(GMT+12:00) New Caledonia', 'Asia/Magadan'],['(GMT+12:00) Solomon Is.', 'Asia/Magadan'],['(GMT+12:00) Wellington', 'Pacific/Auckland'],['(GMT+13:00) Nuku\'alofa', 'Pacific/Tongatapu']
    ],
    init: function () {
      this.getFormats = _.map(this.formats, function(format) { return format[1] });
     this.getLabels =  _.map(this.formats, function(format) { return format[0] });

      return this;
    }
  }.init();



  this.doOption = function (parms){
    var itemSpecialClass = (parms.hasOwnProperty("itemClass")) ? parms.itemClass : "";
    var optionHtml = '<div class="item ' + itemSpecialClass + '">';

    if (parms.hasOwnProperty("before") && parms.before != "") {
      optionHtml += ' ' + parms.before;
    }

    if (parms.title !== ''){
      optionHtml += '<span class="label">' + parms.title + '</span>';
    }

    switch(parms.type) {
      case "input":
        var maxlength = (parms.hasOwnProperty('maxlength')) ? 'maxlength="' + parms.maxlength + '"' : "";
        optionHtml += '<input name="'+parms.name+'" value="'+parms.value+'"  class="settingField" type="text" '+maxlength+'/>';
        break;

      case "input-mini":
        var maxlength = (parms.hasOwnProperty('maxlength')) ? 'maxlength="' + parms.maxlength + '"' : "";
        optionHtml += '<input name="'+parms.name+'" value="'+parms.value+'"  class="settingField settingField-mini" type="text" '+maxlength+'  />';
        break;

      case "input-large":
        var maxlength = (parms.hasOwnProperty('maxlength')) ? 'maxlength="' + parms.maxlength + '"' : "";
        optionHtml += '<input name="'+parms.name+'" value="'+parms.value+'"  class="settingField settingField-large" type="text" '+maxlength+'/>';
        break;

      case "textarea":
        optionHtml += '<textarea name="'+parms.name+'" type="text">'+parms.value+'</textarea>';
        break;

      case "password":
        optionHtml += '<input name="'+parms.name+'" value="'+parms.value+'"  class="settingField" type="password"  />';
        break;

      case "number":
        var Min = (parms.hasOwnProperty('min')) ? 'min="'+parms.min+'"' : "";
        var Max = (parms.hasOwnProperty('max')) ? 'max="'+parms.max+'"' : "";
        optionHtml += '<input name="'+parms.name+'" value="'+parms.value+'" type="number" '+Min+' '+Max+' />';

        break;

      case "color":
        optionHtml += '<input id="'+parms.name+'" name="'+parms.name+'" class="colorPicker" data-default-color="'+parms.defaultValue+'"  type="text"  value="'+parms.value+'" />';
        break;

      case "select":
        optionHtml += '<select id="'+parms.name+'" name="'+parms.name+'">';

        var isSelected;
        for(var opt in parms.values){
          isSelected=(parms.values[opt] == parms.value) ? 'selected="selected"' : '';
          optionHtml += '<option value="'+parms.values[opt]+'" '+isSelected+'>'+parms.options[opt]+'</option>';
        }

        optionHtml += '</select>';
        break;

      case "toggle":
        var checked = (parms.value=="true") ? "checked" : "";
        var toggleClass = (parms.toggleClass) ? parms.toggleClass : '';
        optionHtml += '<div class="hasWrapper"><div class="make-switch switch-square '+ toggleClass +'" id="'+parms.name+'" data-isAnOption="yes"><input type="checkbox" '+checked+'></div></div>';
        break;

      case "advancedToggle":
        break;

      case "html":
        optionHtml += parms.html;
        break;
    }

    if (parms.hasOwnProperty("after") && parms.after != "") {
      optionHtml += ' ' + parms.after;
    }

    if (parms.hasOwnProperty("info") && parms.info != "") {
      optionHtml += '<a href="#" class="tip-below tooltip" data-tip="' + parms.info + '">?</a>';
    }

    optionHtml += '</div>';
    return optionHtml;
  }

  this.getToggling = function (parms) {
    var checked = (parms.value=="true") ? "checked" : "";

    if (parms.value == "show") {
      checked = "checked";
    }

    var inverseToggle = parms.hasOwnProperty('inverseToggle') ? 'inverseToggle' : '';

    var hidden = false;
    hidden = hidden|| (parms.value == "hide");

    if (parms.hasOwnProperty('inverseToggle')) {
      hidden = hidden || (parms.value === "true");
    } else {
      hidden = hidden || (parms.value === "false");
    }

    hidden = (hidden) ? "display: none;" : "";
    var isIncluded = parms.hasOwnProperty('name') ? 'yes' : 'no';
    var boxId = (isIncluded) ? parms.name: "box-switch" ;

    var optionHtml = '<div class="switcher"><div class="item">';
      optionHtml += '<span class="label">' + parms.title + '</span>';
      optionHtml += '<div class="hasWrapper">';
      optionHtml += '<div class="make-switch switch-square hasCnt ' + inverseToggle + '" id="' + boxId + '" data-isAnOption="' + isIncluded + '">';
      optionHtml += '<input type="checkbox" ' + checked + '></div>';
      optionHtml += '</div>'

      if (parms.hasOwnProperty("info") && parms.info != "") {
        optionHtml += '<a href="#" class="tip-below tooltip" style="float:none; margin-left: 40px; vertical-align: top;" data-tip="' + parms.info + '">?</a>';
      }

      optionHtml += '</div>'

      optionHtml += '<div class="cnt" style="'+hidden+'" >';
      for (var i in parms.items) {
        optionHtml += parms.items[i];
      }
      optionHtml += '</div>'

    optionHtml += '</div>';

    return optionHtml;
  }

  this.getCurrencySelect = function (name, selectedCurr, append) {
    html = '<select id="' + name + '" name="' + name + '">';

    if (append) {
      append.forEach(function(curr) {
        var selected =(selectedCurr === curr.value) ? 'selected="selected"' : '';
        html += '<option value="' + curr.value + '" ' + selected + '>' + curr.name + '</option>';
      });
    }

    window.appSettings.currencies.forEach(function(curr) {
      var selected =(selectedCurr === curr.value) ? 'selected="selected"' : '';
      html += '<option value="' + curr.value + '" ' + selected + '>' + curr.name + '</option>';
    });

    html += '</select>';
    return html;
  }

  this.getListOfEmailTemplates = function () {
      var list ='<ul class="emailTemplateCodes">'
        list +='<a href="#">Show Keywords</a>'
        list += '<li><strong>%booking_QR_Code%:</strong><span>QR code with booking id:  *Requires the Check-in Addon.</span></li>';
        list += '<li><strong>%transactionID_QR_Code%:</strong><span>QR code with transaction id: *Requires the Check-in Addon</span></li>';

        list += '<li><strong>%bookingType%</strong></li>';

        list += '<li><strong>%payer_name%</strong></li>';
        list += '<li><strong>%payer_email%</strong></li>';
        list += '<li><strong>%quantity%</strong></li>';

        list += '<li><strong>%paymentID%</strong><span>Id used in plugin (ID column)</span></li>';
        list += '<li><strong>%paymentIDFormatted%:</strong><span>Payment id as 10 digits</span></li>';
        list += '<li><strong>%transaction_id%</strong><span>Paypal or other gateway transaction Id.</span></li>';
        list += '<li><strong>%paymentDate%</strong></li>';

        list += '<li><strong>%payment_amount%</strong></li>';
        list += '<li><strong>%payment_amount_taxed%</strong></li>';
        list += '<li><strong>%tax_amount%</strong></li>';
        list += '<li><strong>%tax_rate%</strong></li>';

        list += '<li><strong>%currency%</strong></li>';
        list += '<li><strong>%couponMarkUp%</strong></li>';

        list += '<li><strong>%ticketName%</strong></li>';
        list += '<li><strong>%ticketID%</strong></li>';


        list += '<li><strong>%eventname%</strong></li>';
        list += '<li><strong>%event_desc%</strong></li>';
        list += '<li><strong>%event_address%</strong></li>';
        list += '<li><strong>%eventid%:</strong> <span>Event Id as shown in admin panel</span></li>';
        list += '<li><strong>%eventid_formatted%:</strong><span>Event Id as 10 digits</span></li>';

        list += '<li><strong>%event_categories%:</strong><span>Lists all categories the event belongs too.</span></li>';


        list += '<li><strong>%start_time%</strong></li>';
        list += '<li><strong>%dateID%</strong></li>';
        list += '<li><strong>%startDate%</strong></li>';
        list += '<li><strong>%end_time%</strong></li>';
        list += '<li><strong>%endDate%</strong></li>';


        list += '<li><strong>For Form Manager addon users:</strong>:</li>';
        list += '<li><strong>%allExtraFields%</strong><span>Displays all extra fields</span></li>';
        list += '<li><strong> %inputName%</strong><span>example: %color%</span></li>';
      list += '</ul>'

      return list;
  }

  this.generateSelectField= function (name, options, selectedItem) {
      var option;
      var selected;

      var selectHtml = '<select name="' + name + '" id="' + name + '">';

      for (var i = 0; i < options.length; i++) {
        option = options[i];

        selected = (option.id == selectedItem) ? 'selected="selected"' : '';

        selectHtml += '<option value="' + option.id + '" ' + selected + '>' + option.name.replace(/\\/g, '') + "</option>";
      }

      selectHtml += '</select>';

      return selectHtml;
  }

  /**
    Settings section functions
  */
  this.getSettingsTabSection = function (type, data) {
    html = '<div class="optionsCnt">';
      if (type === "TEXTS") {
        html += this.getTextsSettingsSection(data);
      } else if (type === "SOCIAL") {
        html += this.getSocialSettingsSection(data);
      } else if (type == 'CSS') {
        html += this.getCSSSettingsSection(data);
      } else if (type == 'MAPS') {
        html += this.getMapsSettingsSection(data);
      } else if (type === 'EMAIL_RULES') {
        html += this.getEmailRulesSettingsSection(data);
      } else if (type === 'EVENT_LIST') {
        html += this.getEmailListSettingsSection(data);
      } else if (type === 'EVENT_SLIDER') {
        html += this.getEventSliderSettingsSection(data);
      } else if (type === 'DAY_CALENDAR') {
        html += this.getDayCalendarSettingsSection(data);
      } else if (type === 'EMAIL') {
        html += this.getEmailSettingsSection(data);
      } else if (type === 'BOOKING') {
        html += this.getBookingSettingsSection(data);
      } else if (type === 'PAYPAL') {
        html +=  this.getPayPalSettingsSection(data);
      } else if (type === 'BOOKING_FORM' ) {
        html += this.getBookingFormSettingsSection(data);
      } else if (type === 'UTILS') {
        html += this.getUtilsSettingSection(data);
      } else if (type === 'EVENT_CARD') {
        html += this.getEventCardSettingsSection(data);
      } else if (type === "CALENDAR") {
        html += this.getCalendarSettingsSection(data);
      } else if (type === 'EVENT_BOX'){
        html += this.getEventBoxSettingsSection(data);
      }
    html += '</div>';

    return html;
  }

  this.getTextsSettingsSection = function(data) {
    console.log(data);
    var html = '';

    function languageFound(records, code) {
      var found = false;
      records.forEach(function (record) {
        if (record.language === code) {
          found = true;
          return;
        }
      });

      return found;
    }

    function addLanguage(records, code, name, image) {
      var img = (image != "") ? '<img src="' + image + '" />   ' : '';
      var btnClass = languageFound(records, code) ? 'btn-primary' : 'btn-danger';
      return '<a href="#" class="btn btn-auto ' + btnClass + '" data-language="' + code + '">' + img + name + '</a>';
    };

    if (data.hasWPML) {
      html += '<div class="alert alert-info"><ul>';
      html +='<li>Languages are retrieved from WPML</li>';
      html +='<li>Languages that are in <em style="color:red;">red</em> are missing. The plugin will default to the texts set in "Default".</li>';
      html += '</ul></div>';

    } else {
      html += '<div class="alert alert-info"><a target="_blank" href="https://wpml.org/?aid=188354&affiliate_key=XbqJjGvkzAh5">You need WPML for multilingual translations.</a></div>';
    }

    html += '<div style="overflow: hidden; margin-bottom:10px;" class="EbpLanguageBtns">';
      html += addLanguage(data.records, 'default', 'Default', "");

      for (var property in data.languages) {
        if (data.languages.hasOwnProperty(property)) {
          var language = data.languages[property];
          html += addLanguage(data.records, language.code, language.native_name, language.country_flag_url);
        }
      }
    html += '</div>';


    html += '<div id="texts_settings_cnt">Select a language from the list above to translate.</div>';

    return html;
  }

  this.getLanguageSettingsSection = function (data) {
    console.log(data);
    var language = data.language;
    var html = '';

    if (language !== 'default') {
      html += '<a href="#" class="btn btn-primary EbpRestoreLangaugeToDefault" data-language="' + language + '">Copy translations from "Default" (saves it too)</a>';
    }

    html += '<input type="hidden" value="' + language + '" name="languageCode" />';


    html += '<h3 id="general">General</h3>';

    html += this.doOption({name: "btnTxt", value: data.btnTxt, type: "input", title: "Booking Page Button:",
            info: "Text of the button that will open the booking page"});


    html += this.doOption({name: "bookedTxt", value: data.bookedTxt, type: "input",
            title: "All booked text:",
            info: "Text shown when the event is fully sold out/booked."});


    html += this.doOption({name: "passedTxt", value: data.passedTxt, type: "input",
            title: "Passed Event text:",
            info: "Text shown when the event passes."});

    html += this.doOption({name: "bookingStartsTxts", value: data.bookingStartsTxts, type: "input",
            title: '"Booking havent started" text:',
            info: "Use %date% to add the starting date and %time% to add the starting time."});

    html += this.doOption({name: "bookingEndedTxt", value: data.bookingEndedTxt, type: "input",
            title: '"Booking ended" text:'
          });

    html += this.doOption({name: "statsOnTxt", value: data.statsOnTxt, type: "input",
            title: "Starts On text:"});

    html += this.doOption({name: "endsOnTxt", value: data.endsOnTxt, type: "input",
            title: "Ends On text:"});


    html += this.doOption({name: "freeTxt", value: data.freeTxt, type: "input",
            title: "Text to show when price is zero:"});

    html += this.doOption({name: "spotsLeftTxt", value: data.spotsLeftTxt, type: "input",
            title: "Spots Left text:"});

    html += this.doOption({name: "eventCancelledTxt", value: data.eventCancelledTxt, type: "input", title: "Event canceled text:"});

    html += this.doOption({name: "infoExpandText", value: data.infoExpandText, type: "input",
          title: "Description expand text:"});




    html += '<h3 id="eventCard">Event Card specific:</h3>';
    html += this.doOption({name: "eventDescriptionTitle", value: data.eventDescriptionTitle, type: "input",
            title: "Event Description title (Cards): "});
       html += this.doOption({name: "closeTextTxt", value: data.closeTextTxt, type: "input",
            title: "Unexpand Card:"});

    html += this.doOption({name: "ExpandTextTxt", value: data.ExpandTextTxt, type: "input",
            title: "Expand Card:"});



    html += '<h3 id="calendar">Calendar:</h3>';

    html += this.doOption({name: 'cal_weeks', value: data.cal_weeks,
          type: 'textarea', title: 'Day names:', info: 'comma separated list. Keep order'});

    html += this.doOption({name: 'cal_weekabbrs', value: data.cal_weekabbrs,
          type: 'textarea', title: 'Day names abbreviations:', info: 'comma separated list. Keep order'});

    html += this.doOption({name: 'cal_months', value: data.cal_months,
          type: 'textarea', title: 'Month names:', info: 'comma separated list. Keep order'});

    html += this.doOption({name: 'cal_monthabbrs', value: data.cal_monthabbrs,
          type: 'textarea', title: 'Month names abbreviations:', info: 'comma separated list. Keep order'});


    html += '<h3 id="eventList">Event List</h3>';

    html += this.doOption({name: "NoEventsInList", value: data.NoEventsInList, type: "input",
            title: "EventsList Shortcode: No events text: "});

    html += this.doOption({name: 'eventsListFilterLable', value: data.eventsListFilterLable, type: 'input', title: 'Text before filters (Event list):'});



    html += '<h3 id="bookingPage">Booking Page</h3>';



    html += this.doOption({name: "modalSpotsLeftTxt", value: data.modalSpotsLeftTxt, type: "input",
            title: "Spots Left text:"});

    html += this.doOption({name: "modalQuantityTxt", value: data.modalQuantityTxt, type: "input",
            title: "Quantity text:"});

    html += this.doOption({name: "modalSingleCostTxt", value: data.modalSingleCostTxt, type: "input",
            title: "Singe price text:"});

    html += this.doOption({name: "modalTotalCostTxt", value: data.modalTotalCostTxt, type: "input",
            title: "Total price text:"});

    html += this.doOption({name: "couponTxt", value: data.couponTxt, type: "input",
            title: "Coupon placeholder text:"});

    html += this.doOption({name: "applyTxt", value: data.applyTxt, type: "input",
            title: "Coupon Submit Button:"});

    html += '<br/>';

    html += this.doOption({name: "modalNameTxt", value: data.modalNameTxt, type: "input", title: "Initial Name Text:"});

    html += this.doOption({name: "modalEmailTxt", value: data.modalEmailTxt, type: "input", title: "Initial Email Text:"});
    html += this.doOption({name: "modalPhoneTxt", value: data.modalPhoneTxt, type: "input", title: "Initial Phone Text:"});

    html += this.doOption({name: "modalAddressTxt", value: data.modalAddressTxt, type: "input", title: "Initial Address Text:"});


    html += this.doOption({name: "bookingLimitText", value: data.bookingLimitText, type: "input",
      title: "Limit Error message (per quantity):",
      info: "Use %left% to include the quantity of tickets left."});

    html += this.doOption({name: "bookingLimitTimeText", value: data.bookingLimitTimeText, type: "input",
      title: "Limit Error message (per booking):",
      info: "Use %left% to include the number of bookings left."});

    html += this.doOption({name: "duplicateOnQuantityText", value: data.duplicateOnQuantityText, type: "input",
      title: "Duplicate fields title:",
      info: "Use %x% to display ticket number. Use %name% to display name of sub-ticket. use %name_group% for complex expressions. Ex: '%name_group% - (%name%)%name_group%' will display ' - (name)' when possible and will remove it all when not."});


    html += this.doOption({name: "modalBookText", value: data.modalBookText, type: "input",
            title: "Offline Booking Button:",
            info: "Text of the offline booking  button shown in the popup."});

    html += this.doOption({name: "paypalBtnTxt", value: data.paypalBtnTxt, type: "input",
            title: "PayPal Booking Button:",info: "Text of the paypal button shown in the popup."});


    html += this.doOption({name: "doAfterSuccessTitle", value: data.doAfterSuccessTitle,
            type: "input", title: "Success Popup title: "});

    html += this.doOption({name: "doAfterSuccessMessage", value: data.doAfterSuccessMessage,
            type: "textarea", title: "Success Popup Message:"});

    html += this.doOption({name: "eventBookedTxt", value: data.eventBookedTxt, type: "input",
            title: "Message to show below button"});

    html += this.doOption({name: "bookingTxt", value: data.bookingTxt, type: "input",
            title: "Booking loader text:"});


    html += this.doOption({name: "bookingFormErrosTxt", value: data.bookingFormErrosTxt, type: "input",
            title: "Form validation error text:"});

    html += '<h3 id="couponsSettings">Coupons</h3>';
    html += this.doOption({name: 'coupon_expired_msg', value: data.coupon_expired_msg, type: 'input', title: 'Coupon expired text:'});
    html += this.doOption({name: 'coupon_not_found_msg', value: data.coupon_not_found_msg, type: 'input', title: 'Coupon not found text:'});
    html += this.doOption({name: 'coupon_msg', value: data.coupon_msg, type: 'input', title: 'Coupon found text:', 'info': 'Supports %name% and %amount% to. Example: %name$- Discount of %amount%'});


    html += '<h3 id="occurrences">More occurrences:</h3>';

    html += this.doOption({name: "moreDateTxt", value: data.moreDateTxt, type: "input",
            title: '"More Date" button text:'});

    html += this.doOption({name: "passedOccurencesText", value: data.passedOccurencesText, type: "input",
            title: 'Passed occurrences section title:'});

    html += this.doOption({name: "upcomingOccurencesText", value: data.upcomingOccurencesText, type: "input",
            title: 'Upcoming occurrences section title:'});


    html += '<h3 id="social">Share to calendar:</h3>';
    html += this.doOption({name: "addToCalendarText", value: data.addToCalendarText, type: "input", title: "Google Calendar button text:"});
    html += this.doOption({name: "icsCalendarTxt", value: data.icsCalendarTxt, type: "input", title: "ICS Calendar button text:"});


    return html;
  }

  this.getSocialSettingsSection = function (data) {
    html = '<h3 id="social">Sharable Options:</h3>';
    html += '<h3 id="calendars">Calendar Options:</h3>';

    html += this.doOption({name: "addToCalendar", value: data.addToCalendar, type: "toggle", title: "Google calendar:"});
    html += this.doOption({name: "icsCalendar", value: data.icsCalendar, type: "toggle", title: "ICS calendar:"});


    html += '<h3 id="appearance">Appearance</h3>';
    html += this.doOption({name: "addToCalendarTextColor", value: data.addToCalendarTextColor, defaultValue: "#ADADAD", type: "color", title: "Text Color:"});
    html += this.doOption({name: "addToCalendarTextHoverColor", value: data.addToCalendarTextHoverColor, defaultValue: "#CCC", type: "color", title: "Text Hover Color:"});


    html += this.doOption({name: "addToCalendarTextFontSize", value: data.addToCalendarTextFontSize, type: "number", min: 0, title: "Text font size:", after:"px"});

    html += this.doOption({name: "addToCalendarTextFontStyle", value: data.addToCalendarTextFontStyle,
              type: "select", title: "Font style:",
              values: ["normal","italic","bold","100","300","500","700"],
              options: ["Normal","Italic","Bold","100","300","500","700"]});

    html += this.doOption({name: "addToCalendarMarginSide", value: data.addToCalendarMarginSide, type: "number", min: 0, title: "Margin Side:", after:"px"});
    html += this.doOption({name: "addToCalendarMarginBottom", value: data.addToCalendarMarginBottom, type: "number", min: 0, title: "Margin Bottom:", after:"px"});

    html += this.doOption({name: "addToCalendarAlign", value: data.addToCalendarAlign,
              type: "select", title: "Alignment:",
              values: ["left","right"],
              options: ["Left","Right"]});

              return html;
  }

  this.getCSSSettingsSection = function (data) {
    html = this.doOption({name: "useGeneratedCSS", value: data.useGeneratedCSS, type: "toggle",
              title: 'Use Generated CSS (beta)', info: 'The css will load faster.'});

    html += this.doOption({name: "customCSS", value: data.customCSS.replace(/\\/g, ''),
                    type: "textarea", title: "Custom CSS:"});


    return html;
  }

  this.getMapsSettingsSection = function (data) {
    html = this.doOption({name: "googleMapsEnabled", value: data.googleMapsEnabled, type: "toggle",
              title: 'Enable Google maps'});

    html += this.doOption({name: "googleMapsLoadLib", value: data.googleMapsLoadLib, type: "toggle",
      title: 'Load Google maps lib',  info: 'Turn this off if you want to force the plugin not to load google maps js library in the frontend'});


    html += this.doOption({name: "googleMapsAPIKey", value: data.googleMapsAPIKey, type: "input",
      title: 'API key', after: '<em>Optional. <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">Get key</a></em>', info: 'Add this if you can not see google maps on your website.'});



    return html;
  }

  this.getEmailRulesSettingsSection = function (data) {
    html = this.doOption({type: "toggle", name: "emailRulesEnabled", value: data.emailRulesEnabled,
              title:'',before: '<p class="settingTitle">Enable email rules</p>', after: '<p>If you do not plan to have email rules then keep this off. Better overall performance. <br/><br/>When this is turned off all due rules are skipped.</p><div class="sep"></div>'});

    html += this.doOption({name: "emailBookingCanceled", value: data.emailBookingCanceled, type: "toggle",
      title: '', before: '<p class="settingTitle">Send email when booking is canceled/deleted</p>'});


    var emailTemplates = data.emailTemplates;

    html += this.doOption({type: "html",
      title: 'Email Template', html: this.generateSelectField("emailBookingCanceledTemplate", emailTemplates, data.emailBookingCanceledTemplate), after: '<div class="sep"></div>'});

    html += this.doOption({name: "emailOccurenceDeleted", value: data.emailOccurenceDeleted, type: "toggle",
      title: '', before: '<p class="settingTitle">Send email when occurrence is deleted</p>'});

    html += this.doOption({type: "html",
      title: 'Email Template', html: this.generateSelectField("emailOccurenceCanceledTemplate", emailTemplates, data.emailOccurenceCanceledTemplate), after: '<div class="sep"></div>'});

    html += this.doOption({name: "emailEventCanceled", value: data.emailEventCanceled, type: "toggle",
      title: '', before: '<p class="settingTitle">Send email when event is canceled</p>'});

    html += this.doOption({type: "html",
      title: 'Email Template', html: this.generateSelectField("emailEventCanceledTemplate", emailTemplates, data.emailEventCanceledTemplate), after: '<div class="sep"></div>'});


    html += this.doOption({name: "emailRule_afterForCameOnly", value: data.emailRule_afterForCameOnly, type: "toggle",
      title: '', before: '<p class="settingTitle">"After email rules" apply only for checked-in</p><div style="margin-bottom:10px">Only activate this if you are using the <strong>Check-In addon</strong> and you wish to send "after" emails only to those that came (where marked as checked in).</div>', after: '<div class="sep"></div>'});

    html += this.doOption({name: "emailRule_validStatus", value: data.emailRule_validStatus, type: "input-large",
      title: '', before: '<p class="settingTitle">Valid statuses</p><div style="margin-bottom:10px">Email rules only apply to bookings with the following statuses:</div>', after: '<div style="margin-top:10px">Add new ones only if you are editing booking statuses manually or if you are using custom payment gateways. <em>Use lower case only!</em><br/><br/>Note: <em class="tag">Paid</em> and <em class="tag">Not paid</em> are for offline booking.<br/>Paypal payments are first marked as <em class="tag">pending</em>, when a change happens paypal notifies the plugin with the new status (<em class="tag">completed</em>, <em class="tag">canceled</em>, <em class="tag">refunded</em>...)</div><div class="sep"></div>'});



    return html;
  }

  this.getEmailListSettingsSection = function (data) {
    html = '<h3 id="">Filters</h3>';

    html += this.doOption({name: "eventsListFilterColor", value: data.eventsListFilterColor, defaultValue: "#1abc9c",
      type: "color", title: "Button color:"});

    html += this.doOption({name: "eventsListFilterTextColor", value: data.eventsListFilterTextColor, defaultValue: "#1abc9c",
      type: "color", title: "Button text color:"});

    html += this.doOption({name: "eventsListFilterBorderRadius", value: data.eventsListFilterBorderRadius,
            type: "number", min: 0, title: "Button border radius:", after: "px",
            info: "Radius of the border (0) for perfect square."});

    html += this.doOption({name: "eventsListFilterFontSize", value: data.eventsListFilterFontSize,
      type: "number", min: 0,
      title: "Font size:", after:"px"});

    html += this.doOption({name: "eventsListFilterPaddingSides", value: data.eventsListFilterPaddingSides,
      type: "number", min: 0,
      title: "Side padding:", after:"px"});

    html += this.doOption({name: "eventsListFilterPaddingVertical", value: data.eventsListFilterPaddingVertical,
      type: "number", min: 0,
      title: "Vertical padding:", after:"px"});


    html += '<em style="margin-top:10px">Setting to change text before filter was moved to "Texts" section</em>';

    return html;
  }

  this.getEventSliderSettingsSection = function (data) {
    html = '<h3 id="generalSettings">General:</h3>';

    html += this.doOption({name: "slider_main_color", value: data.slider_main_color, defaultValue: "#2ECC71",
            type: "color", title: "Main color:"});


    html += this.doOption({name: "slider_width", value: data.slider_width,
      type: "number", min: 0,
      title: "Slider default width:", after:"px"});


    html += this.doOption({name: "slider_height", value: data.slider_height,
      type: "number", min: 0,
      title: "Slider default height:", after:"px"});


    html += this.doOption({name: "slider_vertical_padding", value: data.slider_vertical_padding,
      type: "number", min: 0,
      title: "Slide content vertical padding:", after:"px"});

    html += this.doOption({name: "slider_side_padding", value: data.slider_side_padding,
      type: "number", min: 0,
      title: "Slide content side padding:", after:"px"});


    html += '<h3 id="thumbnailSettings">Thumbnail:</h3>';
    html += this.doOption({name: "slider_thumb_width", value: data.slider_thumb_width,
      type: "number", min: 0, max: 100,
      title: "Thumbnail width:", after:"%"});


    html += this.doOption({name: "slider_thumb_height", value: data.slider_thumb_height,
      type: "number", min: 0, max: 100,
      title: "Thumbnail height:", after:"%"});

    return html;
  }

  this.getDayCalendarSettingsSection = function (data) {
    html = this.doOption({name: "dayCal_bgColor", value: data.dayCal_bgColor, defaultValue: "#F4F4F4",
                    type: "color", title: "Nav Background color:"});

    html += this.doOption({name: "dayCal_mainColor", value: data.dayCal_mainColor, defaultValue: "#2ECC71",
            type: "color", title: "Main color:"});

    html += this.doOption({name: "dayCal_subColor", value: data.dayCal_subColor, defaultValue: "#CCCCCC",
            type: "color", title: "Secondary color:"});

    html += this.doOption({name: "dayCal_monthColor", value: data.dayCal_monthColor, defaultValue: "#495468",
            type: "color", title: "Month color:"});

    html += this.doOption({name: "dayCal_daysColor", value: data.dayCal_daysColor, defaultValue: "#919191",
            type: "color", title: "Days color:"});


    html += this.doOption({name: "dayCal_bordersOff", value: data.dayCal_bordersOff, type: "toggle", title: "List Navigator Borders:"});


    html += this.doOption({name: "dayCal_borderColor", value: data.dayCal_borderColor, defaultValue: "#dddddd",
            type: "color", title: "Nav Border color:"});

    return html;
  }

  this.getEmailSettingsSection = function (data) {
    html = '<h3 id="emailSettings">Email Configuration</h3>';

    html += '<p style="font-style:italic;"><a  href="http://iplusstd.com/item/eventBookingPro/example/email-configuration-help/" target="_blank">Popular configurations and steps to follow when having problems.</a></p>';

    html += this.doOption({name: 'email_mode', value: data.email_mode, type: 'select', title: 'EMAIL MODE:',
      values: ['3', '1', '4'], options: ['SMTP', 'MAIL', 'WP Mail']});

     html += this.doOption({name: "email_utf8", value: data.email_utf8, type: "toggle",
      title: "UTF-8:", info: "Use UTF-8 as the email's encoding"});
    html += this.doOption({name: 'SMTP_EMAIL', value: data.SMTP_EMAIL, type: 'input', title: 'Email Address:'});

    html += '<div style="padding: 1px 20px 20px; margin-bottom:20px; background:#F1F1F1;"><h4>Not needed in case of "WP MAIL" mode:</h4>';

    html += this.doOption({name: 'SMTP_PASS', value: data.SMTP_PASS, type: 'password', title: 'Email Password:'});

    html += this.doOption({name: 'SMTP_HOST', value: data.SMTP_HOST, type: 'input', title: 'SMPT HOST:'});

    html += this.doOption({name: 'SMTP_PORT', value: data.SMTP_PORT, type: 'number', title: 'SMPT PORT:'});

    html += this.doOption({name: 'emailSSL', value: data.emailSSL, type: 'select', title: 'Encryption:',
      values: ['false','ssl','tls'], options: ['None','SSL','TLS']});

    html += '</div>';

    html += '<a href="#" class="testEmail btn btn-primary">Send Test Email</a>';
    html += '<p id="testEmailDiv"></p>';

    html += '<h3 id="emailSettings">Email Settings:</h3>';

    html += this.doOption({name: "SMTP_NAME", value: data.SMTP_NAME, type: "input", title: "Sender name: "});

    html += this.doOption({name: "emailSubject", value: data.emailSubject, type: "input-large", title: "Email Subject:",
      after: '<div style="margin-left:20px;">You can include keywords in subject.</div>' + this.getListOfEmailTemplates()});


    html += this.doOption({name: "sendEmailToCustomer", value: data.sendEmailToCustomer, type: "toggle",
      title: "Customer email:", info: "When enabled the customer will receive a confirmation email (customize below)"});

    html += this.doOption({name: "sendEmailToAdmin", value: data.sendEmailToAdmin, type: "toggle",
      title: "Admin email:", info: "When enabled the admin will receive an email (customize below)"});


    html += '<h3 id="emailTemplateDiv">on Success: Customer Email Template</h3>';

    html += '<textarea class="emailTemplate" id="emailTemplate" name="emailTemplate" >'+data.emailTemplate.replace(/\\/g, '')+'</textarea>';
    html += '<a href="#" class="loadDefaultTemplate">Load Default Template</a>';
    html += '<p><strong>You can use the keywords in your email templates.</strong> They will be replaced with their corresponding values.</ul>';

    html += this.getListOfEmailTemplates();


    html += '<h3 id="OwnerEmailTemplateDiv">on Success: Admin Email Template</h3>';

    html += '<textarea class="emailTemplate" id="ownerEmailTemplate" name="ownerEmailTemplate" >'+data.ownerEmailTemplate.replace(/\\/g, '')+'</textarea>';
    html += '<a href="#" class="loadDefaultOwnerTemplate">Load Default Template</a>';
    html += '<p><strong>You can use the keywords in your email templates.</strong> They will be replaced with their corresponding values.</ul>';

    html += this.getListOfEmailTemplates();




    html += '<h3 id="refundemailTemplateDiv">Refund Email:</h3>';
    html += this.doOption({name: "refundEmailSubject", value: data.refundEmailSubject, type: "input-large", title: "Refund Email Subject:",
      after: '<div style="margin-left:20px;">You can include keywords in subject.</div>' + this.getListOfEmailTemplates()});

    html += '<h3>on Refund: Buyer Email Template</h3>';

    html += '<textarea class="emailTemplate" id="refundEmailTemplate" name="refundEmailTemplate" >'+data.refundEmailTemplate.replace(/\\/g, '')+'</textarea>';
    html += '<p><strong>You can use the keywords in your email templates.</strong> They will be replaced with their corresponding values</ul>';

    html += this.getListOfEmailTemplates();


    html += '<h3 id="refundOwneremailTemplateDiv">on Refund: Admin Email Template</h3>';

    html += '<textarea class="emailTemplate" id="refundOwnerEmailTemplate" name="refundOwnerEmailTemplate" >'+data.refundOwnerEmailTemplate.replace(/\\/g, '')+'</textarea>';
    html += '<p><strong>You can use the keywords in your email templates.</strong> They will be replaced with their corresponding values</ul>';

    html += this.getListOfEmailTemplates();



    return html;
  }

  this.getBookingSettingsSection = function (data) {
    html = '<h3 id="priceSettings">Price Settings</h3>';


    html += '<div class="item">';
    html += '<span class="label" >Currency:</span>';
    html += this.getCurrencySelect("currency", data.currency);
    html += '</div>';


    html += this.doOption({name: "currencyBefore", value: data.currencyBefore, type: "toggle", title: "Currency Before Price:"});

    html += this.doOption({name: "priceDecimalCount", value: data.priceDecimalCount, type: "number", min: 0, max:5, title: "Decimals:", info: "Number of decimal numbers."});

    html += this.doOption({name: "priceDecPoint", value: data.priceDecPoint, type: "input", maxlength:"1", title: "Decimal point:"});

    html += this.doOption({name: "priceThousandsSep", value: data.priceThousandsSep, type: "input", maxlength:"1", title: "Thousand Seperator: "});

    html += '<h3 id="taxSettings">Tax</h3>';
    html += this.doOption({name: "tax_rate", value: data.tax_rate, type: "number", min: 0, max: 100, title: "Tax rate:"});
    html += this.doOption({name: "showTaxInBookingForm", value: data.showTaxInBookingForm, type: "toggle", title: "Show tax column in booking form:"});


    html += '<h3 id="bookingSettings">Booking Settings</h3>';

    html += this.getToggling({title: 'Count only successful bookings:',
              value: data.spotsLeftStrict,
              name: "spotsLeftStrict",

              items: [
                  this.doOption({name: "statusesCountedAsCompleted", value: data.statusesCountedAsCompleted,
                      type: "input", title: "statuses counted as completed:",
                      info: "Separate by comma, for offline payments you have 'not paid' and 'paid'. Default: paid, not paid, ok, completed, successful, success"})
                  ]});



    html += this.doOption({name: "couponsEnabled", value: data.couponsEnabled,
              type: "toggle", title: "Enable Coupons:"});


    html += this.doOption({name: "multipleBookings", value: data.multipleBookings,
              type: "toggle", title: "Multiple Booking:"});

    html += this.getToggling({title: 'Limit bookings per email (quantity-wise):',
              value: data.limitBookingPerEmail,
              name: "limitBookingPerEmail",
              info: "This will limit quantity allowed",
              items: [
                  this.doOption({name: "limitBookingPerEmailCount", value: data.limitBookingPerEmailCount,
                      type: "number", title: "Limit:"})
                  ]});


    html += this.getToggling({title: 'Limit bookings per booking (booking-wise):',
              value: data.limitBookingPerTime,
              name: "limitBookingPerTime",
              info: "This means that the user can only book X times disregarding quantity.",

              items: [
                  this.doOption({name: "limitBookingPerTimeCount", value: data.limitBookingPerTimeCount,
                      type: "number", title: "Limit:"})
                  ]});


    html += this.getToggling({title: 'Return to same page after paypal payment',
              value: data.return_same_page,
              name: "return_same_page",
              inverseToggle: "true",
              items: [
                  this.doOption({name: "return_page_url", value: data.return_page_url,
                      type: "input", title: "Page URL:"})
                  ]});

    return html;
  }

  this.getPayPalSettingsSection = function (data) {
    html = '<h3 id="paymentSettings">PayPal Settings</h3>';

    html += this.doOption({name: "paypalAccount", value: data.paypalAccount, type: "input", title: "PayPal Account:", info: "Your paypal account. A standard account is needed."});


    html += this.doOption({name: "sandbox", value: data.sandbox,
              type: "toggle", title: "Payment Sandbox:"});

    html += this.doOption({name: "force_ssl_v3", value: data.force_ssl_v3,
              type: "toggle", title: "SSL v3:",
              info :'Recommended On. Turn off in case your server doest support cURL SSL v3'});

    html += '<div class="item">';



    html += '<span class="upload"><span class="label">Header Image (750x90):</span>';
      html += '<input type="hidden" class="regular-text text-upload" name="cpp_header_image" value="'+data.cpp_header_image+'"/>';
      html += '<a href="#" class="btn btn-primary button-upload">Add/Change</a>';
      html += '<a href="#" class="removeImg" style="margin-left:10px;">x</a>';
      html += '<img  src="'+data.cpp_header_image+'" class="preview-upload"/>';
    html += "</span></div>";


    html += this.doOption({name: "cpp_headerback_color", value: data.cpp_headerback_color, defaultValue: "#FFF", type: "color", title: "Header bg color:"});

    html += this.doOption({name: "cpp_headerborder_color", value: data.cpp_headerborder_color, defaultValue: "#EEE", type: "color", title: "Header border color:"});


    html += '<div class="item">';
    html += '<span class="upload"><span class="label">Logo (190x60):</span>';
      html += '<input type="hidden" class="regular-text text-upload" name="cpp_logo_image" value="'+data.cpp_logo_image+'"/>';
      html += '<a href="#" class="btn btn-primary button-upload">Add/Change</a>';
      html += '<a href="#" class="removeImg" style="margin-left:10px;">x</a>';
      html += '<img  src="'+data.cpp_logo_image+'" class="preview-upload"/>';

    html += "</span></div>";

    html += this.doOption({name: "cpp_payflow_color", value: data.cpp_payflow_color, defaultValue: "#FFF", type: "color", title: "Body bg color:"})



    return html;
  }

  this.getBookingFormSettingsSection = function (data) {

    html = '<h3 id="modalGeneralSettings">General Settings</h3>';


    html += this.doOption({name: "mobileSeperatePage", value: data.mobileSeperatePage,
              type: "toggle", title: "Open booking form as a separate page on mobile:"});


    html += this.doOption({name: "modalOverlayColor", value: data.modalOverlayColor, defaultValue: "#2ECC71", type: "color",
      title: "Overlay Color:", info: "This is the color that will surround the popup  box."});

    html += this.doOption({name: "popupOverlayAlpha", value: data.popupOverlayAlpha, type: "number", min: 0, max:100,
      title: "Overlay opacity:", after:"(0-100)", info: "This is the opacity of color that will surround the popup  box."});

    html += this.doOption({name: "modalMainColor", value: data.modalMainColor, defaultValue: "#2ECC71", type: "color",
      title: "Pop up inner box background Color:", info: "This is the color of the pop up box."});

    html += this.doOption({name: "bookingFormBoxRadius", value: data.bookingFormBoxRadius, type: "number", min: 0,
      title: "Pop up inner box radius:"
    });

    html += this.doOption({name: "requirePhone", value: data.requirePhone,
              type: "toggle", title: "Require Phone Number:"});

    html += this.doOption({name: "requireAddress", value: data.requireAddress,
              type: "toggle", title: "Require Address:"});

    html += this.doOption({name: "modal_includeTime", value: data.modal_includeTime,
              type: "toggle", title: "Include time in booking page:"});

    html += this.doOption({name: "ticketsOrder", value: data.ticketsOrder, type: "select",
            title: "Ticket list order:",  values: ["1", "2", "3", "4", "5"],
            options: ["Default Order", "Ticket Name Ascending", "Ticket Name Descending", "Price Ascending", "Price Descending"]});


    html += this.doOption({name: "bookingFormTicketCntShowPrice", value: data.bookingFormTicketCntShowPrice,
              type: "toggle", title: "Show price beside ticket name:"});

    html += '<h3 id="successSettings">Success (After booking) Settings</h3>';

    html += this.doOption({name: "doAfterSuccess", value: data.doAfterSuccess, type: "select",
            title: "Action:",
            values: ["popup","close","redirect","msg"],
            options: ["Open success popup","Close booking popup","Redirect to page","Show message below booking button"]});


    html += this.doOption({name: "doAfterSuccessRedirectURL", value: data.doAfterSuccessRedirectURL,
            type: "input", title: "Redirect Page URL:"});

    html += '<em>Text settings move to "Texts" tab';



    html += '<h3 id="modalTitleSettings">Title Settings</h3>';


    html += this.doOption({name: "modal_titleSize", value: data.modal_titleSize,
      type: "number", min: 0,
      title: "Title font size:", after:"px"});

    html += this.doOption({name: "modal_titleLineHeight", value: data.modal_titleLineHeight,
      type: "number", min: 0,
      title: "Title line height:", after:"px"});


    html += this.doOption({name: "modal_titleFontType", value: data.modal_titleFontType,
      type: "select", title: "Title font style:",
      values: ["normal","italic","bold","100","300","500","700"],
      options: ["Normal","Italic","Bold","100","300","500","700"]});

    html += this.doOption({name: "modal_titleMarginBottom", value: data.modal_titleMarginBottom,
      type: "number", min: 0,
      title: "Title Margin Bottom:"});


    html += '<h3 id="modalMainSettings">Content Settings</h3>';

    html += this.doOption({name: "modal_txtColor", value: data.modal_txtColor, defaultValue: "#FFF",
      type: "color", title: "text color:"});



    html += '<h3 id="modalInputs">Inputs Settings</h3>';


    html += this.doOption({name: "modal_input_txtColor", value: data.modal_input_txtColor, defaultValue: "#000", type: "color", title: "Text color:"});

    html += this.doOption({name: "modal_inputHover_txtColor", value: data.modal_inputHover_txtColor, defaultValue: "#333", type: "color", title: "Hover Text color:"});

    html += this.doOption({name: "modal_input_bgColor", value: data.modal_input_bgColor, defaultValue: "#FFF", type: "color", title: "Input background color:"});


    html += this.doOption({name: "modal_inputHover_bgColorHover", value: data.modal_inputHover_bgColorHover, defaultValue: "#FFF", type: "color", title: "Hover Input background color:"});


    html += this.doOption({name: "modal_input_bgColorAlpha", value: data.modal_input_bgColorAlpha, type: "number", min: 0, max: 100, title: "Input background Opacity:", after: "(0-100)"});

    html += this.doOption({name: "modal_inputHover_bgColorAlpha", value: data.modal_inputHover_bgColorAlpha, type: "number", min: 0, max: 100, title: "Hover Input background Opacity:", after: "(0-100)"});



    html += this.doOption({name: "modal_input_fontSize", value: data.modal_input_fontSize, type: "number", min: 0, title: "Font size:", after: "px"});

    html += this.doOption({name: "modal_input_lineHeight", value: data.modal_input_lineHeight, type: "number", min: 0, title: "Line height:", after: "px"});

    html += this.doOption({name: "modal_input_topPadding", value: data.modal_input_topPadding, type: "number", min: 0, title: "Top/Bottom Padding:", after: "px"});

    html += this.doOption({name: "modal_input_space", value: data.modal_input_space, type: "number", min: 0, title: "Space between:", after: "px"});



    html += '<h3 id="modalPhoneInput">Phone Number Input Settings</h3>';

    html += '<a target="_blank" href="http://iplusstd.com/item/eventBookingPro/example/phone-number-input/">Documentation</a>'
    html += this.doOption({name: "phoneInitialCountry", value: data.phoneInitialCountry, type: "input",
        title: "Initial country Code:"});

    html += this.doOption({name: "phoneOnlyCountries", value: data.phoneOnlyCountries, type: "textarea",
        title: "Allowed countries code:"});

    html += this.doOption({name: "phonePreferredCountries", value: data.phonePreferredCountries, type: "textarea",
            title: "Preferred country codes:"});



    html += '<h3 id="selectSettings">Dropdown (Select) Settings</h3>';


    html += this.getToggling({title: 'Label as first option:',
              value: data.modal_selectLabelAsNoneOption,
              name: "modal_selectLabelAsNoneOption",
              inverseToggle: "yes",
              items: [
                this.doOption({name: "modal_selectNoneOption", value: data.modal_selectNoneOption,
                  type: "input", title: "Text for first option:"})
              ]});


    html += this.doOption({name: "modal_selectHoverColor", value: data.modal_selectHoverColor, defaultValue: "#208F4F", type: "color", title: "Select Background Hover Color:"});

    html += this.doOption({name: "modal_selectTxtHoverColor", value: data.modal_selectTxtHoverColor, defaultValue: "#FFF", type: "color", title: "Select Text Hover Color:"});


    html += '<h3 id="checkSettings">Checkbox/Radio Settings</h3>';


    html += this.doOption({name: "checkBoxTextColor", value: data.checkBoxTextColor, defaultValue: "#EEE",
            type: "color", title: "Text Color:"});

    html += this.doOption({name: "checkBoxColor", value: data.checkBoxColor, defaultValue: "#111",
            type: "color", title: "Tick/Dot Color:"});

    html += this.doOption({name: "checkBoxMarginTop", value: data.checkBoxMarginTop,
            type: "number", min: 0, title: "Margin Top:", after: "px"});

    html += this.doOption({name: "checkBoxMarginBottom", value: data.checkBoxMarginBottom,
            type: "number", min: 0, title: "Margin Bottom:", after: "px"});



    html += '<h3 id="modalSettings">Button  Settings</h3>';



    html += this.doOption({name: "modal_btnTxtColor", value: data.modal_btnTxtColor, defaultValue: "#FFF",
            type: "color", title: "Button text color:"});

    html += this.doOption({name: "modal_btnFontSize", value: data.modal_btnFontSize,
            type: "number", min: 0, title: "Button font size:", after: "px"});

    html += this.doOption({name: "modal_btnLineHeight", value: data.modal_btnLineHeight,
            type: "number", min: 0, title: "Button line size:", after: "px"});


    html += this.doOption({name: "modal_btnFontType", value: data.modal_btnFontType, type: "select",
            title: "Button font style:",  values: ["normal","italic","bold","100","300","500","700"],
            options: ["Normal","Italic","Bold","100","300","500","700"]});

    html += this.doOption({name: "modal_btnTopPadding", value: data.modal_btnTopPadding,
            type: "number", min: 0, title: "Button top/bottom padding:", after: "px"});

    html += this.doOption({name: "modal_btnSidePadding", value: data.modal_btnSidePadding,
            type: "number", min: 0, title: "Button side padding:", after: "px",
            info: "Inside space left between button text and button borders"});


    html += this.doOption({name: "modal_btnMarginTop", value: data.modal_btnMarginTop,
            type: "number", min: 0, title: "Button top margin:", after: "px"});


    html += this.doOption({name: "modal_btnBorderRadius", value: data.modal_btnBorderRadius,
            type: "number", min :0, title: "Button side padding:", after: "px",
            info: "Radius of the border (0) for perfect square."});



    html += '<h3 id="modalDateSettings">Date Settings <small>Popup when you press more dates</small></h3>';

    html += '<h4>Section Title (Passed and Upcoming Text) formatting</h4>';


    html += this.doOption({name: "modal_dateTitleColor", value: data.modal_dateTitleColor, defaultValue: "#999",
              type: "color", title: "Color:"});

    html += this.doOption({name: "modal_dateTitleFontSize", value: data.modal_dateTitleFontSize,
              type: "number", min: 0, title: "Font size:", after: "px"});

    html += this.doOption({name: "modal_dateTitleFontLineHeight", value: data.modal_dateTitleFontLineHeight,
              type: "number", min: 0, title: "Line height:", after: "px"});


    html += this.doOption({name: "modal_dateTitleTextAlign", value: data.modal_dateTitleTextAlign,
            type: "select", title: "Text alignment:",
            values: ["left","center","right"],
            options: ["Left","Center","Right"]});



    html += this.doOption({name: "modal_dateTitleFontStyle", value: data.modal_dateTitleFontStyle,
            type: "select", title: "font style:",
            values: ["normal","italic","bold","100","300","500","700"],
            options: ["Normal","Italic","Bold","100","300","500","700"]});


    html += this.doOption({name: "modal_dateTitlePaddingSides", value: data.modal_dateTitlePaddingSides,
              type: "number", min: 0, title: "Padding sides:", after: "px"});

    html += this.doOption({name: "modal_dateTitleMarginBottom", value: data.modal_dateTitleMarginBottom,
              type: "number", min: 0, title: "Margin Bottom:", after: "px"});




    html += '<h4>Date and Time Formatting</h4>';


    html += this.doOption({name: "moreDateSectionMarginBottom", value: data.moreDateSectionMarginBottom,
              type: "number", min: 0, title: "Space between date occurences:", after: "px"});


    // html += this.doOption({name: "modal_dateColor", value: data.modal_dateColor, defaultValue: "#999",
            // type: "color", title: "Date Color:",
            // info: "Color of the modal_date and time"});


    html += this.doOption({name: "modal_dateFontSize", value: data.modal_dateFontSize,
              type: "number", min: 0, title: "Date font size:", after: "px"});


    html += this.doOption({name: "modal_dateTextAlign", value: data.modal_dateTextAlign,
          type: "select", title: "Text alignment:",
          values: ["left","center","right"],
          options: ["Left","Center","Right"]});

    html += this.doOption({name: "modal_dateFontStyle", value: data.modal_dateFontStyle,
          type: "select", title: "Title font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});

    // html += this.doOption({name: "modal_dateLableColor", value: data.modal_dateLableColor, defaultValue: "#666",
            // type: "color", title: "Button text color:",
            // info:'Color of labels such as "starts on" and "ends on"'});



    html += this.doOption({name: "modal_dateLableSize", value: data.modal_dateLableSize,
              type: "number", min: 0, title: "Date Label Font size:", after: "px"});

    html += this.doOption({name: "modal_dateLabelLineHeight", value: data.modal_dateLabelLineHeight,
              type: "number", min: 0, title: "Date Label Line height:", after: "px"});


    html += this.doOption({name: "modal_dateLabelStyle", value: data.modal_dateLabelStyle,
          type: "select", title: "Date Label font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});




    html += this.doOption({name: "modal_datePaddingSides", value: data.modal_datePaddingSides,
              type: "number", min: 0, title: "Date padding sides:", after: "px"});

    html += this.doOption({name: "modal_datePaddingTop", value: data.modal_datePaddingTop,
              type: "number", min: 0, title: "Date padding top:", after: "px"});

    html += this.doOption({name: "modal_datePaddingBottom", value: data.modal_datePaddingBottom,
              type: "number", min: 0, title: "Date padding bottom:", after: "px"});

    html += this.doOption({name: "modal_dateMarginTop", value: data.modal_dateMarginTop,
              type: "number", min: 0, title: "Date margin top:", after: "px"});

    html += this.doOption({name: "modal_dateMarginBottom", value: data.modal_dateMarginBottom,
              type: "number", min: 0, title: "Date margin bottom:", after: "px"});



    return html;
  }

  this.getUtilsSettingSection = function (data) {
    html = '<h3>Mobile Booking Page Fix</h3>';
    html += '<a class="btn btn-primary fixMobilePage" href="#">Press this ONCE if you the mobile booking page is not working!</a>';

    html += '<h3>Clean event occurrences (Fix)</h3>';
    html += "<p>This will remove all occurrences that shouldn't be there.</p>";
    html += '<a class="btn btn-primary fixOccurences" href="#">Press this ONCE to clean your event occurrences!</a>';


    html += '<h3>Database encoding</h3>';
    html += '<p>Change database EBP tables to UTF-8. Supports all international characters.</p>';
    html += '<a href="#" class="btn btn-primary setCollation">Set collation/encoding to UTF-8</a>';


    return html;
  }

  this.getEventCardSettingsSection = function (data) {
    html = '<h3 id="generalSettings">Event Card Settings</h3>';

    html += this.doOption({name: "boxWidth", value: data.boxWidth,
            type: "number", min: 0, title: "Event Card Width:", after: "px"});


    html += this.getToggling({title: 'Center Event Box:',
              value: data.boxAlign,
              name: "boxAlign",
              inverseToggle: "yes",
              items: [
                  this.doOption({name: "boxMarginSides", value: data.boxMarginSides,
                      type: "number", min: 0, title: "Card side margin:", after: "px"})
                  ]});



    html += this.doOption({name: "boxMarginTop", value: data.boxMarginTop,
            type: "number", min: 0, title: "Card top margin:", after: "px"});

    html += this.doOption({name: "boxMarginBottom", value: data.boxMarginBottom,
            type: "number", min: 0, title: "Card bottom margin:", after: "px"});


    html += this.doOption({name: "boxPaddingSides", value: data.boxPaddingSides,
            type: "number", min: 0, title: "Card  side padding:", after: "px"});

    html += this.doOption({name: "boxPaddingTop", value: data.boxPaddingTop,
            type: "number", min: 0, title: "Card top padding:", after: "px"});

    html += this.doOption({name: "boxPaddingBottom", value: data.boxPaddingBottom,
            type: "number", min: 0, title: "Card bottom padding:", after: "px"});

    html += this.getToggling({title: 'Box border:', value:(data.boxBorder=="0")?"hide":"show",
                    items: [
                        this.doOption({name: "boxBorder", value: data.boxBorder,
                            itemClass:"isBorder",
                            type: "number", min: 0, title: "border size:", after: "px"}),

                        this.doOption({name: "boxBorderColor", value: data.boxBorderColor,
                             defaultValue: "#F2F2F2", type: "color",
                             title: "border color:"})
                        ]});




    html += this.doOption({name: "boxBorderRadius", value: data.boxBorderRadius,
              type: "number", min: 0, title: "Box Border Radius:", after: "px",
              info: "Radius of the border (0) for perfect square."});

    html += '<h3 id="bgSettings">Background Settings</h3>';

    html += this.doOption({name: "eventCardImageAsBackground", value: data.eventCardImageAsBackground,
              type: "toggle", title: 'EventCard background image:'});

    html += this.doOption({name: "boxBgColor", value: data.boxBgColor, defaultValue: "#f9f9f9",
              type: "color", title: "Card background color:"});



    html += this.doOption({name: "card_bg_effect_color", value: data.card_bg_effect_color, defaultValue: "#000000",
              type: "color", title: "Card background effect color:", info: "The is added as an overlay above the background color of the card."});


    html += this.doOption({name: "card_bg_effect_alpha", value: data.card_bg_effect_alpha, type: "number", min: 0, max:100,
      title: "Effect opacity:", after:"(0-100)", info: "The is the opacity of the overlay above the background color of the card."});


    html += this.doOption({name: "card_bg_effect_alpha_hover", value: data.card_bg_effect_alpha_hover, type: "number", min: 0, max:100,
      title: "Effect hover opacity:", after:"(0-100)", info: "The is the opacity when hovering over  the overlay above the background color of the card."});




    html += this.doOption({name: "cardDescriptionBackColor", value: data.cardDescriptionBackColor, defaultValue: "#F1f1f1",
              type: "color", title: "Card Expandable Details background Color:"});


    html += '<h3 id="titleSettings">Title Settings</h3>';

    html += this.doOption({name: "titleColor", value: data.titleColor, defaultValue: "#495468",
              type: "color", title: "Title color:"});

      html += this.doOption({name: "titleFontSize", value: data.titleFontSize,
                type: "number", min: 0, title: "Title font size:", after: "px"});

    html += this.doOption({name: "titleMarginBottom", value: data.titleMarginBottom,
              type: "number", min: 0, title: "Title margin bottom:", after: "px"});

      html += this.doOption({name: "titleTextAlign", value: data.titleTextAlign,
            type: "select", title: "Tite text alignment:",
            values: ["left","center","right"],
            options: ["Left","Center","Right"]});

      html += this.doOption({name: "titleFontStyle", value: data.titleFontStyle,
            type: "select", title: "Title font style:",
            values: ["normal","italic","bold","100","300","500","700"],
            options: ["Normal","Italic","Bold","100","300","500","700"]});


    html += '<h3 id="imgSettings">Thumbnail Settings</h3>';

    html += this.doOption({name: "eventCardShowThumbnail", value: data.eventCardShowThumbnail,
              type: "toggle", title: 'Show thumbnail:'});

    html += this.doOption({name: "eventCardThumbnailWidth", value: data.eventCardThumbnailWidth,
        type: "input-mini", title: 'Thumbnail width (no expand):',
        after: 'px or %', info: 'percentage example: 20%, width example: 50'});

    html += this.doOption({name: "eventCardExpandThumbnailWidth", value: data.eventCardExpandThumbnailWidth,
        type: "input-mini", title: 'Thumbnail width (can expand):',
        after: 'px or %', info: 'percentage example: 20%, width example: 50'});



    html += this.doOption({name: "eventCardShowImage", value: data.eventCardShowImage,
              type: "toggle", title: 'Show full image (expand mode):'});
    html +=  this.getToggling({title: 'Crop Image:',
      value: data.imageCrop,
      name: "imageCrop",
      items: [
          this.doOption({name: "imageHeight", value: data.imageHeight,
              type: "number", min: 0, title: "Image maximum Height:", after: "px"})
          ]}) ;

    html += this.doOption({name: "imageMarginSides", value: data.imageMarginSides,
                type: "number", min: 0, title: "Image side margin:", after: "px"});

    html += this.doOption({name: "imageMarginTop", value: data.imageMarginTop,
                type: "number", min: 0, title: "Image top margin:", after: "px"});

    html += this.doOption({name: "imageMarginBottom", value: data.imageMarginBottom,
                type: "number", min: 0, title: "Image bottom margin:", after: "px"});


    html += '<h3 id="mapSettings">Map Settings</h3>';

    html += this.doOption({name: "mapHeight", value: data.mapHeight,
                type: "number", min: 0, title: "Map height:", after: "px"});


    html += '<h3 id="descSettings">Description Settings</h3>';


      html += this.doOption({name: "infoNoButton", value: data.infoNoButton,
                type: "toggle", title: 'Show Read More button:',
                info: "If actiavted then the description will have a read more button and only text equal to the  maximum height set below will be displayed.If deactivated then the description will be displayed all."});


    html += this.doOption({name: "infoMaxHeight", value: data.infoMaxHeight,
              type: "number", min: 0, title: "Maximum info height:", after: "px"});




    html += this.doOption({name: "infoTitleColor", value: data.infoTitleColor, defaultValue: "#111",
              type: "color", title: "Info Title Color:"});

    html += this.doOption({name: "infoTitleFontSize", value: data.infoTitleFontSize,
              type: "number", min: 0, title: "Info Title Font Size:", after: "px"});


    html += this.doOption({name: "infoColor", value: data.infoColor, defaultValue: "#111",
              type: "color", title: "Info Color:"});


    html += this.doOption({name: "infoFontSize", value: data.infoFontSize,
              type: "number", min: 0, title: "Info font size:", after: "px"});

    html += this.doOption({name: "infoLineHeight", value: data.infoLineHeight,
              type: "number", min: 0, title: "Info line height:", after: "px"});


    html += this.doOption({name: "infoTextAlign", value: data.infoTextAlign,
          type: "select", title: "Info text alignment:",
          values: ["left","center","right"],
          options: ["Left","Center","Right"]});

    html += this.doOption({name: "infoFontStyle", value: data.infoFontStyle,
          type: "select", title: "Info font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});


    html += this.doOption({name: "infoPaddingSides", value: data.infoPaddingSides,
            type: "number", min: 0, title: "Info side spacing:", after: "px"});

    html += this.doOption({name: "infoPaddingTop", value: data.infoPaddingTop,
            type: "number", min: 0, title: "Info top spacing:", after: "px"});

    html += this.doOption({name: "infoPaddingBottom", value: data.infoPaddingBottom,
            type: "number", min: 0, title: "Info bottom spacing:", after: "px"});

    // html += this.doOption({name: "infoMarginTop", value: data.infoMarginTop,
    //        type: "number", min: 0, title: "Info margin top:", after: "px"});

    // html += this.doOption({name: "infoMarginBottom", value: data.infoMarginBottom,
    //        type: "number", min: 0, title: "Info margin bottom:", after: "px"});



    html += this.getToggling({title: 'Info bottom border:',
            value:(data.infoBorderSize=="0")?"hide":"show",
            items: [
                this.doOption({name: "infoBorderSize", value: data.infoBorderSize,
                    itemClass:"isBorder",
                    type: "number", min: 0, title: "border size:", after: "px"}),

                this.doOption({name: "infoBorderColor", value: data.infoBorderColor,
                     defaultValue: "#eee", type: "color",
                     title: "border color:"})
                ]});



    html += '<h3 id="dateSettings">Date Settings</h3>';



    html += this.doOption({name: "dateFormat", value: data.dateFormat,
            type: "select", title: "Date Format:",
            values: DATE_FORMAT.getFormats,
            options: DATE_FORMAT.getLabels
          });



    html += this.doOption({name: "timeFormat", value: data.timeFormat,
            type: "select", title: "Time format:",
            values: ["g:i a","g:i A","H:i"],
            options: ["5:30 pm","5:30 PM","17:30"]});


    html += this.doOption({name: "timeZone", value: data.timeZone,
            type: "select", title: "Time Zones:",
            values: TIME_ZONES.getFormats,
            options: TIME_ZONES.getLabels
          });


    html += this.doOption({name: "includeEndsOn", value: data.includeEndsOn,
                type: "toggle", title: 'Include "Ends On" date:',
                info: "Adds the time and date the event ends in the event box."});



    html += '<div class="alert alert-info">The <strong>date & time</strong> that is displayed by default is the nearest upcoming occurrence of the event. If all dates passed then the last occurrence will be displayed.<br/> You can list all dates, only upcoming dates or passed dates in a modal box. Use the settings below to configure that.</div>';
    html += '<h4>"More Dates" Settings <small>For events that reoccur.</small></h4>';



    html += this.doOption({name: "moreDateOn", value: data.moreDateOn,
                type: "toggle", title: 'Enable More Dates:',
                info: "When pressed a modal will appear with previous and upcoming events."});


    html += this.doOption({name: "moreDatePassed", value: data.moreDatePassed,
                type: "toggle", title: 'List Passed Dates:',
                info: "Passed Events will be listed in the modal when the more dates button is pressed"});


    html += this.doOption({name: "moreDateUpcoming", value: data.moreDateUpcoming,
                type: "toggle", title: 'List Upcoming Dates:',
                info: "Upcoming Events will be listed in the modal when the more dates button is pressed"});





    html += this.doOption({name: "moreDateTextAlign", value: data.moreDateTextAlign,
            type: "select", title: "More dates link alignment:",
            values: ["left","center","right"],
            options: ["Left","Center","Right"]});


    html += this.doOption({name: "moreDateMarginTop", value: data.moreDateMarginTop,
              type: "number", min: 0, title: '"More Date" margin top:', after: "px"});


    html += this.doOption({name: "moreDateColor", value: data.moreDateColor, defaultValue: "#c4c4c4",
              type: "color", title: '"More Date" color:'});


    html += this.doOption({name: "moreDateHoverColor", value: data.moreDateHoverColor, defaultValue: "#a3a3a3",
              type: "color", title: '"More Date" hover color:'});


    html += this.doOption({name: "moreDateSize", value: data.moreDateSize,
                type: "number", min: 0, title: '"More dates" link font size', after: "px"});



    html += this.doOption({name: "moreDateFontStyle", value: data.moreDateFontStyle,
          type: "select", title: "Title font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});



    html += '<div class="alert alert-info">Customize how the date and time appears in the modal from the modal settings</div>';

    html += '<h4>Date & time formatting</h4>';


    html += this.doOption({name: "dateColor", value: data.dateColor, defaultValue: "#999",
              type: "color", title: 'Date color:'});

    html += this.doOption({name: "dateFontSize", value: data.dateFontSize,
                type: "number", min: 0, title: "Date font size:", after: "px"});

    html += this.doOption({name: "dateTextAlign", value: data.dateTextAlign,
          type: "select", title: "Date text alignment:",
          values: ["left","center","right"],
          options: ["Left","Center","Right"]});

    html += this.doOption({name: "dateFontStyle", value: data.dateFontStyle,
          type: "select", title: "Date font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});




    html += this.doOption({name: "dateMarginTop", value: data.dateMarginTop,
            type: "number", min: 0, title: "Date margin top:", after: "px"});

    html += this.doOption({name: "dateMarginBottom", value: data.dateMarginBottom,
            type: "number", min: 0, title: "Date margin bottom:", after: "px"}) ;



    html += '<h3 id="LocationSettings">Location Settings</h3>';

    html += this.doOption({name: "locationColor", value: data.locationColor, defaultValue: "#111",
              type: "color", title: "Color:"});

    html += this.doOption({name: "locationFontSize", value: data.locationFontSize,
              type: "number", min: 0, title: "Font size:", after: "px"});


    html += this.doOption({name: "locationTextAlign", value: data.locationTextAlign,
          type: "select", title: "Text alignment:",
          values: ["left","center","right"],
          options: ["Left","Center","Right"]});

    html += this.doOption({name: "locationFontStyle", value: data.locationFontStyle,
          type: "select", title: "Font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});


    html += '<h3 id="detailSettings">Details/tickets Settings</h3>';

      html += this.doOption({name: "showAllTickets", value: data.showAllTickets,
                type: "toggle", title: 'Show all tickets in eventBox:',
                info: "if set to false, only first ticket will be shown in event box. ALl tickets will still appear in booking popup!"});


      html += this.doOption({name: "detailsColor", value: data.detailsColor, defaultValue: "#999",
              type: "color", title: "Details color:"});

      html += this.doOption({name: "detailsFontSize", value: data.detailsFontSize,
                type: "number", min: 0, title: "Details font size:", after: "px"});



      html += this.doOption({name: "detailsFontStyle", value: data.detailsFontStyle,
            type: "select", title: "Title font style:",
            values: ["normal","italic","bold","100","300","500","700"],
            options: ["Normal","Italic","Bold","100","300","500","700"]});




      html += this.doOption({name: "detailsLableColor", value: data.detailsLableColor, defaultValue: "#CCC",
              type: "color", title: "Spots Left color:",
              info: "Color of labels such  the text in spots left"});

      html += this.doOption({name: "detailsLableSize", value: data.detailsLableSize,
                type: "number", min: 0, title: "Spots Left font size:", after: "px"});


      html += this.doOption({name: "detailsLabelStyle", value: data.detailsLabelStyle,
            type: "select", title: "Spots Left font style:",
            values: ["normal","italic","bold","100","300","500","700"],
            options: ["Normal","Italic","Bold","100","300","500","700"]});



    html += '<h3 id="btnSettings">Button Settings</h3>';


    html += this.doOption({name: "showPrice", value: data.showPrice,
                type: "toggle", title: 'Show price in button:',
                info: "Adds price to buttons."});



    html += this.doOption({name: "btnColor", value: data.btnColor, defaultValue: "#fff",
              type: "color", title: "Button text color:"});

    html += this.doOption({name: "btnBgColor", value: data.btnBgColor, defaultValue: "#2ecc71",
              type: "color", title: "Button background color:"});


    html += this.doOption({name: "btnFontSize", value: data.btnFontSize,
                type: "number", min: 0, title: "Button font size:", after: "px"});


    html += this.doOption({name: "btnFontType", value: data.btnFontType,
          type: "select", title: "Button font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});



    html += this.doOption({name: "btnSidePadding", value: data.btnSidePadding,
            type: "number", min: 0, title: "Button padding sides:", after: "px"});

    html += this.doOption({name: "btnTopPadding", value: data.btnTopPadding,
            type: "number", min: 0, title: "Button padding top/bottom:", after: "px"});


    html += this.doOption({name: "btnMarginTop", value: data.btnMarginTop,
            type: "number", min: 0, title: "Button margin top:", after: "px"});

    html += this.doOption({name: "btnMarginBottom", value: data.btnMarginBottom,
            type: "number", min: 0, title: "Button margin bottom:", after: "px"});


    html += this.doOption({name: "btnBorderRadius", value: data.btnBorderRadius,
            type: "number", min: 0, title: "Button Border Radius:", after: "px",
            info: "Radius of the border (0) for perfect square."});

    html += '<h3 id="socialSettings">Social Settings</h3>';
    html += this.getToggling({title: 'Social section top border:',
      value:(data.calBorderSize=="0")?"hide":"show",
      items: [
          this.doOption({name: "calBorderSize", value: data.calBorderSize,
              itemClass:"isBorder",
              type: "number", min: 0, title: "border size:", after: "px"}),

          this.doOption({name: "calBorderColor", value: data.calBorderColor,
               defaultValue: "#eee", type: "color",
               title: "border color:"})
          ]});



    return html;
  }

  this.getCalendarSettingsSection = function (data) {
    html = '<h3 id="generalSettings">General Setting</h3>';

    html += this.doOption({name: 'cal_startIn', value: data.cal_startIn,
          type: 'select', title: 'Calendar first day:',
          values: ['1', '2', '3', '4', '5', '6', '0'],
          options: ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday']});



    html += this.doOption({name: 'cal_displayWeekAbbr', value: data.cal_displayWeekAbbr,
              type: 'toggle', title: 'Day abbreviations:', info: 'toggle on to show abbreviations rather than full name.'});

    html += this.doOption({name: 'cal_displayMonthAbbr', value: data.cal_displayMonthAbbr,
              type: 'toggle', title: 'Month abbreviations:', info: 'toggle on to show abbreviations rather than full name.'});


    html += this.doOption({name: "cal_width", value: data.cal_width,
              type: "number", min: 0, title: "Calendar width:", after: "px"});

    html += this.doOption({name: "cal_height", value: data.cal_height,
              type: "number", min: 0, title: "Calendar Height:", after: "px"});

    html += this.doOption({name: "boxMarginTop", value: data.boxMarginTop,
              type: "number", min: 0, title: "Box top margin:", after: "px"});

    html += this.doOption({name: "boxMarginBottom", value: data.boxMarginBottom,
              type: "number", min: 0, title: "Box bottom margin:", after: "px"});


    html += this.doOption({name: "cal_color", value: data.cal_color, defaultValue: "#2ecc71",
            type: "color", title: "Calendar main color:"});

    html += this.doOption({name: "cal_bgColor", value: data.cal_bgColor, defaultValue: "#F6F6F6",
            type: "color", title: "Calendar bg color:"});

    html += this.doOption({name: "cal_boxColor", value: data.cal_boxColor, defaultValue: "#FFF",
            type: "color", title: "Calendar box color:"});

    html += this.doOption({name: "cal_titleBgColor", value: data.cal_titleBgColor, defaultValue: "#FFF",
            type: "color", title: "Calendar title bg color:"});


    html += this.doOption({name: "calTodayColor", value: data.calTodayColor, defaultValue: "#2ecc71",
            type: "color", title: 'Color of "today" box'});

    html += this.doOption({name: "calEventDayColor", value: data.calEventDayColor, defaultValue: "#FFF",
            type: "color", title: "Event Day box color:"});

    html += this.doOption({name: "calEventDayColorHover", value: data.calEventDayColorHover, defaultValue: "#FFF",
            type: "color", title: "Event Day box color hover:"});


    html += this.doOption({name: "cal_dateColor", value: data.cal_dateColor, defaultValue: "#686a6e",
            type: "color", title: "Calendar date color:"});

    html += this.doOption({name: "calEventDayDotColor", value: data.calEventDayDotColor, defaultValue: "#ddd",
            type: "color", title: "Event dot color:"});

    html += this.doOption({name: "calEventDayDotColorHover", value: data.calEventDayDotColorHover,
            defaultValue: "#2ecc71",
            type: "color", title: "Event dot hover color:"});

      html += this.doOption({name: "calendarImageAsBackground", value: data.calendarImageAsBackground,
            type: "toggle", title: 'Event Day Image background:'});

    html += this.doOption({name: "cal_hasBoxShadow", value: data.cal_hasBoxShadow,
      type: "toggle", title: "Box shadow around calendar:"});


    html += this.getToggling({title: 'Calendar top border:', value:(data.cal_topBorder=="0")?"hide":"show",
              items: [
                  this.doOption({name: "cal_topBorder", value: data.cal_topBorder,
                      itemClass:"isBorder",
                      type: "number", min: 0, title: "border size:", after: "px"}),

                  this.doOption({name: "cal_topBorderColor", value: data.cal_topBorderColor,
                       defaultValue: "#2ecc71", type: "color",
                       title: "border color:"})
                  ]});




    html += this.getToggling({title: 'Calendar bottom border:', value:(data.cal_bottomBorder=="0")?"hide":"show",
              items: [
                  this.doOption({name: "cal_bottomBorder", value: data.cal_bottomBorder,
                      itemClass:"isBorder",
                      type: "number", min: 0, title: "border size:", after: "px"}),

                  this.doOption({name: "cal_bottomBorderColor", value: data.cal_bottomBorderColor,
                       defaultValue: "#EEE", type: "color",
                       title: "border color:"})
                  ]});


      html += this.getToggling({title: 'Calendar sides border:',
              value:(data.cal_sideBorder=="0")?"hide":"show",
              items: [
                  this.doOption({name: "cal_sideBorder", value: data.cal_sideBorder,
                      itemClass:"isBorder",
                      type: "number", min: 0, title: "border size:", after: "px"}),

                  this.doOption({name: "cal_sideBorderColor", value: data.cal_sideBorderColor,
                       defaultValue: "#EEE", type: "color",
                       title: "border color:"})
                  ]});


    html += '<div class="item">';
    html += '<span class="label">Space between calendar border and event content:</span><input id="cal_paddingSides" name="cal_paddingSides" value="'+data.cal_paddingSides+'" class="intTxt" type="number"  /> px';
    html += '</div>';



    return html;
  }

  this.getEventBoxSettingsSection = function (data) {
    html = '<h3 id="generalSettings">Event Box Settings</h3>';

    html += this.doOption({name: "boxWidth", value: data.boxWidth,
            type: "number", min: 0, title: "Event box width:", after: "px"});



    html += this.getToggling({title: 'Center Event Box:',
              value: data.boxAlign,
              name: "boxAlign",
              inverseToggle: "yes",
              items: [
                  this.doOption({name: "boxMarginSides", value: data.boxMarginSides,
                      type: "number", min: 0, title: "Box side margin:", after: "px"})
                  ]});


    html += this.doOption({name: "boxMarginTop", value: data.boxMarginTop,
            type: "number", min: 0, title: "Box top margin:", after: "px"});

    html += this.doOption({name: "boxMarginBottom", value: data.boxMarginBottom,
            type: "number", min: 0, title: "Box bottom margin:", after: "px"});


    html += this.doOption({name: "boxPaddingSides", value: data.boxPaddingSides,
            type: "number", min: 0, title: "Box  side padding:", after: "px"});

    html += this.doOption({name: "boxPaddingTop", value: data.boxPaddingTop,
            type: "number", min: 0, title: "Box top padding::", after: "px"});

    html += this.doOption({name: "boxPaddingBottom", value: data.boxPaddingBottom,
            type: "number", min: 0, title: "Box bottom padding::", after: "px"});


    html += this.doOption({name: "boxBgColor", value: data.boxBgColor, defaultValue: "#FFF",
            type: "color", title: "Box background color:"});


    html += this.doOption({name: "box_hasBoxShadow", value: data.box_hasBoxShadow,
      type: "toggle", title: "Box shadow around enevtBox:"});

    html += this.getToggling({title: 'Box border:', value:(data.boxBorder=="0")?"hide":"show",
              items: [
                  this.doOption({name: "boxBorder", value: data.boxBorder,
                      itemClass:"isBorder",
                      type: "number", min: 0, title: "border size:", after: "px"}),

                  this.doOption({name: "boxBorderColor", value: data.boxBorderColor,
                       defaultValue: "#EEE", type: "color",
                       title: "border color:"})
                  ]});

      html += this.doOption({name: "boxBorderRadius", value: data.boxBorderRadius,
            type: "number", min: 0, title: "Box Border Radius:", after: "px",
            info: "Radius of the border (0) for perfect square."});



    html += '<h3 id="imgSettings">Image Settings<small>  Only applicable if an image was uploaded.</small></h3>';



              html += this.getToggling({title: 'Crop Image:',
              value: data.imageCrop,
              name: "imageCrop",

              items: [
                  this.doOption({name: "imageHeight", value: data.imageHeight,
                      type: "number", min: 0, title: "Image maximum Height:", after: "px"})
                  ]}) ;




    html += this.doOption({name: "imageMarginSides", value: data.imageMarginSides,
              type: "number", min: 0, title: "Image side margin:", after: "px"});

    html += this.doOption({name: "imageMarginTop", value: data.imageMarginTop,
              type: "number", min: 0, title: "Image top margin:", after: "px"});

    html += this.doOption({name: "imageMarginBottom", value: data.imageMarginBottom,
              type: "number", min: 0, title: "Image bottom margin:", after: "px"});


    html += '<h3 id="mapSettings">Map Settings</h3>';


    html += this.doOption({name: "mapHeight", value: data.mapHeight,
              type: "number", min: 0, title: "Map height:", after: "px"});

    html += '<h3 id="LocationSettings">Location Settings</h3>';


    html += this.doOption({name: "eventBoxIncludeAddress", value: data.eventBoxIncludeAddress,
              type: "toggle", title: "Include address as text above map:"});

    html += this.doOption({name: "locationColor", value: data.locationColor, defaultValue: "#111",
            type: "color", title: "Color:"});

    html += this.doOption({name: "locationFontSize", value: data.locationFontSize,
            type: "number", min: 0, title: "Font size:", after: "px"});


    html += this.doOption({name: "locationTextAlign", value: data.locationTextAlign,
        type: "select", title: "Text alignment:",
        values: ["left","center","right"],
        options: ["Left","Center","Right"]});

    html += this.doOption({name: "locationFontStyle", value: data.locationFontStyle,
        type: "select", title: "Font style:",
        values: ["normal","italic","bold","100","300","500","700"],
        options: ["Normal","Italic","Bold","100","300","500","700"]});

    html += '<h3 id="titleSettings">Title Settings</h3>';


    html += this.doOption({name: "titleColor", value: data.titleColor, defaultValue: "#111",
            type: "color", title: "Title color:"});

    html += this.doOption({name: "titleFontSize", value: data.titleFontSize,
              type: "number", min: 0, title: "Title font size:", after: "px"});

    html += this.doOption({name: "titleLineHeight", value: data.titleLineHeight,
              type: "number", min: 0, title: "Title line height:", after: "px"});

    html += this.doOption({name: "titleTextAlign", value: data.titleTextAlign,
          type: "select", title: "Tite text alignment:",
          values: ["left","center","right"],
          options: ["Left","Center","Right"]});

    html += this.doOption({name: "titleFontStyle", value: data.titleFontStyle,
          type: "select", title: "Title font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});

    html += this.doOption({name: "titlePaddingSides", value: data.titlePaddingSides,
            type: "number", min: 0, title: "Title padding sides:", after: "px"});

    html += this.doOption({name: "titlePaddingTop", value: data.titlePaddingTop,
            type: "number", min: 0, title: "Title padding top:", after: "px"});

    html += this.doOption({name: "titlePaddingBottom", value: data.titlePaddingBottom,
            type: "number", min: 0, title: "Title padding bottom:", after: "px"});

    html += this.doOption({name: "titleMarginTop", value: data.titleMarginTop,
            type: "number", min: 0, title: "Title margin top:", after: "px"});

    html += this.doOption({name: "titleMarginBottom", value: data.titleMarginBottom,
            type: "number", min: 0, title: "Title margin bottom:", after: "px"});



    html += this.getToggling({title: 'Title bottom border:',
            value:(data.titleBottomBorder=="0")?"hide":"show",
              items: [
                  this.doOption({name: "titleBottomBorder", value: data.titleBottomBorder,
                      itemClass:"isBorder",
                      type: "number", min: 0, title: "border size:", after: "px"}),

                  this.doOption({name: "titleBottomBorderColor", value: data.titleBottomBorderColor,
                       defaultValue: "#eee", type: "color",
                       title: "border color:"})
                  ]});


    html += '<h3 id="descSettings">Description Settings</h3>';


    html += this.doOption({name: "infoNoButton", value: data.infoNoButton,
              type: "toggle", title: 'Show Read More button:',
              info: "If actiavted then the description will have a read more button and only text equal to the  maximum height set below will be displayed.If deactivated then the description will be displayed all."});



    html += this.doOption({name: "infoMaxHeight", value: data.infoMaxHeight,
            type: "number", min: 0, title: "Maximum info height:", after: "px"});

    html += this.doOption({name: "infoColor", value: data.infoColor, defaultValue: "#111",
            type: "color", title: "Info color:"});

    html += this.doOption({name: "infoFontSize", value: data.infoFontSize,
            type: "number", min: 0, title: "Info font size:", after: "px"});

    html += this.doOption({name: "infoLineHeight", value: data.infoLineHeight,
            type: "number", min: 0, title: "Info line height:", after: "px"});

    html += this.doOption({name: "infoTextAlign", value: data.infoTextAlign,
        type: "select", title: "Info text alignment:",
        values: ["left","center","right"],
        options: ["Left","Center","Right"]});

    html += this.doOption({name: "infoFontStyle", value: data.infoFontStyle,
        type: "select", title: "Info font style:",
        values: ["normal","italic","bold","100","300","500","700"],
        options: ["Normal","Italic","Bold","100","300","500","700"]});



    html += this.doOption({name: "infoPaddingSides", value: data.infoPaddingSides,
          type: "number", min: 0, title: "Info side spacing ", after: "px"});

    html += this.doOption({name: "infoPaddingTop", value: data.infoPaddingTop,
          type: "number", min: 0, title: "Info top spacing:", after: "px"});

    html += this.doOption({name: "infoPaddingBottom", value: data.infoPaddingBottom,
          type: "number", min: 0, title: "Info bottom spacing:", after: "px"});

    // html += this.doOption({name: "infoMarginTop", value: data.infoMarginTop,
    //        type: "number", min: 0, title: "Info margin top:", after: "px"});

    // html += this.doOption({name: "infoMarginBottom", value: data.infoMarginBottom,
    //        type: "number", min: 0, title: "Info margin bottom:", after: "px"});



    html += this.getToggling({title: 'Info bottom border:',
          value:(data.infoBorderSize=="0")?"hide":"show",
          items: [
              this.doOption({name: "infoBorderSize", value: data.infoBorderSize,
                  itemClass:"isBorder",
                  type: "number", min: 0, title: "border size:", after: "px"}),

              this.doOption({name: "infoBorderColor", value: data.infoBorderColor,
                   defaultValue: "#eee", type: "color",
                   title: "border color:"})
              ]});



    html += '<h3 id="dateSettings">Date Settings</h3>';

    html += this.doOption({name: "dateFormat", value: data.dateFormat,
          type: "select", title: "Date Format:",
          values: DATE_FORMAT.getFormats,
          options: DATE_FORMAT.getLabels
        });


    html += this.doOption({name: "timeFormat", value: data.timeFormat,
          type: "select", title: "Time format:",
          values: ["g:i a","g:i A","H:i"],
          options: ["5:30 pm","5:30 PM","17:30"]});


    html += this.doOption({name: "timeZone", value: data.timeZone,
          type: "select", title: "Time Zones:",
          values: TIME_ZONES.getFormats,
          options: TIME_ZONES.getLabels
        });

    html += this.doOption({name: "includeEndsOn", value: data.includeEndsOn,
              type: "toggle", title: 'Include "Ends On" date:',
              info: "Adds the time and date the event ends in the event box."});




    html += '<div class="alert alert-info">The <strong>date & time</strong> that is displayed by default is the nearest upcoming occurrence of the event. If all dates passed then the last occurrence will be displayed.<br/> You can list all dates, only upcoming dates or passed dates in a modal box. Use the settings below to configure that.</div>';
    html += '<h4>"More Dates" Settings <small>For events that reoccur!</small></h4>';



    html += this.doOption({name: "moreDateOn", value: data.moreDateOn,
              type: "toggle", title: 'Enable More Dates:',
              info: "When pressed a modal will appear with previous and upcoming events."});

    html += this.doOption({name: "permenantMoreButton", value: data.permenantMoreButton,
              type: "toggle", title: 'Always Show "More Dates" Button:',
              info: "The more dates button will always show even if only 1 date is upcoming."});

    html += this.doOption({name: "moreDatePassed", value: data.moreDatePassed,
              type: "toggle", title: 'List Passed Dates:',
              info: "Passed Events will be listed in the modal when the more dates button is pressed"});


    html += this.doOption({name: "moreDateUpcoming", value: data.moreDateUpcoming,
              type: "toggle", title: 'List Upcoming Dates:',
              info: "Upcoming Events will be listed in the modal when the more dates button is pressed"});



    html += this.doOption({name: "moreDateTextAlign", value: data.moreDateTextAlign,
          type: "select", title: "More dates link alignment:",
          values: ["left","center","right"],
          options: ["Left","Center","Right"]});


    html += this.doOption({name: "moreDateMarginTop", value: data.moreDateMarginTop,
            type: "number", min: 0, title: '"More Date" margin top:', after: "px"});


    html += this.doOption({name: "moreDateColor", value: data.moreDateColor, defaultValue: "#eee",
            type: "color", title: '"More Date" margin color:'});


    html += this.doOption({name: "moreDateHoverColor", value: data.moreDateHoverColor, defaultValue: "#2ecc71",
            type: "color", title: '"More Date" margin hover color:'});


    html += this.doOption({name: "moreDateSize", value: data.moreDateSize,
              type: "number", min: 0, title: '"More dates" link font size', after: "px"});


    html += this.doOption({name: "moreDateFontStyle", value: data.moreDateFontStyle,
        type: "select", title: "Title font style:",
        values: ["normal","italic","bold","100","300","500","700"],
        options: ["Normal","Italic","Bold","100","300","500","700"]});


    html += '<div class="alert alert-info">Customize how the date and time appears in the modal from the modal settings</div>';

    html += '<h4>Date & time formatting <small>In the Event Box only</small></h4>';


    html += this.doOption({name: "dateColor", value: data.dateColor, defaultValue: "#999",
            type: "color", title: 'Date color:'});

    html += this.doOption({name: "dateFontSize", value: data.dateFontSize,
              type: "number", min: 0, title: "Date font size:", after: "px"});


    html += this.doOption({name: "dateTextAlign", value: data.dateTextAlign,
        type: "select", title: "Date text alignment:",
        values: ["left","center","right"],
        options: ["Left","Center","Right"]});

    html += this.doOption({name: "dateFontStyle", value: data.dateFontStyle,
        type: "select", title: "Date font style:",
        values: ["normal","italic","bold","100","300","500","700"],
        options: ["Normal","Italic","Bold","100","300","500","700"]});


    html += this.doOption({name: "dateLableColor", value: data.dateLableColor, defaultValue: "#666",
            type: "color", title: 'Date label color:'});


    html += this.doOption({name: "dateLableSize", value: data.dateLableSize,
              type: "number", min: 0, title: "Date label font size:", after: "px"});

    html += this.doOption({name: "dateLabelLineHeight", value: data.dateLabelLineHeight,
            type: "number", min: 0, title: "Date label line height:", after: "px"});

    html += this.doOption({name: "dateLabelStyle", value: data.dateLabelStyle,
        type: "select", title: "Date label font style:",
        values: ["normal","italic","bold","100","300","500","700"],
        options: ["Normal","Italic","Bold","100","300","500","700"]});




    html += this.doOption({name: "datePaddingSides", value: data.datePaddingSides,
            type: "number", min: 0, title: "Date padding sides:", after: "px"}) ;

    html += this.doOption({name: "datePaddingTop", value: data.datePaddingTop,
          type: "number", min: 0, title: "Date padding top:", after: "px"});

    html += this.doOption({name: "datePaddingBottom", value: data.datePaddingBottom,
          type: "number", min: 0, title: "Date padding bottom:", after: "px"});

    html += this.doOption({name: "dateMarginTop", value: data.dateMarginTop,
          type: "number", min: 0, title: "Date margin top:", after: "px"});

    html += this.doOption({name: "dateMarginBottom", value: data.dateMarginBottom,
          type: "number", min: 0, title: "Date margin bottom:", after: "px"});



    html += this.getToggling({title: 'Date bottom border:',
          value:(data.dateBorderSize=="0")?"hide":"show",
          items: [
              this.doOption({name: "dateBorderSize", value: data.dateBorderSize,
                  itemClass:"isBorder",
                  type: "number", min: 0, title: "border size:", after: "px"}),

              this.doOption({name: "dateBorderColor", value: data.dateBorderColor,
                   defaultValue: "#eee", type: "color",
                   title: "border color:"})
              ]});




    html += '<h3 id="detailSettings">Details/tickets Settings</h3>';

    html += this.doOption({name: "showAllTickets", value: data.showAllTickets,
              type: "toggle", title: 'Show all tickets in event Box:',
              info: "if set to false, only first ticket will be shown in event box. ALl tickets will still appear in booking popup!"});


    html += this.doOption({name: "detailsColor", value: data.detailsColor, defaultValue: "#999",
            type: "color", title: "Details color:"});

    html += this.doOption({name: "detailsFontSize", value: data.detailsFontSize,
              type: "number", min: 0, title: "Details font size:", after: "px"});

    html += this.doOption({name: "detailsFontLineHeight", value: data.detailsFontLineHeight,
              type: "number", min: 0, title: "Details line height:", after: "px"});


    html += this.doOption({name: "detailsFontStyle", value: data.detailsFontStyle,
          type: "select", title: "Title font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});




    html += this.doOption({name: "detailsLableColor", value: data.detailsLableColor, defaultValue: "#CCC",
            type: "color", title: "Details Label color:",
            info: "Color of labels such  the text in spots left"});

    html += this.doOption({name: "detailsLableSize", value: data.detailsLableSize,
              type: "number", min: 0, title: "Details Label font size:", after: "px"});

    html += this.doOption({name: "detailsLabelLineHeight", value: data.detailsLabelLineHeight,
              type: "number", min: 0, title: "Details Label line height:", after: "px"});


    html += this.doOption({name: "detailsLabelStyle", value: data.detailsLabelStyle,
          type: "select", title: "Title Label font style:",
          values: ["normal","italic","bold","100","300","500","700"],
          options: ["Normal","Italic","Bold","100","300","500","700"]});



    html += this.doOption({name: "detailsPaddingSides", value: data.detailsPaddingSides,
            type: "number", min: 0, title: "Details padding sides:", after: "px"});

    html += this.doOption({name: "detailsPaddingTop", value: data.detailsPaddingTop,
            type: "number", min: 0, title: "Details padding top:", after: "px"});

    html += this.doOption({name: "detailsPaddingBottom", value: data.detailsPaddingBottom,
            type: "number", min: 0, title: "Details padding bottom:", after: "px"});

    html += this.doOption({name: "detailsMarginTop", value: data.detailsMarginTop,
            type: "number", min: 0, title: "Details margin top:", after: "px"});

    html += this.doOption({name: "detailsMarginBottom", value: data.detailsMarginBottom,
            type: "number", min: 0, title: "Details margin bottom:", after: "px"});



    html += this.getToggling({title: 'Details bottom border:',
          value:(data.detailsBorderSize=="0")?"hide":"show",
          items: [
              this.doOption({name: "detailsBorderSize", value: data.detailsBorderSize,
                  itemClass:"isBorder",
                  type: "number", min: 0, title: "border size:", after: "px"}),

              this.doOption({name: "detailsBorderColor", value: data.detailsBorderColor,
                   defaultValue: "#eee", type: "color",
                   title: "border color:"}),
              this.doOption({name: "detailsBorderSide", value: data.detailsBorderSide,
                  type: "number", min: 0,
                  title: "Details border Seperator size:", after: "px"})
              ]});





    html += '<h3 id="btnSettings">Button Settings</h3>';


    html += this.doOption({name: "showPrice", value: data.showPrice,
              type: "toggle", title: 'Show price in button:',
              info: "Adds price to buttons."});



    html += this.doOption({name: "btnColor", value: data.btnColor, defaultValue: "#fff",
            type: "color", title: "Button text color:"});

    html += this.doOption({name: "btnBgColor", value: data.btnBgColor, defaultValue: "#2ecc71",
            type: "color", title: "Button background color:"});


    html += this.doOption({name: "btnFontSize", value: data.btnFontSize,
              type: "number", min: 0, title: "Button font size:", after: "px"});

    html += this.doOption({name: "btnLineHeight", value: data.btnLineHeight,
            type: "number", min: 0, title: "Button line height:", after: "px"});


    html += this.doOption({name: "btnFontType", value: data.btnFontType,
        type: "select", title: "Button font style:",
        values: ["normal","italic","bold","100","300","500","700"],
        options: ["Normal","Italic","Bold","100","300","500","700"]});



    html += this.doOption({name: "btnSidePadding", value: data.btnSidePadding,
            type: "number", min: 0, title: "Button padding sides:", after: "px"});

    html += this.doOption({name: "btnTopPadding", value: data.btnTopPadding,
            type: "number", min: 0, title: "Button padding top/bottom:", after: "px"});


    html += this.doOption({name: "btnMarginTop", value: data.btnMarginTop,
            type: "number", min: 0, title: "Button margin top:", after: "px"});

    html += this.doOption({name: "btnMarginBottom", value: data.btnMarginBottom,
            type: "number", min: 0, title: "Button margin bottom:", after: "px"});


      html += this.getToggling({title: 'Button top border:',
          value:(data.btnBorder=="0")?"hide":"show",
          items: [
              this.doOption({name: "btnBorder", value: data.btnBorder,
                  itemClass:"isBorder",
                  type: "number", min: 0, title: "border size:", after: "px"}),

              this.doOption({name: "btnBorderColor", value: data.btnBorderColor,
                   defaultValue: "#eee", type: "color",
                   title: "border color:"})
              ]});


    html += this.doOption({name: "btnBorderRadius", value: data.btnBorderRadius,
            type: "number", min: 0, title: "Button Border Radius:", after: "px",
            info: "Radius of the border (0) for perfect square."});


    html += '<h3 id="socialSettings">Social Settings</h3>';
    html += this.getToggling({title: 'Social section top border:',
      value:(data.calBorderSize=="0")?"hide":"show",
      items: [
          this.doOption({name: "calBorderSize", value: data.calBorderSize,
              itemClass:"isBorder",
              type: "number", min: 0, title: "border size:", after: "px"}),

          this.doOption({name: "calBorderColor", value: data.calBorderColor,
               defaultValue: "#eee", type: "color",
               title: "border color:"})
          ]});


    return html;
  }

  /**
    Quick link functions
  */
  this.getQuickLinks = function (type) {
    html = '';
    if (type === 'EVENT_BOX' || type == 'EVENT_CARD') {
      html += '<div class="EBP--Quicklink--Cnt">';
      html += '<span>Quick Links</span>';

        html += '<a href="#textS" class="quicklink">Text Settings</a>';
        html += '<a href="#generalSettings" class="quicklink">General Settings</a>';
        html += '<a href="#imgSettings" class="quicklink">Image Settings</a>';
        html += '<a href="#mapSettings" class="quicklink">Map Settings</a>';
        html += '<a href="#LocationSettings" class="quicklink">Location Settings</a>';
        html += '<a href="#titleSettings" class="quicklink">Title Settings</a>';
        html += '<a href="#descSettings" class="quicklink">Description Settings</a>';
        html += '<a href="#dateSettings" class="quicklink">Date Settings</a>';
        html += '<a href="#detailSettings" class="quicklink">Details/tickets Settings</a>';
        html += '<a href="#btnSettings" class="quicklink">Button Details Settings</a>';
        html += '<a href="#socialSettings" class="quicklink">Social Settings</a>';
      html += '</div>'

    } else if (type == 'BOOKING_FORM') {

      html += '<div class="EBP--Quicklink--Cnt">';
        html += '<span>Quick Links</span>';

        html += '<a href="#modalGeneralSettings" class="quicklink">General Settings</a>';
        html += '<a href="#successSettings" class="quicklink">Success Settings</a>';
        html += '<a href="#modalTitleSettings" class="quicklink">Title Settings</a>';
        html += '<a href="#modalMainSettings" class="quicklink">Content Color</a>';
        html += '<a href="#modalInputs" class="quicklink">Input Settings</a>';
        html += '<a href="#modalPhoneInput" class="quicklink">Phone Number Input Settings</a>';
        html += '<a href="#selectSettings" class="quicklink">Dropdown Settings</a>';
        html += '<a href="#checkSettings" class="quicklink">CheckBox/RadioButton</a>';
        html += '<a href="#modalSettings" class="quicklink">Button Settings</a>';
        html += '<a href="#modalDateSettings" class="quicklink">Date Settings</a>';
      html += '</div>'

    } else if (type == 'BOOKING') {

      html += '<div class="EBP--Quicklink--Cnt">';
        html += '<span>Quick Links</span>';

        html += '<a href="#priceSettings" class="quicklink">Price Settings</a>';
        html += '<a href="#taxSettings" class="quicklink">Tax Settings</a>';
        html += '<a href="#couponsSettings" class="quicklink">Coupons Settings</a>';
        html += '<a href="#bookingSettings" class="quicklink">Booking Settings</a>';
      html += '</div>';

    } else if (type === 'EMAIL') {
      html += '<div class="EBP--Quicklink--Cnt">';
        html += '<span>Quick Links</span>';

        html += '<a href="#emailSettings" class="quicklink">Email Settings</a>';
        html += '<a href="#emailTemplateDiv" class="quicklink">Buyer Email (success)</a>';
        html += '<a href="#OwnerEmailTemplateDiv" class="quicklink">Owner Email (success)</a>';
        html += '<a href="#refundemailTemplateDiv" class="quicklink">Buyer Email (refund)</a>';
        html += '<a href="#refundOwneremailTemplateDiv" class="quicklink">Owner Email (refund)</a>';
      html += '</div>';
    }  else if (type === 'TEXTS') {
      html += '<div class="EBP--Quicklink--Cnt">';
        html += '<span>Quick Links</span>';

        html += '<a href="#general" class="quicklink">General</a>';
        html += '<a href="#eventCard" class="quicklink">Event card</a>';
        html += '<a href="#calendar" class="quicklink">Calendar</a>';
        html += '<a href="#eventList" class="quicklink">Event list</a>';
        html += '<a href="#bookingPage" class="quicklink">Booking page</a>';
        html += '<a href="#couponsSettings" class="quicklink">Coupons</a>';
        html += '<a href="#occurrences" class="quicklink">Occurrences</a>';
        html += '<a href="#social" class="quicklink">Share to calendar</a>';
      html += '</div>';
    }

    return html;
  }

  this.getSettingsNavSection = function (type, data) {
      var html = '<div id="changeSettings" class="settingsBtns">';

      html += '<input type="hidden" id="setting-type" name="setting-type" value="' + type + '"/>';

      var isBtnActive;

      isBtnActive = (type === 'EVENT_BOX') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="EVENT_BOX">Event Box</a>';

      isBtnActive = (type === 'EVENT_CARD') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="EVENT_CARD">Event Card</a>';

      isBtnActive = (type === 'CALENDAR') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="CALENDAR">Calendar</a>';

      isBtnActive = (type === 'EVENT_LIST') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="EVENT_LIST">Events List</a>';

      if (data.hasSliderAddon) {
        isBtnActive = (type === 'EVENT_SLIDER') ? 'active' : '';
        html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="EVENT_SLIDER">Event Slider</a>'
      }

      isBtnActive = (type === 'BOOKING_FORM') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + ' " data-type="BOOKING_FORM">Booking Form</a>';

      isBtnActive = (type === 'BOOKING' ) ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="BOOKING">Price - Tax - Coupons - Booking</a>';

      isBtnActive = (type === 'PAYPAL') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="PAYPAL">PayPal</a>';

      isBtnActive = (type === 'EMAIL') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="EMAIL">Email</a>';

      if (data.hasEmailRules) {
        isBtnActive = (type === 'EMAIL_RULES') ? 'active' : '';;
        html += '<a href="#" class="btn btn-auto addon-btn ' + isBtnActive + '" data-type="EMAIL_RULES">Email Rules</a>'
      }

      if (data.hasDayListCalendar) {
        isBtnActive = (type === 'DAY_CALENDAR') ? 'active' : '';
        html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="DAY_CALENDAR">Day Calendar</a>'
      }

      isBtnActive = (type === 'MAPS') ? 'active' : '';;
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="MAPS">Maps</a>'

      isBtnActive = (type === 'UTILS') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="UTILS">Utils</a>';

      isBtnActive = (type === 'CSS') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="CSS">CSS</a>';

      isBtnActive = (type === 'SOCIAL') ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="SOCIAL">Social Media</a>';


      isBtnActive = (type === "TEXTS") ? 'active' : '';
      html += '<a href="#" class="btn btn-auto ' + isBtnActive + '" data-type="TEXTS">Texts</a>';

      html += '</div>'
      return html;
  }

  this.getSettingsTabSideSection = function (type) {
    html = '<div class="EBP--SettingPage--SideCnt EBP--Fix-Top"><div>';
      if (type != 'UTILS') {
        html += '<div class="EBP--SettingPage--SaveBtn"><a href="#" class="btn btn-small btn-success btn-settings-save">Save</a></div>';
      }

    html += this.getQuickLinks(type);
    html += '</div></div>';

    return html;
  }
}
