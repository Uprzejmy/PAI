<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/TournamentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/TournamentView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Team/TeamCreateForm.php";

class TournamentController extends BaseController
{
  public function showTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $parameters['id'];


    $tournamentView = new TournamentView();

    $tournamentView->render('Show', [
      'session' => $session,
      'tournamentId' => $tournamentId
    ]);
  }

  public function createTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $userId = $session->getUserId();


    $tournamentView = new TournamentView();

    $tournamentView->render('Create', [
      'session' => $session
    ]);
  }

}