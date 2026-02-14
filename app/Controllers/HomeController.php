<?php

    class HomeController extends BaseController
    {
         private $coreModel;

        public function __construct()
        {
            $this->coreModel = new CoreModel();
        }
        public function index()
        {
            //$this->renderView('layouts-part/landingpage' /*, $data */);
            $this->renderView('main/dashboard' /*, $data */);
        }
        public function landingpage()
        {
            $this->renderView('layouts-part/landingpage' /*, $data */);
        }
        public function home()
        {
            $this->renderView('layouts-part/home' /*, $data */);
        }
    }
