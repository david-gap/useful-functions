<?
/**
 *
 *
 * Date functions
 * Author:      David Voglgsnag
 */



/* CHECK IF VARS ARE OUT OF DATE
/------------------------*/
/**
  * @param string $start: start date
  * @param string $end: end date
  * @return bool if times are true or false
*/
function DateCheck(string $start = "", string $end = "", string $factor = "between"){
  // vars
  $current_date = time();
  $startdate = strtotime($start);
  $enddate = strtotime($end);
  // check start date
  if($startdate !== ""):
    if($startdate < $current_date):
      $show_start = "past";
    else:
      $show_start = "future";
    endif;
  else:
    $show_start = "empty";
  endif;
  // check end date
  if($enddate !== ""):
    if($enddate >= $current_date):
      $show_end = "future";
    else:
      $show_end = "past";
    endif;
  else:
    // end date fallback
    $show_end = "empty";
  endif;

  // returning the validation
  if($factor == "between"):
      // if event started and still running
      if($show_start == "past" && $show_end == "future"):
        return true;
      else:
        return false;
      endif;
  elseif($factor == "future"):
      // if event is in the future
      if($show_start == "future" && $show_end == "future" || $show_start == "future" && $show_end == "empty"):
        return true;
      else:
        return false;
      endif;
  elseif($factor == "past"):
      // if event is in the past
      if($show_start == "past" && $show_end == "past" || $show_start == "past" && $show_end == "empty" || $show_start == "empty" && $show_end == "past"):
        return true;
      else:
        return false;
      endif;
  endif;
}


/* DATE RANGE FORMAT
/------------------------*/
/**
  * @param string $start: start date
  * @param string $end: end date
  * @param string $seperator: seperates start with end date
  * @return string date range start - end
*/
function DateRange(string $start = "", string $end = "", string $seperator = "-" ) {
    // vars
    $current_date = time();
    $startdate = strtotime($start);
    $enddate = strtotime($end);
    $output = '';
    // start date
    if(!Empty($end) && date("m", $startdate) == date("m", $enddate) && date("Y", $startdate) == date("Y", $enddate)):
      // if end date is given and is in the same month and year
      $output .= !Empty($start) ? date("d.", $startdate) : '';
    elseif(!Empty($end) && date("m", $startdate) !== date("m", $enddate) && date("Y", $startdate) == date("Y", $enddate)):
      // if end date is given and is not the same month but in the same year
      $output .= !Empty($start) ? date("d.m.", strtotime($start)) : '';
    else:
      $output .= !Empty($start) ? date("d.m.Y", strtotime($start)) : '';
    endif;
    // seperate
    $output .= !Empty($start) && !Empty($end) ? ' ' . $seperator . ' ' : '';
    // end date
    $output .= !Empty($end) ? date("d.m.Y", strtotime($end)) : '';

    return $output;
}


/* GET DAY NAME
/------------------------*/
/**
  * @param string $day: selected day name in english
  * @param string $lang: current language code
  * @return string date name translated
  * <code>
  * <?php
  * $day = date('m');
  * echo DayName($day, "de");
  * ?>
  * </code>
*/
function DayName(string $day = 'Monday', string $lang = 'en'){
  $days = array(
    "en" => array(
      "Monday" => "Monday",
      "Tuesday" => "Tuesday",
      "Wednesday" => "Wednesday",
      "Thursday" => "Thursday",
      "Friday" => "Friday",
      "Saturday" => "Saturday",
      "Sunday" => "Sunday"
    ),
    "de" => array(
      "Monday" => "Montag",
      "Tuesday" => "Dienstag",
      "Wednesday" => "Mittwoch",
      "Thursday" => "Donnerstag",
      "Friday" => "Freitag",
      "Saturday" => "Samstag",
      "Sunday" => "Sonntag"
    ),
    "fr" => array(
      "Monday" => "Lundi",
      "Tuesday" => "Mardi",
      "Wednesday" => "Mercredi",
      "Thursday" => "Jeudi",
      "Friday" => "Vendredi",
      "Saturday" => "Samedi",
      "Sunday" => "Dimanche"
    )
  );
  return $days[$lang][$day];
}


/* GET MONTH NAME
/------------------------*/
/**
  * @param string $month: selected month name by month number
  * @param string $lang: current language code
  * @return string date name translated
  * <code>
  * <?php
  * $month = date('m');
  * echo MonthName($month, "de");
  * ?>
  * </code>
*/
function MonthName(int $month = 1, string $lang = 'en'){
  $months = array(
    "en" => array(
      1 => "January",
      2 => "February",
      3 => "March",
      4 => "April",
      5 => "May",
      6 => "June",
      7 => "July",
      8 => "August",
      9 => "September",
      10 => "October",
      11 => "November",
      12 => "December"
    ),
    "de" => array(
      1 => "Januar",
      2 => "Februar",
      3 => "März",
      4 => "April",
      5 => "Mai",
      6 => "Juni",
      7 => "Juli",
      8 => "August",
      9 => "September",
      10 => "Oktober",
      11 => "November",
      12 => "Dezember"
    ),
    "fr" => array(
      1 => "Janviere",
      2 => "fevrier",
      3 => "mars",
      4 => "avril",
      5 => "mai",
      6 => "juin",
      7 => "juillet",
      8 => "aout",
      9 => "septembre",
      10 => "octobre",
      11 => "novembre",
      12 => "decembre"
    )
  );
  return $months[$lang][$month];
}


?>
