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

$routes->get('/login', function() {
    try {
        $previous = $_SERVER['HTTP_REFERER'];
        UserController::login($previous);
    } catch (Exception $ex) {
        UserController::login(null);
    }
});

$routes->post('/login', function() {
    UserController::handle_login();
});

$routes->post('/logout', function() {
    $previous = $_SERVER['HTTP_REFERER'];
    UserController::logout($previous);
});

$routes->get('/suoritus/:id', function ($id) {
    AssignmentController::show($id);
});

$routes->post('/kurssit', function() {
    CourseController::store();
});

$routes->post('/kurssi/:id/destroy', function($id) {
    CourseController::destroy($id);
});

$routes->get('/assignment/new', function() {
    AssignmentController::create();
});

$routes->post('/assignment/new', function() {
    AssignmentController::store();
});

$routes->post('/suoritus/:id/destroy', function($id) {
    AssignmentController::destroy($id);
});

$routes->get('/suoritus/:id/edit', function($id) {
    AssignmentController::edit($id);
});

$routes->post('/suoritus/:id/edit', function($id) {
    AssignmentController::update($id);
});

$routes->get('/oppilas/:id', function($studentnumber) {
    StudentController::show($studentnumber);
});

$routes->get('/oppilaat', function() {
    StudentController::index();
});

$routes->get('/register', function() {
    TeacherController::create();
});

$routes->post('/register', function() {
    TeacherController::store();
});

$routes->get('/oppilas/:studentnumber/edit', function($studentnumber) {
    StudentController::edit($studentnumber);
});

$routes->post('/oppilas/:studentnumber/edit', function($studentnumber) {
    StudentController::update($studentnumber);
});

$routes->get('/opettajat', function() {
    TeacherController::index();
});

$routes->get('/opettaja/:id/edit', function($id) {
    TeacherController::edit($id);
});

$routes->post('/opettaja/:id/edit', function($id) {
    TeacherController::update($id);
});

$routes->post('/oppilas/:studentnumber/destroy', function($studentnumber) {
    StudentController::destroy($studentnumber);
});

$routes->post('/opettaja/:id/destroy', function($id) {
    TeacherController::destroy($id);
});