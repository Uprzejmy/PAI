<?php
/**
 * Created by Uprzejmy
 */

interface IForm
{
  function bindData();
  function validateData();
  function isValid();
  function getErrors();
}