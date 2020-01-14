<?php

/**
 * Html
 *
 * Html builder for the most common elements
 *
 * @package   Kirby Toolkit
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Html {

  /**
   * Can be used to switch to trailing slashes if required
   * 
   * ```php
   * html::$void = ' />'
   * ```
   * 
   * @var string $void
   */
  public static $void = '>';

  /**
   * An internal store for a html entities translation table
   *
   * @return array
   */
  public static $entities = array(
    '&nbsp;' => '&#160;', '&iexcl;' => '&#161;', '&cent;' => '&#162;', '&pound;' => '&#163;', '&curren;' => '&#164;', '&yen;' => '&#165;', '&brvbar;' => '&#166;', '&sect;' => '&#167;',
    '&uml;' => '&#168;', '&copy;' => '&#169;', '&ordf;' => '&#170;', '&laquo;' => '&#171;', '&not;' => '&#172;', '&shy;' => '&#173;', '&reg;' => '&#174;', '&macr;' => '&#175;',
    '&deg;' => '&#176;', '&plusmn;' => '&#177;', '&sup2;' => '&#178;', '&sup3;' => '&#179;', '&acute;' => '&#180;', '&micro;' => '&#181;', '&para;' => '&#182;', '&middot;' => '&#183;',
    '&cedil;' => '&#184;', '&sup1;' => '&#185;', '&ordm;' => '&#186;', '&raquo;' => '&#187;', '&frac14;' => '&#188;', '&frac12;' => '&#189;', '&frac34;' => '&#190;', '&iquest;' => '&#191;',
    '&Agrave;' => '&#192;', '&Aacute;' => '&#193;', '&Acirc;' => '&#194;', '&Atilde;' => '&#195;', '&Auml;' => '&#196;', '&Aring;' => '&#197;', '&AElig;' => '&#198;', '&Ccedil;' => '&#199;',
    '&Egrave;' => '&#200;', '&Eacute;' => '&#201;', '&Ecirc;' => '&#202;', '&Euml;' => '&#203;', '&Igrave;' => '&#204;', '&Iacute;' => '&#205;', '&Icirc;' => '&#206;', '&Iuml;' => '&#207;',
    '&ETH;' => '&#208;', '&Ntilde;' => '&#209;', '&Ograve;' => '&#210;', '&Oacute;' => '&#211;', '&Ocirc;' => '&#212;', '&Otilde;' => '&#213;', '&Ouml;' => '&#214;', '&times;' => '&#215;',
    '&Oslash;' => '&#216;', '&Ugrave;' => '&#217;', '&Uacute;' => '&#218;', '&Ucirc;' => '&#219;', '&Uuml;' => '&#220;', '&Yacute;' => '&#221;', '&THORN;' => '&#222;', '&szlig;' => '&#223;',
    '&agrave;' => '&#224;', '&aacute;' => '&#225;', '&acirc;' => '&#226;', '&atilde;' => '&#227;', '&auml;' => '&#228;', '&aring;' => '&#229;', '&aelig;' => '&#230;', '&ccedil;' => '&#231;',
    '&egrave;' => '&#232;', '&eacute;' => '&#233;', '&ecirc;' => '&#234;', '&euml;' => '&#235;', '&igrave;' => '&#236;', '&iacute;' => '&#237;', '&icirc;' => '&#238;', '&iuml;' => '&#239;',
    '&eth;' => '&#240;', '&ntilde;' => '&#241;', '&ograve;' => '&#242;', '&oacute;' => '&#243;', '&ocirc;' => '&#244;', '&otilde;' => '&#245;', '&ouml;' => '&#246;', '&divide;' => '&#247;',
    '&oslash;' => '&#248;', '&ugrave;' => '&#249;', '&uacute;' => '&#250;', '&ucirc;' => '&#251;', '&uuml;' => '&#252;', '&yacute;' => '&#253;', '&thorn;' => '&#254;', '&yuml;' => '&#255;',
    '&fnof;' => '&#402;', '&Alpha;' => '&#913;', '&Beta;' => '&#914;', '&Gamma;' => '&#915;', '&Delta;' => '&#916;', '&Epsilon;' => '&#917;', '&Zeta;' => '&#918;', '&Eta;' => '&#919;',
    '&Theta;' => '&#920;', '&Iota;' => '&#921;', '&Kappa;' => '&#922;', '&Lambda;' => '&#923;', '&Mu;' => '&#924;', '&Nu;' => '&#925;', '&Xi;' => '&#926;', '&Omicron;' => '&#927;',
    '&Pi;' => '&#928;', '&Rho;' => '&#929;', '&Sigma;' => '&#931;', '&Tau;' => '&#932;', '&Upsilon;' => '&#933;', '&Phi;' => '&#934;', '&Chi;' => '&#935;', '&Psi;' => '&#936;',
    '&Omega;' => '&#937;', '&alpha;' => '&#945;', '&beta;' => '&#946;', '&gamma;' => '&#947;', '&delta;' => '&#948;', '&epsilon;' => '&#949;', '&zeta;' => '&#950;', '&eta;' => '&#951;',
    '&theta;' => '&#952;', '&iota;' => '&#953;', '&kappa;' => '&#954;', '&lambda;' => '&#955;', '&mu;' => '&#956;', '&nu;' => '&#957;', '&xi;' => '&#958;', '&omicron;' => '&#959;',
    '&pi;' => '&#960;', '&rho;' => '&#961;', '&sigmaf;' => '&#962;', '&sigma;' => '&#963;', '&tau;' => '&#964;', '&upsilon;' => '&#965;', '&phi;' => '&#966;', '&chi;' => '&#967;',
    '&psi;' => '&#968;', '&omega;' => '&#969;', '&thetasym;' => '&#977;', '&upsih;' => '&#978;', '&piv;' => '&#982;', '&bull;' => '&#8226;', '&hellip;' => '&#8230;', '&prime;' => '&#8242;',
    '&Prime;' => '&#8243;', '&oline;' => '&#8254;', '&frasl;' => '&#8260;', '&weierp;' => '&#8472;', '&image;' => '&#8465;', '&real;' => '&#8476;', '&trade;' => '&#8482;', '&alefsym;' => '&#8501;',
    '&larr;' => '&#8592;', '&uarr;' => '&#8593;', '&rarr;' => '&#8594;', '&darr;' => '&#8595;', '&harr;' => '&#8596;', '&crarr;' => '&#8629;', '&lArr;' => '&#8656;', '&uArr;' => '&#8657;',
    '&rArr;' => '&#8658;', '&dArr;' => '&#8659;', '&hArr;' => '&#8660;', '&forall;' => '&#8704;', '&part;' => '&#8706;', '&exist;' => '&#8707;', '&empty;' => '&#8709;', '&nabla;' => '&#8711;',
    '&isin;' => '&#8712;', '&notin;' => '&#8713;', '&ni;' => '&#8715;', '&prod;' => '&#8719;', '&sum;' => '&#8721;', '&minus;' => '&#8722;', '&lowast;' => '&#8727;', '&radic;' => '&#8730;',
    '&prop;' => '&#8733;', '&infin;' => '&#8734;', '&ang;' => '&#8736;', '&and;' => '&#8743;', '&or;' => '&#8744;', '&cap;' => '&#8745;', '&cup;' => '&#8746;', '&int;' => '&#8747;',
    '&there4;' => '&#8756;', '&sim;' => '&#8764;', '&cong;' => '&#8773;', '&asymp;' => '&#8776;', '&ne;' => '&#8800;', '&equiv;' => '&#8801;', '&le;' => '&#8804;', '&ge;' => '&#8805;',
    '&sub;' => '&#8834;', '&sup;' => '&#8835;', '&nsub;' => '&#8836;', '&sube;' => '&#8838;', '&supe;' => '&#8839;', '&oplus;' => '&#8853;', '&otimes;' => '&#8855;', '&perp;' => '&#8869;',
    '&sdot;' => '&#8901;', '&lceil;' => '&#8968;', '&rceil;' => '&#8969;', '&lfloor;' => '&#8970;', '&rfloor;' => '&#8971;', '&lang;' => '&#9001;', '&rang;' => '&#9002;', '&loz;' => '&#9674;',
    '&spades;' => '&#9824;', '&clubs;' => '&#9827;', '&hearts;' => '&#9829;', '&diams;' => '&#9830;', '&quot;' => '&#34;', '&amp;' => '&#38;', '&lt;' => '&#60;', '&gt;' => '&#62;', '&OElig;' => '&#338;',
    '&oelig;' => '&#339;', '&Scaron;' => '&#352;', '&scaron;' => '&#353;', '&Yuml;' => '&#376;', '&circ;' => '&#710;', '&tilde;' => '&#732;', '&ensp;' => '&#8194;', '&emsp;' => '&#8195;',
    '&thinsp;' => '&#8201;', '&zwnj;' => '&#8204;', '&zwj;' => '&#8205;', '&lrm;' => '&#8206;', '&rlm;' => '&#8207;', '&ndash;' => '&#8211;', '&mdash;' => '&#8212;', '&lsquo;' => '&#8216;',
    '&rsquo;' => '&#8217;', '&sbquo;' => '&#8218;', '&ldquo;' => '&#8220;', '&rdquo;' => '&#8221;', '&bdquo;' => '&#8222;', '&dagger;' => '&#8224;', '&Dagger;' => '&#8225;', '&permil;' => '&#8240;',
    '&lsaquo;' => '&#8249;', '&rsaquo;' => '&#8250;', '&euro;' => '&#8364;'
  );

  /**
   * Checks if a tag is self-closing
   * 
   * @param string $tag
   * @return param
   */
  public static function isVoid($tag) {

    $void = array(
      'area', 
      'base', 
      'br', 
      'col', 
      'command', 
      'embed', 
      'hr', 
      'img', 
      'input',
      'keygen', 
      'link', 
      'meta', 
      'param', 
      'source', 
      'track', 
      'wbr',
    );

    return in_array(strtolower($tag), $void);

  }

  /**
   * Returns the full array with all HTML entities
   *
   * @return array
   */
  public static function entities() {
    return static::$entities;
  }

  /**
   * Converts a string to a html-safe string
   *
   * @param  string  $string
   * @param  boolean $keepTags True: lets stuff inside html tags untouched.
   * @return string  The html string
   */
  public static function encode($string, $keepTags = true) {
    if($keepTags) {
      return stripslashes(implode('', preg_replace_callback('/^([^<].+[^>])$/', function($match) {
        return htmlentities($match[1], ENT_COMPAT, 'utf-8');
      }, preg_split('/(<.+?>)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE))));
    } else {
      return htmlentities($string, ENT_COMPAT, 'utf-8');
    }
  }

  /**
   * Removes all html tags and encoded chars from a string
   *
   * <code>
   *
   * echo html::decode('some <em>crazy</em> stuff');
   * // output: some uber crazy stuff
   *
   * </code>
   *
   * @param  string  $string
   * @return string  The html string
   */
  public static function decode($string) {
    $string = strip_tags($string);
    return html_entity_decode($string, ENT_COMPAT, 'utf-8');
  }

  /**
   * Converts lines in a string into html breaks
   *
   * @param string $string
   * @return string
   */
  public static function breaks($string) {
    return nl2br($string);
  }

  /**
   * Generates an Html tag with optional content and attributes
   *
   * @param string $name The name of the tag, i.e. "a"
   * @param mixed $content The content if availble. Pass null to generate a self-closing tag, Pass an empty string to generate empty content
   * @param array $attr An associative array with additional attributes for the tag
   * @return string The generated Html
   */
  public static function tag($name, $content = null, $attr = array()) {

    if(is_array($content)) {
      $attr    = $content;
      $content = null;
    }

    $html = '<' . $name;
    $attr = static::attr($attr);

    if(!empty($attr)) $html .= ' ' . $attr;

    if(static::isVoid($name)) {
      $html .= static::$void;
    } else {
      $html .= '>' . $content . '</' . $name . '>';
    }

    return $html;

  }

  /**
   * Generates a single attribute or a list of attributes
   *
   * @param string $name mixed string: a single attribute with that name will be generated. array: a list of attributes will be generated. Don't pass a second argument in that case.
   * @param string $value if used for a single attribute, pass the content for the attribute here
   * @return string the generated html
   */
  public static function attr($name, $value = null) {
    if(is_array($name)) {
      $attributes = array();
      foreach($name as $key => $val) {
        $a = static::attr($key, $val);
        if($a) $attributes[] = $a;
      }
      return implode(' ', $attributes);
    }

    if($value === null || $value === '' || $value === []) {
      return false;
    } else if($value === ' ') {
      return strtolower($name) . '=""';      
    } else if(is_bool($value)) {
      return $value === true ? strtolower($name) : '';
    } else {
      if(is_array($value)) {
        if(isset($value['value']) && isset($value['escape'])) {
          $value = $value['escape'] === true ? htmlspecialchars($value['value']) : $value['value'];
        } else {
          $value = implode(' ', $value);
        }
      } else {
        $value = htmlspecialchars($value);
      }
      return strtolower($name) . '="' . $value . '"';      
    }

  }

  /**
   * Generates an a tag
   *
   * @param string $href The url for the a tag
   * @param mixed $text The optional text. If null, the url will be used as text
   * @param array $attr Additional attributes for the tag
   * @return string the generated html
   */
  public static function a($href, $text = null, $attr = array()) {
    $attr = array_merge(array('href' => $href), $attr);
    if(empty($text)) $text = $href;
    // add rel=noopener to target blank links to improve security
    if(a::get($attr, 'target') === '_blank' && empty($attr['rel'])) {
      $attr['rel'] = 'noopener noreferrer';
    }
    return static::tag('a', $text, $attr);
  }

  /**
   * Generates an "a mailto" tag
   *
   * @param string $email The url for the a tag
   * @param mixed $text The optional text. If null, the url will be used as text
   * @param array $attr Additional attributes for the tag
   * @return string the generated html
   */
  public static function email($email, $text = null, $attr = array()) {
    if(empty($text)) {
      // show only the eMail address without additional parameters (if the 'text' argument is empty)
      $text = str::encode(a::first(str::split($email, '?'))); 
    }
    $email = str::encode($email);
    $attr  = array_merge([
      'href' => [
        'value'  => 'mailto:' . $email,
        'escape' => false
      ]
    ], $attr);
    return static::tag('a', $text, $attr);
  }

  /**
   * Generates an img tag
   *
   * @param string $src The url of the image
   * @param array $attr Additional attributes for the image tag
   * @return string the generated html
   */
  public static function img($src, $attr = array()) {
    $attr = array_merge(array('src' => $src, 'alt' => pathinfo($src, PATHINFO_FILENAME)), $attr);
    return static::tag('img', null, $attr);
  }

  /**
   * Generates a HTML5 shiv script tag with additional comments for older IEs
   * @deprecated
   *
   * @return string the generated html
   */
  public static function shiv() {
    trigger_error('The html::shiv() method is deprecated and should not be used anymore.', E_USER_DEPRECATED);
    
    return '<!--[if lt IE 9]>' . PHP_EOL .
           '<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>' . PHP_EOL .
           '<![endif]-->' . PHP_EOL;
  }

}
