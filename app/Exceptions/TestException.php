<?php
/**
 * @since       v0.1.0
 * @package     Dev-PHP
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */

namespace App\Exceptions;


class TestException extends \Exception
{
    public function render($request)
    {
        // instead of $exception instanceof TestException in handler render()
        //response()->view('errors.custom.myexception', [], 500);
        return redirect('/');
    }

}