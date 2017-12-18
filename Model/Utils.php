<?php
/**
 * Created by Uprzejmy
 */

class Utils
{
  public static function getDateFromStringDatetime($stringDate)
  {
    return (new DateTime($stringDate))->format('Y-m-d');
  }
}