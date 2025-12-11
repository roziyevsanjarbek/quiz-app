<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        return redirect('/');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function myQuizzes()
    {
        return view('my-quizzes');
    }

    public function addQuizzes()
    {
        return view('add-quizzes');
    }

    public function takeQuiz()
    {
        return view('take-quiz');
    }
    public function uploadQuiz()
    {
        return view('upload-quiz');
    }

    public function updateQuizzes()
    {
        return view('update-quiz');
    }

    public  function profile()
    {
        return view('profile');
    }

    public function quiz()
    {
        return view('quiz-page');
    }

    public function start()
    {
        return view('start');
    }

    public function result()
    {
        return view('result');
    }

    public function userResult()
    {
        return view('user-result');
    }
}
