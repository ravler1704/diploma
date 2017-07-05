<?php
namespace controllers;

use lib\Controller;


/*
 *
 */
class AuthController extends Controller {


    public function addAdminAction()
    {

    }


    public function login($login, $password)
    {
        $users = getUsers();
        foreach ($users as $user) {
            if ($user['login'] == $login && $user['password'] == getPassword($password)) {
                unset($user['password']);
                $_SESSION['user'] = $user;
                $_SESSION['flag'] = 'admin';
                return true;
            }
        }
        return false;
    }

    public function getPassword($password)
    {
        return $password;
    }

    public function getLoggedUserData()
    {
        if (empty($_SESSION['user'])) {
            return null;
        }
        return $_SESSION['user'];
    }

    public function isAuthorized()
    {
        return getLoggedUserData() !== null;
    }

    public function getUsers()
    {
        $path = __DIR__ . '/data/users.json';
        $fileData = file_get_contents($path);
        $data = json_decode($fileData, true);
        if (!$data) {
            return array();
        }
        return $data;
    }

    public function getUserName()
    {
        if (is_string($_SESSION['user'])){
            return $_SESSION['user'];
        } else {
            return $_SESSION['user']['name'];
        }
    }

    public function isPOST()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function getParam($name)
    {
        return filter_input(INPUT_POST, $name);
    }

    public function location($path)
    {
        header("Location: $path.php");
        die;
    }

    public function logout()
    {
        session_destroy();
        location('index');
    }


}