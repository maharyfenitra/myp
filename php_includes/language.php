<?php
   // require_once 'php_includes/field_controle.php';
require_once 'field_controle.php';
function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function curPageParamExcept($paramNameToSkip) {
 $pagePARAM = '?';
 foreach ($_GET as $key => $value) {
  if ($key != $paramNameToSkip) {
    $pagePARAM .= $key .'='.$value.'&';
  }
 }
 return $pagePARAM;
}

function getLocale($lang) {
 $locale = 'en_US';
 if ($lang == 'fr') $locale='fr_FR';
 if ($lang == 'de') $locale='de_DE';
 if ($lang == '_en') $locale='en_US';
 if ($lang == 'it') $locale='it_IT';
 if ($lang == 'es') $locale='es_ES';
 if ($lang == 'nl') $locale='nl_NL';
 if ($lang == 'pl') $locale='pl_PL';
 return $locale;

}

function getLangSelectOptionString() {
	$res = "<option value = '_en'>_en</option>";
	$res .= "<option value = 'fr'>fr</option>";
	$res .= "<option value = 'de'>de</option>";
	$res .= "<option value = 'es'>es</option>";
	$res .= "<option value = 'pl'>pl</option>";
	$res .= "<option value = 'nl'>nl</option>";
	$res .= "<option value = 'it'>it</option>";
return $res;
}

/* which languame out of an available set the user prefers most 
  
  $available_languages        array with language-tag-strings (must be lowercase) that are available 
  $http_accept_language    a HTTP_ACCEPT_LANGUAGE string (read from $_SERVER['HTTP_ACCEPT_LANGUAGE'] if left out) 
*/ 
function prefered_language ($available_languages,$http_accept_language="auto") { 
    // if $http_accept_language was left out, read it from the HTTP-Header 
    if ($http_accept_language == "auto") $http_accept_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : ''; 

    // standard  for HTTP_ACCEPT_LANGUAGE is defined under 
    // http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.4 
    // pattern to find is therefore something like this: 
    //    1#( language-range [ ";" "q" "=" qvalue ] ) 
    // where: 
    //    language-range  = ( ( 1*8ALPHA *( "-" 1*8ALPHA ) ) | "*" ) 
    //    qvalue         = ( "0" [ "." 0*3DIGIT ] ) 
    //            | ( "1" [ "." 0*3("0") ] ) 
    preg_match_all("/([[:alpha:]]{1,8})(-([[:alpha:]|-]{1,8}))?" . 
                   "(\s*;\s*q\s*=\s*(1\.0{0,3}|0\.\d{0,3}))?\s*(,|$)/i", 
                   $http_accept_language, $hits, PREG_SET_ORDER); 

    // default language (in case of no hits) is the first in the array 
    $bestlang = $available_languages[0]; 
    $bestqval = 0; 

    foreach ($hits as $arr) { 
        // read data from the array of this hit 
        $langprefix = strtolower ($arr[1]); 
        if (!empty($arr[3])) { 
            $langrange = strtolower ($arr[3]); 
            $language = $langprefix . "-" . $langrange; 
        } 
        else $language = $langprefix; 
        $qvalue = 1.0; 
        if (!empty($arr[5])) $qvalue = floatval($arr[5]); 
      
        // find q-maximal language  
        if (in_array($language,$available_languages) && ($qvalue > $bestqval)) { 
            $bestlang = $language; 
            $bestqval = $qvalue; 
        } 
        // if no direct hit, try the prefix only but decrease q-value by 10% (as http_negotiate_language does) 
        else if (in_array($langprefix,$available_languages) && (($qvalue*0.9) > $bestqval)) { 
            $bestlang = $langprefix; 
            $bestqval = $qvalue*0.9; 
        } 
    } 
    return $bestlang; 
} 


$available_langs = array(
    'en',// default
    'fr',
    'de',
    'es',
    'it'
);

 if(isSet($_GET['lang'])&&isValidField($_GET['lang'])) {
   $lang='_en';
//   echo "get<br>";
   if ($_GET['lang'] == 'fr') $lang='fr';
   if ($_GET['lang'] == 'de') $lang='de';
   if ($_GET['lang'] == 'es') $lang='es';
   if ($_GET['lang'] == 'pl') $lang='pl';
   if ($_GET['lang'] == 'nl') $lang='nl';
   if ($_GET['lang'] == 'it') $lang='it';
   if (!(setcookie("LangCookie", $lang))) $_SESSION['lang'] = $lang;	
  }
  elseif (isSet($_COOKIE["LangCookie"])) { 
	$lang = $_COOKIE["LangCookie"]; 
	//echo "cookie<br>"; 
  }
  elseif (isSet($_SESSION['lang'])) { 
	$lang = $_SESSION['lang']; 
	//echo "session<br>"; 
  }
  elseif (isSet($_SERVER['lang'])) {
	$lang = $_SESSION['lang'];  
	//echo "server<br>"; 
  }
  else { 
	$lang = prefered_language($available_langs);  
//echo "nav_prefered<br>"; 
  }
//  else $lang='_en';

//print_r(prefered_language($available_langs));
//echo "<br>";
//echo $lang;
?>
