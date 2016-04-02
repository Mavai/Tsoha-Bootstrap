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
      HelloWorldController::kurssit(); 
  });
  
  $routes->get('/aiheet', function () {
      HelloWorldController::aiheet(); 
  });
  
  $routes->get('/aihe', function () {
      HelloWorldController::aiheInfo(); 
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
