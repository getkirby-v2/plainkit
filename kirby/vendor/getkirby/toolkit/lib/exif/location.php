<?php

namespace Exif;

/**
 * Returns the latitude and longitude values
 * for exif location data if available
 *
 * @package   Kirby Toolkit
 * @author    Bastian Allgeier <bastian@getkirby.com>
 * @link      http://getkirby.com
 * @copyright Bastian Allgeier
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
class Location {

  // latitude
  protected $lat;

  // longitude
  protected $lng;

  /**
   * Constructor
   *
   * @param array $exif The entire exif array
   */
  public function __construct($exif) {

    if(
      isset($exif['GPSLatitude']) &&
      isset($exif['GPSLatitudeRef']) &&
      isset($exif['GPSLongitude']) &&
      isset($exif['GPSLongitudeRef'])
    ) {
      $this->lat = $this->gps($exif['GPSLatitude'], $exif['GPSLatitudeRef']);
      $this->lng = $this->gps($exif['GPSLongitude'], $exif['GPSLongitudeRef']);
    }

  }

  /**
   * Returns the latitude
   *
   * @return float
   */
  public function lat() {
    return $this->lat;
  }

  /**
   * Returns the longitude
   *
   * @return float
   */
  public function lng() {
    return $this->lng;
  }

  /**
   * Converts the gps coordinates
   *
   * @param string $coord
   * @param string $hemi
   * @return float
   */
  protected function gps($coord, $hemi) {

    $degrees = count($coord) > 0 ? $this->num($coord[0]) : 0;
    $minutes = count($coord) > 1 ? $this->num($coord[1]) : 0;
    $seconds = count($coord) > 2 ? $this->num($coord[2]) : 0;

    $hemi = strtoupper($hemi);
    $flip = ($hemi == 'W' || $hemi == 'S') ? -1 : 1;

    return $flip * ($degrees + $minutes / 60 + $seconds / 3600);

  }

  /**
   * Converts coordinates to floats
   *
   * @param string $part
   * @return float
   */
  protected function num($part) {

    $parts = explode('/', $part);

    if(count($parts) <= 0) return 0;
    if(count($parts) == 1) return $parts[0];

    return floatval($parts[0]) / floatval($parts[1]);

  }

  /**
   * Converts the object into a nicely readable array
   *
   * @return array
   */
  public function toArray() {
    return array(
      'lat' => $this->lat(),
      'lng' => $this->lng()
    );
  }

  /**
   * Echos the entire location as lat, lng
   *
   * @return string
   */
  public function __toString() {
    return trim(trim($this->lat() . ', ' . $this->lng(), ','));
  }

  /**
   * Improved var_dump() output
   * 
   * @return array
   */
  public function __debuginfo() {
    return $this->toArray();
  }

}