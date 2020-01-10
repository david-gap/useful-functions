<?
/**
 *
 *
 * Base functions
 * Author:      David Voglgsnag
 */



/* EXPLODE COMMA SEPERATED ARRAY
/------------------------*/
function AttrToArray(string $attr){
  // remove spaces from string
  $clean = str_replace(", ", ",", $attr);
  // create array
  $array = explode(',', $clean);

  return $array;
}


/* PRICE FORMAT
/------------------------*/
/**
  * @param string $preis: given price
  * @param string $seperator: seperates the $ from the cents
  * @return string price
*/
function formatPrice(int $preis = 0, string $seperator = "." ) {
    $preis += .00;
    return number_format($preis,2,$seperator," ");
}


/* BROWSER CHECK
/------------------------*/
/**
  * @return string current browser
*/
function get_browser_name() {
  $user_agent = $_SERVER['HTTP_USER_AGENT'];
  if (strpos($user_agent, 'Chrome')) return 'Chrome';
  elseif (strpos($user_agent, 'Safari')) return 'Safari';
  elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
  elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
  elseif (strpos($user_agent, 'Edge')) return 'Edge';
  elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'InternetExplorer';
  return 'Other';
}


/* GENERATE SHORT ID
/------------------------*/
/**
  * @param int $length: ID length
  * @param string $type: ID chars int/letters both on default
  * @return string random id
*/
function ShortID(int $length = 10, string $type = ''){
  if($type == 'int'):
    return substr(str_shuffle("0123456789"), 0, $length);
  elseif($type == 'letters'):
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
  else:
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $length);
  endif;
}


/* GOOGLE TAG MANAGER / ANALYTICS
/------------------------*/
/**
  * @param bool $trackingcode: your trackingcode id
  * @param bool $body: if GTM is active and body tag output target
  * @return string with script
*/
function GoogleTracking(string $trackingcode, bool $body = false){
  // vars
  $output = '';

  if(strpos($trackingcode, 'GTM-') === 0 && $body === false):
    // GTM head
    $output .= "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':";
    $output .= "new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],";
    $output .= "j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=";
    $output .= "'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);";
    $output .= "})(window,document,'script','dataLayer','" . $trackingcode . "');</script>";
  elseif(strpos($trackingcode, 'GTM-') === 0 && $body === true):
    // GTM body
    $output .= '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $trackingcode . '" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>';
  elseif(strpos($trackingcode, 'UA-') === 0 && $body === false):
    // analytics
    $output .= '<script async src="https://www.googletagmanager.com/gtag/js?id=' . $trackingcode . '"></script>';
    $output .= '<script>';
    $output .= 'window.dataLayer = window.dataLayer || [];';
    $output .= 'function gtag(){dataLayer.push(arguments);}';
    $output .= 'gtag("js", new Date());';
    $output .= 'gtag("config", "' . $trackingcode . '");';
    $output .= '</script>';
  endif;

  echo $output;
}


/* SORT ARRAY
/------------------------*/
/**
  * @param array $array: array to sort
  * @param string $on: select column to sort by
  * @param string $order: order direction
  * @return array sorted array
*/
function MultidArraySort(array $array = array(), string $on = "0", string $order = "ASC"){
  $new_array = array();
  $sortable_array = array();
  // fallback for special chars
  $CHARsearch   = array("Ä","ä","Ö","ö","Ü","ü","ß","-");
  $CHARreplace  = array("Ae","ae","Oe","oe","Ue","ue","ss"," ");
  if (count($array) > 0) {
      foreach ($array as $k => $v) {
          if (is_array($v)) {
              foreach ($v as $k2 => $v2) {
                  if ($k2 == $on) {
                      $sortable_array[$k] = str_replace($CHARsearch, $CHARreplace, $v2);
                  }
              }
          } else {
              $sortable_array[$k] = $v;
          }
      }
      switch ($order) {
          case "ASC":
              natcasesort($sortable_array);
          break;
          case "DESC":
              natcasesort($sortable_array);
              $sortable_array = array_reverse($sortable_array, true);
          break;
      }
      foreach ($sortable_array as $k => $v) {
          $new_array[$k] = $array[$k];
      }
  }
  return $new_array;
}


?>
