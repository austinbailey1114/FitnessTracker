<?php

namespace Carbon\Controllers;
use Carbon\Models\User;

class AuthController extends Controller {
    public function getSignIn($request, $response) {
        return $this->view->render($response, 'login.twig');
    }
    public function postSignIn($request, $response) {
		$auth = $this->auth->attempt(
            $request->getParam('username'),
            $request->getParam('password')
        );
        if (!$auth) {
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        return $response->withRedirect($this->router->pathFor('home'));
	}
}

?>
