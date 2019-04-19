<?php
/**
 * @since       v0.1.0
 * @package     Dev-PHP
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */

namespace App\Directives;


class InputBox
{


    public static function input($name)
    {

        return "<div class=\"input-group mb-3\">
                  <div class=\"input-group-prepend\">
                    <span class=\"input-group-text\" id=\"basic-addon1\">@</span>
                  </div>
                  <input type=\"text\" class=\"form-control\" placeholder=\"Username\" aria-label=\"Username\" aria-describedby=\"basic-addon1\">
                </div>";
    }

}