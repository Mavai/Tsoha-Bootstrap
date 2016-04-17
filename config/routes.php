<?php

  $routes->get('/', function() {
    HelloWorldController::etusivu(); 
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
  
  $routes->post('/aiheet/:id/new', function($id) {
      SubjectController::store($id);
  });
  
  $routes->get('/aiheet/:id/new', function($id) {
      SubjectController::create($id);
  });
  
  $routes->get('/aihe/:id/edit', function($id) {
      SubjectController::edit($id);
  });
  
  $routes->post('/aihe/:id/edit', function($id) {
      SubjectController::update($id);
  });
  
  $routes->post('/aihe/:id/destroy', function($id) {
      SubjectController::destroy($id);
  });