<?php
/**
 * View Helper Class
 *
 * @author Najaf Ali
 **/
class ViewHelper {

  private $css_path;

  function __construct( $options = array() ) {
    $this->css_path = (isset($options['css_path'])) ? $options['css_path'] : '/css/';
  }
  /**
   * Html Tag based on tags, content and attributes
   * 
   * @param $tag string the html tag to return
   * @param $contents string the contents of the html tag
   * @param $attributes array array of attributes
   * @param $closable boolean if false, shows a closing tag even if no contents
   * @return $tag string the html tag
   **/
  function html_tag( $tag, $contents = '', $attributes = array(), $closable = true ) {
    if ( $contents == '' && $closable ) {
      return "<{$tag}{$this->attributes_to_string($attributes)} />\n";
    }
    return "<{$tag}{$this->attributes_to_string($attributes)}>{$contents}</{$tag}>\n";
  }

  /**
   * String representation of attributes
   *
   * @param $attributes array of attributes
   * @param $string string the string representation
   **/
  function attributes_to_string( $attributes ) {
    $string = '';
    foreach ($attributes as $attribute => $value ) {
      if ( $value === null ) { continue; }
      $string.= " {$attribute}=\"$value\"";
    }
    return $string;
  }

  function stylesheet_link_tag( $sheet, $media = null ) {
    return $this->html_tag( 'link', '', array(
      'rel' => 'stylesheet',
      'type' => 'text/css',
      'href' => "{$this->css_path}{$sheet}.css",
      'media' => $media
    ));
  }
}
