<?php

class ErrorView
{
  public static function emptyLoginError()
  {
    ?>
    Username is missing or Empty.
    <?php
  }

  public static function emptyMessageError()
  {
    ?>
    Message is missing or Empty.
    <?php
  }

  public static function userExistError()
  {
    ?>
    This username is already taken.
    <?php
  }

  public static function undefinedRequest($request)
  {
    ?>
    undefined request <?= $request ?>
    <?php
  }
}
