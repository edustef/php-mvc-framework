<?php

namespace app\core\exceptions;

class NotFoundException extends \Exception
{
  protected $code = 404;
  protected $message = 'Sorry! The page you\'re trying to access was not found not found :(';
}
