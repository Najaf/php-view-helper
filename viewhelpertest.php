<?php
  require 'PHPUnit/Framework/TestCase.php';
  require 'viewhelper.php';

  class ViewHelperTest extends PHPUnit_Framework_TestCase {
    private $helper;
    function setUp() {
      $this->helper = new ViewHelper();
    }

    function test_html_tag() {
      $this->assertEquals(
        "<tag />\n",
        $this->helper->html_tag( 'tag' )
      );
    }

    function test_html_tag_unclosable() {
      $this->assertEquals(
        "<tag></tag>\n",
        $this->helper->html_tag( 'tag', '', array(), false )
      );
    }

    function test_html_tag_with_content() {
      $this->assertEquals(
        "<tag>content</tag>\n",
        $this->helper->html_tag( 'tag', 'content' )
      );
    }

    function test_html_tag_with_attributes() {
      $this->assertEquals(
        "<tag attr1=\"1\" attr2=\"2\" />\n",
        $this->helper->html_tag( 'tag', '', array(
          'attr1' => '1',
          'attr2' => '2'
        ))
      );
    }

    function test_html_tag_with_attributes_and_content() {
      $this->assertEquals(
        "<tag attr1=\"1\" attr2=\"2\" attr3=\"3\">content</tag>\n",
        $this->helper->html_tag( 'tag', 'content', array(
          'attr1' => '1',
          'attr2' => '2',
          'attr3' => '3'
        ) )
      );
    }

    function test_stylesheet_link_tag() {
      $this->assertEquals(
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/style.css\" />\n",
        $this->helper->stylesheet_link_tag( 'style' )
      );
    }

    function test_multiple_stylesheet_link_tags() {
      $this->assertEquals(
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/style.css\" />\n"
        ."<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/style2.css\" />\n"
        ."<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/style3.css\" />\n",
        $this->helper->stylesheet_link_tag( array( 'style', 'style2', 'style3' ) )
      );
    }

    function test_stylesheet_link_tag_with_media() {
      $this->assertEquals(
        "<link rel=\"stylesheet\" type=\"text/css\" href=\"/css/style.css\" media=\"print\" />\n",
        $this->helper->stylesheet_link_tag( 'style', 'print' )
      );
    }

    function test_javascript_include_tag() {
      $this->assertEquals(
        "<script type=\"text/javascript\" src=\"/js/script.js\"></script>\n",
        $this->helper->javascript_include_tag( 'script' )
      );
    }

    function test_multiple_javascript_include_tag() {
      $this->assertEquals(
        "<script type=\"text/javascript\" src=\"/js/script.js\"></script>\n"
        ."<script type=\"text/javascript\" src=\"/js/script2.js\"></script>\n"
        ."<script type=\"text/javascript\" src=\"/js/script3.js\"></script>\n",
        $this->helper->javascript_include_tag( array( 'script', 'script2', 'script3' ) )
      );
    }

    function test_meta_content_type() {
      $this->assertEquals(
        "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n",
        $this->helper->meta_content_type()
      );
    }

    function test_meta_keywords() {
      $this->assertEquals(
        "<meta name=\"keywords\" content=\"tom, dick, harry\" />\n",
        $this->helper->meta_keywords( array( 'tom', 'dick', 'harry' ) )
      );
    }
  }
