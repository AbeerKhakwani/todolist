<?php


    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";


session_start();
        if(empty($_SESSION['list_description'])){
            $_SESSION['list_description']=array();
            }


$app=new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));


$app->get("/",function() use ($app) {
    return $app['twig']->render('/tasks.php', array('tasks' => Task::getAll()));
});

$app->post("/tasks", function() use ($app){
        $task = new Task($_POST["description"]);
        $task->save();
        return $app['twig']->render('/create_task.php');

});

$app->post("/delete", function(){
    Task::clearAll();
    return
      "<h1> Your List is clear</h1><br/><a href='/'>Go Home to enter new list</a>";


});




    return $app;


?>
