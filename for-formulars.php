<?
/**
 *
 *
 * Formular functions
 * Author:      David Voglgsnag
 */


/* CHECK IF OPTION IS SELECTED
/------------------------*/
/**
  * @param string $value: input value to check
  * @param array/string $range: selected array/string value
  * @return selected attribute if input value is in post array
*/
function setSelected($value,$range) {
  if(!is_array($range)) {
    return ($value==$range) ? "selected='selected'" : "";
  } else {
    return (in_array($value,$range)) ? "selected='selected'" : "";
  }
}


/* CHECK IF CHECKBOX IS CHECKED
/------------------------*/
/**
  * @param string $value: input value to check
  * @param array/string $range: checked array/string value
  * @return checked attribute if input value is in post array
*/
function setChecked($value,$range) {
  if(!is_array($range)) {
    return ($value==$range) ? "checked='checked'" : "";
  } else {
    return (in_array($value,$range)) ? "checked='checked'" : "";
  }
}


/* GET POST
/------------------------*/
/**
  * @param string $name: variable name
  * @param $default: default text for nonexistent or empty variables
  * @return string from called value or default text
*/
function getFormPost(string $name, $default=""){
    // check if given variable exists
    if(isset($_REQUEST[$name])):
      $s = $_REQUEST[$name];
    elseif (isset($_POST[$name])):
      $s = $_POST[$name];
    elseif (isset($_GET[$name])):
      $s = $_GET[$name];
    else:
      $s = $default;
    endif;
    // return value
    return ($s) == "" ? $default : $s;
}


?>
