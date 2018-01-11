<?php
/**
 * Created by Uprzejmy
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/Controller/BaseController.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/TournamentModel.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/View/TournamentView.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Tournament/TournamentCreateForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Forms/Tournament/TournamentJoinForm.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Model/BracketHelper.php";

class TournamentController extends BaseController
{
  public function showTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $parameters['id'];

    $tournamentModel = new TournamentModel();

    $tournament = $tournamentModel->getTournamentById($tournamentId);
    if ($tournament === null)
    {
      $this->redirect("/not_found");
    }

    if ($session->isUserLogged())
    {
      $isUserTournamentAdmin = $tournament->isAdmin($session->getUserId());
    }
    else
    {
      $isUserTournamentAdmin = false;
    }

    $bracketView = $tournamentModel->getBracketHtmlRepresentation($tournamentId);

    $tournamentView = new TournamentView();

    $tournamentView->render('Show', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'isUserAdmin' => $isUserTournamentAdmin,
      'isTournamentStarted' => $tournament->isStarted(),
      'isUserLogged' => $session->isUserLogged(),
      'bracketView' => $bracketView
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

    if ($session->isUserLogged())
    {
      $isUserTournamentAdmin = $tournament->isAdmin($session->getUserId());
    }
    else
    {
      $isUserTournamentAdmin = false;
    }

    $matches = $tournamentModel->getDetailedAndPlayedBracketMatches($tournamentId);

    $tournamentView = new TournamentView();

    $tournamentView->render('Matches', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'isUserAdmin' => $isUserTournamentAdmin,
      'isTournamentStarted' => $tournament->isStarted(),
      'isUserLogged' => $session->isUserLogged(),
      'matches' => $matches
    ]);
  }

  public function showTournamentTeamsAction($parameters)
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

    $isUserLogged = $session->isUserLogged();
    $isUserAdmin = false;

    if($isUserLogged)
    {
      $isUserAdmin = $tournament->isAdmin($session->getUserId());
    }

    $teams = $tournamentModel->getTournamentTeams($tournamentId);

    $tournamentView = new TournamentView();

    $tournamentView->render('Participants', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'teams' => $teams,
      'isUserLogged' => $isUserLogged,
      'isUserAdmin' => $isUserAdmin,
      'isTournamentStarted' => $tournament->isStarted(),
    ]);
  }

  public function showTournamentAdminAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $parameters['id'];

    $tournamentModel = new TournamentModel();

    $tournament = $tournamentModel->getTournamentById($tournamentId);
    if($tournament === null || !$tournament->isAdmin($session->getUserId()))
    {
      $this->redirect("/not_found");
    }

    $matchesToReport = $tournamentModel->getDetailedBracketMatchesAwaitingForScore($tournamentId);

    $tournamentView = new TournamentView();

    $tournamentView->render('Admin', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'matchesToReport' => $matchesToReport,
      'isUserAdmin' => $tournament->isAdmin($session->getUserId()),
      'isTournamentStarted' => $tournament->isStarted(),
    ]);
  }

  public function joinTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $userId = $session->getUserId();
    $tournamentId = $parameters['id'];

    $tournamentModel = new TournamentModel();

    $tournament = $tournamentModel->getTournamentById($tournamentId);
    if($tournament === null)
    {
      $this->redirect("/not_found");
    }

    if($tournament->isStarted())
    {
      $this->redirect("/tournaments/$tournamentId");
    }

    $form = new TournamentJoinForm();

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      $form->bindData();
      $form->validateData();

      if($form->isValid())
      {
        $teamModel = new TeamModel();

        //only team admin should be able to join the tournament
        if(!$teamModel->isUserAdminInTeam($form->getTeamId(), $userId))
        {
          $this->redirect("/tournaments/$tournamentId");
        }

        $tournamentModel->addTeamToTournament($form->getTournamentId(), $form->getTeamId());

        $this->redirect("/tournaments/$tournamentId");
      }
    }

    $teamModel = new TeamModel();
    $userAdminTeams = $teamModel->getTeamsByAdmin($userId);

    $tournamentView = new TournamentView();

    $tournamentView->render('Join', [
      'session' => $session,
      'tournamentId' => $tournamentId,
      'tournament' => $tournament,
      'isUserAdmin' => $tournament->isAdmin($userId),
      'isUserInTournament' => $tournamentModel->isUserInTournament($tournamentId, $userId),
      'userAdminTeams' => $userAdminTeams,
      'form_errors' => $form->getErrors()
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

  public function removeTeamFromTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $teamId = $_POST['teamId'];
    $tournamentId = $_POST['tournamentId'];

    $tournamentModel = new TournamentModel();

    if(!$tournamentModel->isUserAdminInTournament($tournamentId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    $tournamentModel->removeTeamFromTournament($tournamentId, $teamId);

    $this->redirect("/tournaments/participants/$tournamentId");
  }

  public function startTournamentAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];
    $tournamentId = $_POST['tournamentId'];

    $tournamentModel = new TournamentModel();

    if(!$tournamentModel->isUserAdminInTournament($tournamentId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    $tournamentModel->startTournament($tournamentId);

    $this->redirect("/tournaments/$tournamentId");
  }

  public function reportScoreAction($parameters)
  {
    /** @var UserSession $session */
    $session = $parameters['session'];

    if($_SERVER['REQUEST_METHOD'] !== 'POST')
    {
      $this->redirect("/homepage");
    }

    $matchId = $_POST['matchId'];
    $tournamentId = $_POST['tournamentId'];

    $tournamentModel = new TournamentModel();

    if(!$tournamentModel->isUserAdminInTournament($tournamentId, $session->getUserId()))
    {
      $this->redirect("/homepage");
    }

    $leftScore = $_POST['leftScore'];
    $rightScore = $_POST['rightScore'];

    $tournamentModel->reportScore($matchId, $leftScore, $rightScore);

    $this->redirect("/tournaments/admin/$tournamentId");
  }
}