<?php
/**
 * View Helper Class
 *
 * @author Najaf Ali
 **/
class ViewHelper {

  private $css_path;
  private $js_path;

  function __construct( $options = array() ) {
    $this->css_path = (isset($options['css_path'])) ? $options['css_path'] : '/css/';
    $this->js_path = (isset($options['js_path'])) ? $options['js_path'] : '/js/';
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
    if ( is_array( $sheet ) ) {
      return $this->map_and_concatenate_strings( $sheet, 'stylesheet_link_tag' );
    }
    return $this->html_tag( 'link', '', array(
      'rel' => 'stylesheet',
      'type' => 'text/css',
      'href' => "{$this->css_path}{$sheet}.css",
      'media' => $media
    ));
  }

  function javascript_include_tag( $script ) {
    if ( is_array( $script ) ) {
      return $this->map_and_concatenate_strings( $script, 'javascript_include_tag' );
    }
    return $this->html_tag( 'script', '', array(
      'type' => 'text/javascript',
      'src' => "{$this->js_path}{$script}.js"
      ),
      false
    );
  }

  private function map_and_concatenate_strings( $strings, $function ) {
    $return = '';
    foreach ( $strings as $string ) {
      $return .= $this->$function( $string );
    }
    return $return;
  }

  function meta_content_type( $content_type = "text/html; charset=utf-8" ) {
    return $this->html_tag( 'meta', '', array(
      'http-equiv' => 'Content-Type',
      'content' => $content_type 
    ));
  }
}
