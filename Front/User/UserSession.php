<?php
/**
 * Created by Uprzejmy
 */

class UserSession
{
  private $id;
  private $token;
  private $session_key;
  private $email;
  private $user_id;
  private $logged = false;

  public function isUserLogged()
  {
    return $this->getLogged();
  }

  /**
   * @return mixed
   */
  public function getLogged()
  {
    return $this->logged;
  }

  /**
   * @param mixed $logged
   */
  public function setLogged($logged)
  {
    $this->logged = $logged;
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->id = $id;
  }

  /**
   * @return mixed
   */
  public function getToken()
  {
    return $this->token;
  }

  /**
   * @param mixed $token
   */
  public function setToken($token)
  {
    $this->token = $token;
  }

  /**
   * @return mixed
   */
  public function getSessionKey()
  {
    return $this->session_key;
  }

  /**
   * @param mixed $session_key
   */
  public function setSessionKey($session_key)
  {
    $this->session_key = $session_key;
  }

  /**
   * @return mixed
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email)
  {
    $this->email = $email;
  }

  /**
   * @return mixed
   */
  public function getUserId()
  {
    return $this->user_id;
  }

  /**
   * @param mixed $user_id
   */
  public function setUserId($user_id)
  {
    $this->user_id = $user_id;
  }

}