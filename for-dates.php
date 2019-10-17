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


?>
