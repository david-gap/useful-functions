<?
/**
 *
 *
 * Date functions
 * Author:      David Voglgsnag
 */



/* GET CURRENT LANGUAGE
/------------------------*/
/**
  * @return string current language code
*/
function getCurrentLang(){
  // check if wpml oder polylang is active
  if (class_exists('SitePress')) {
    // WPML
    return ICL_LANGUAGE_CODE;
  } elseif(function_exists('pll_the_languages')){
    // POLYLANG
    return pll_current_language();
  } else {
    // LANGUAGE FALLBACK
     return substr(get_locale(), 0, 2);
  }
}


/* FILTER BY TAXONIMIES
/------------------------*/
/**
  * @param string $tax: taxonomy name
  * @param array $terms: taxonomy id
  * @return array filter array
*/
function WPqueryTerm(string $tax = "", array $terms = array(null)){
  $filter = array('relation' => 'OR');
  foreach ($terms as $key => $value) {
    $filter = array(
        'taxonomy'  => $tax,
        'field'     => 'term_id',
        'terms'     => $terms
    );
  }
  return $filter;
}

?>
