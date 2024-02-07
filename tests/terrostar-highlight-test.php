<?php

use PHPUnit\Framework\TestCase;

class HighlightTitleTextTest extends TestCase
{
    public function testHighlightTitleTextExists()
    {
        $this->assertTrue(function_exists('highlight_title_text'));
    }

    // public function testHighlightTitleTextFunctionality() {
    //     // This is a simplistic test assuming the function highlights "WordPress" word in titles
    //     $title = "Hello WordPress World";
    //     $expected = "Hello <span class='highlight'>WordPress</span> World";
    //     $result = Highlight_Title_Text($title);

    //     $this->assertEquals($expected, $result);
    // }
}
