<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
