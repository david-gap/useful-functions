<?
/**
 *
 *
 * Layout functions
 * Author:      David Voglgsnag
 */



 /* ADDRESS BLOCK
 /------------------------*/
 /**
   * @param array $address: given address content
   * options are company, street, street2, zip, postalCode, city, phone, mobile, email
   * @return string price
 */
 function AddressBlock(array $address = array()){
   // vars
   $output = '';

   $output .= '<address>';
     $output .= key_exists('company' , $address) ? '<span rel="me" class="company">' . $address["company"] . '</span>' : '';
     $output .= key_exists('street' , $address) ? '<span class="street">' . $address["street"] . '</span>' : '';
     $output .= key_exists('street2' , $address) ? '<span class="street_add">' . $address["street2"] . '</span>' : '';
     $output .= key_exists('zip' , $address) && key_exists('city' , $address) ? '<span class="location">' : '';
       $output .= key_exists('postalCode' , $address) ? '<span class="postalcode">' . $address["postalCode"] . '</span>' : '';
       $output .= key_exists('city' , $address) ? '<span class="city">' . $address["city"] . '</span>' : '';
     $output .= key_exists('zip' , $address) && key_exists('city' , $address) ? '</span>' : '';
     $output .= key_exists('phone' , $address) ? '<a href="tel:' . $address["phone"] . '" class="call phone_nr">' . $address["phone"] . '</a>' : '';
     $output .= key_exists('mobile' , $address) ? '<a href="tel:' . $address["mobile"] . '" class="call mobile_nr">' . $address["mobile"] . '</a>' : '';
     $output .= key_exists('email' , $address) ? '<a href="mailto:' . $address["email"] . '" class="mail">' . $address["email"] . '</a>' : '';
   $output .= '</address>';

   return $output;
 }


?>
