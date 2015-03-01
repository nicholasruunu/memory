<?php namespace App\Providers;

use App\Http\Controllers\MemoryController;
use Illuminate\Support\ServiceProvider;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleClassNameInflector;
use League\Tactician\Setup\QuickStart;
use Memory\Commands\StartGame;
use Memory\Commands\StartGameHandler;
use Memory\PlayingField\DeckGenerator;
use Memory\Events\EventDispatcher;
use Memory\Events\GameWasStarted;

class MemoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(EventDispatcher $eventDispatcher)
    {
        $eventDispatcher->addListener(
            GameWasStarted::class,
            [$this->app->make(MemoryController::class), 'gameWasStarted']
        );

        QuickStart::create([
            StartGame::class => $this->app->make(StartGameHandler::class),
        ]);
    }

    /**
     * Register any application services.
     *
     * This service provider is a great spot to register your various container
     * bindings with the application. As you can see, we are registering our
     * "Registrar" implementation here. You can add your own bindings too!
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(EventDispatcher::class, function() {
            return new EventDispatcher;
        });

        $this->app->bind(StartGameHandler::class, function($app) {
            return new StartGameHandler(
                $app[EventDispatcher::class],
                $app[DeckGenerator::class]
            );
        });

        $this->app->bind(CommandBus::class, function($app) {
            $locator = new InMemoryLocator;
            $locator->addHandler($app[StartGameHandler::class], StartGame::class);

            $handlerMiddleware = new CommandHandlerMiddleware(
                $locator,
                new HandleClassNameInflector
            );

            return new CommandBus([$handlerMiddleware]);
        });

        $this->app->bind(DeckGenerator::class, function() {
            return new DeckGenerator;
        });
    }

}
