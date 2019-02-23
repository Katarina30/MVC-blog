<?php

class Pages extends Controller
{


    public function __construct()
    {

    }
    public function index()
    {
        $data = [
            'title' => 'Postovi',
            'description' => 'Pregled postova upotrebom MVC-a'
        ];

        $this->view('pages/index', $data);

    }

}