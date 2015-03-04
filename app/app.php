<?php


    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Task.php";


    session_start();
        if(empty($_SESSION['list_description'])){
            $_SESSION['list_description']=array();
        }


    $app=new Silex\Application();



$app->get("/",function(){

    $output="";

    $all_tasks=Task::getAll();

    if(!empty($all_tasks))
    {
        foreach(Task::getAll() as $task)
        {
            $output.="<p>".$task->getDescription()."</p>";
        }
    }

    $output.= "<form action='/tasks' method='post'>
                    <label for='description'>Task Description</label>
                    <input id='description' name='description' type='text'>
                    <button type='submit'>Add task</button>
                </form>" ;

    $output.= "<form action='/delete' method='post'>

                <button type='submit'>Clear All</button>
               </form>" ;


    return $output;
});

$app->post("/tasks", function(){


    if(!empty($_POST["description"]))
    {
        $task = new Task($_POST["description"]);
        $task->save();
        return
          "<h1> You created a task!</h1>
          <p>". $task->getDescription()."</p>
          <p><a href='/'>View your list</a></p>";
    }
    else{
    return "error " . "<a href='/'>please enter an item</a>";
    }





});

$app->post("/delete", function(){
    Task::clearAll();
    return
      "<h1> Your List is clear</h1><br/><a href='/'>Go Home to enter new list</a>";


});




    return $app;


?>
