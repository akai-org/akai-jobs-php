<?php
/*
 * Dawid Dziedzic, https://github.com/Gumkle?tab=repositories
 * I'm quite new to programming, leave some feedback on GitHub!
 */
namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeSeries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:series {object}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create series of given objects';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Check if user is trying to use right object for creating series
        $object = $this->argument('object');
        if($object == "series"){
            echo "This command can't call itself, dummy. Choose something else.\n";
            die();
        }
        $objectCommand = "php artisan make:".$object;

        // if object user wants to use is correct
        if($this->isObjectCorrect($objectCommand)){

            // receive options
            $options = $this->ask('Type in options and they will be added to every command that will execute, leave empty or type "exit" to quit script]', false);
            if($options == "exit")
                die();
            $testCommand = $objectCommand." ".$options;

            // check if options are valid
            while($options !== false && !$this->areOptionsCorrect($testCommand)){
                $options = $this->ask("Given options are invalid. Please type in correct command options, leave empty or type \"exit\" to quit");
                if($options == "exit")
                    die();
                $testCommand = $objectCommand." ".$options;
            }

            while(true){

                // ask for object's name
                $name = $this->ask("Type in object's name or \"exit\" to quit series command");

                // in case user wants to leave
                if($name == "exit")
                    die();

                if($options != "")
                    echo shell_exec($objectCommand." ".$name." ".$options);
                else
                    echo shell_exec($objectCommand." ".$name);

            }
        } else {
            echo "Given object is not valid Laravel object type. Please use one of the existing objects\n";
        }
    }

    /**
     * Checks if given object is correct
     * @param $command
     * @return bool
     */
    public function isObjectCorrect($command){
        $commandResult = shell_exec($command);
        return !strpos($commandResult, 'is not defined');
    }

    /**
     * Checks if options are correct
     * @param $command
     * @return bool
     */
    public function areOptionsCorrect($command){
        $commandResult = shell_exec($command);
        return !strpos($commandResult, 'does not exist');
    }
}
