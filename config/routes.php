<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/etusivu', function () {
      HelloWorldController::etusivu(); 
  });
  
  $routes->get('/kurssit', function () {
      CourseController::index();
  });
  
  $routes->get('/aihe/:id', function ($id) {
      SubjectController::show($id);
  });
  
  $routes->get('/aihe_muokkaus', function () {
      HelloWorldController::aiheenMuokkaus(); 
  });
  
  $routes->get('/kurssi_lisays', function () {
      HelloWorldController::kurssinLisays(); 
  });
  
  $routes->get('/aihe_lisays', function () {
      HelloWorldController::aiheenLisays(); 
  });
  
  $routes->get('/aiheet/:id', function ($id) {
      SubjectController::index($id); 
  });
  
  $routes->post('/aiheet', function() {
      SubjectController::store();
  });
  
  $routes->get('/aiheet/new', function() {
      SubjectController::create();
  });
