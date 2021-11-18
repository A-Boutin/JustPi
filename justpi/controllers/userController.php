<?php

	require_once("../model/user.php");
	
	class UserController{

        function login() {
            if (isset($_POST['action'])) {
                $user = new User();
                $user = $user->find($_POST['username']);

                if ($user != null && password_verify($_POST['password'], $user->pass_hash)) {
                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['username'] = $user->username;
                    header('location:' . BASE . '/user/mainPage');
                } else
                    header('location:' . BASE . '/Default/login?error=Wrong username or password.');
            } else {
                $this->view('Login/login');
            }
        }

        function logout() {
            session_destroy();
            header('location:' . BASE . '/Login/login');
        }
	}
?>