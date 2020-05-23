<?php
declare(strict_types=1);

namespace DailyNewspaper\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use DailyNewspaper\Model\DbClass;
use DailyNewspaper\Model\User;

class Login extends ControllerBase
{
    private User $user;

    public function __construct(Engine $plates, User $user)
    {
        parent::__construct($plates);
        $this->user = $user;
    }

    public function execute(ServerRequestInterface $request)
    {
        if($request->getMethod() === 'GET')
        {
            echo $this->plates->render('login');
        }
        else
        {
            $userArray = $request->getParsedBody();
            $success = $this->user::login($userArray);
            if(!$success)
            {
                parent::error(401, 'Non sei autorizzato ad accedere.');
            }
            else
            {
                parent::redirect('/');
            }

        }
    }
}