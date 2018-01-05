<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/TournamentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/TournamentView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Tournament/TournamentCreateForm.php";

class TournamentController extends BaseController
{
  public function showTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $parameters['id'];

    $tournamentModel = new TournamentModel();

    $tournament = $tournamentModel->getTournamentById($tournamentId);
    if($tournament === null)
    {
      $this->redirect("/not_found");
    }

    $tournamentView = new TournamentView();

    $tournamentView->render('Show', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'isUserAdmin' => true
    ]);
  }

  public function showTournamentMatchesAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $parameters['id'];

    $tournamentModel = new TournamentModel();

    $tournament = $tournamentModel->getTournamentById($tournamentId);
    if($tournament === null)
    {
      $this->redirect("/not_found");
    }

    $tournamentView = new TournamentView();

    $tournamentView->render('Matches', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'isUserAdmin' => true
    ]);
  }

  public function showTournamentAdminAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $parameters['id'];

    $tournamentModel = new TournamentModel();

    $tournament = $tournamentModel->getTournamentById($tournamentId);
    if($tournament === null)
    {
      $this->redirect("/not_found");
    }

    $tournamentView = new TournamentView();

    $tournamentView->render('Admin', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'isUserAdmin' => true
    ]);
  }

  public function createTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $userId = $session->getUserId();

    $form = new TournamentCreateForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();

      if($form->isValid())
      {
        $model = new TournamentModel();

        $tournamentId = $model->createTournament($userId, $form->getName());

        if($tournamentId !== null)
        {
          $this->redirect("/tournaments/$tournamentId");
        }
        else
        {
          $form->invalidateForm("name already in use");
        }
      }
    }

    $tournamentView = new TournamentView();

    $tournamentView->render('Create', [
      'session' => $session,
      'name' => $form->getName(),
      'form_errors' => $form->getErrors()
    ]);
  }

}