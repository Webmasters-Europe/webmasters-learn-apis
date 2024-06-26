<?php

use App\Http\Resources\Body as BodyResource;
use App\Http\Resources\Film as FilmResource;
use App\Http\Resources\People as PeopleResource;
use App\Http\Resources\Planet as PlanetResource;
use App\Http\Resources\Solar as SolarResource;
use App\Http\Resources\Specie as SpecieResource;
use App\Http\Resources\Starship as StarshipResource;
use App\Http\Resources\Swapi as SwapiResource;
use App\Http\Resources\Transport as TransportResource;
use App\Http\Resources\Vehicle as VehicleResource;
use App\Models\Body;
use App\Models\Film;
use App\Models\People;
use App\Models\Planet;
use App\Models\Specie;
use App\Models\Starship;
use App\Models\Transport;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::domain(config('settings.swapi_url'))->group(function () {
    Route::get('/', function () {
        return new SwapiResource(null);
    })->name('swapi.root');

    Route::get('/films', function () {
        $films = QueryBuilder::for(Film::class)
        ->allowedFilters(['director', 'producer', 'title'])
        ->get();

        return $films ? $films : FilmResource::collection(Film::all());
    })->name('swapi.films');

    Route::get('/films/{id}', function ($domain, $id) {
        return new FilmResource(Film::findOrFail($id));
    })->name('swapi.film');

    Route::get('/people', function () {
        $peoples = QueryBuilder::for(People::class)
        ->allowedFilters(['name'])
        ->get();

        return $peoples ? $peoples : PeopleResource::collection(People::all());
    })->name('swapi.people');

    Route::get('/people/{id}', function ($domain, $id) {
        return new PeopleResource(People::findOrFail($id));
    })->name('swapi.person');

    Route::get('/planets', function () {
        $planets = QueryBuilder::for(Planet::class)
        ->allowedFilters(['climate', 'name', 'terrain'])
        ->get();

        return $planets ? $planets : PlanetResource::collection(Planet::all());
    })->name('swapi.planets');

    Route::get('/planets/{id}', function ($domain, $id) {
        return new PlanetResource(Planet::findOrFail($id));
    })->name('swapi.planet');

    Route::get('/species', function () {
        $species = QueryBuilder::for(Specie::class)
        ->allowedFilters(['classification', 'name', 'designation', 'language'])
        ->get();

        return $species ? $species : SpecieResource::collection(Specie::all());
    })->name('swapi.species');

    Route::get('/species/{id}', function ($domain, $id) {
        return new SpecieResource(Specie::findOrFail($id));
    })->name('swapi.speciment');

    Route::get('/starships', function () {
        $starships = QueryBuilder::for(Starship::class)
        ->allowedFilters(['starship_class', 'MGLT'])
        ->get();

        return $starships ? $starships : StarshipResource::collection(Starship::all());
    })->name('swapi.starships');

    Route::get('/starships/{id}', function ($domain, $id) {
        return new StarshipResource(Starship::findOrFail($id));
    })->name('swapi.starship');

    Route::get('/transport', function () {
        $transport = QueryBuilder::for(Transport::class)
        ->allowedFilters(['consumables', 'name', 'cargo_capacity', 'passengers', 'max_atmosphering_speed', 'crew', 'length', 'cost_in_credits', 'manufacturer'])
        ->get();

        return $transport ? $transport : TransportResource::collection(Transport::all());
    })->name('swapi.transports');

    Route::get('/transport/{id}', function ($domain, $id) {
        return new TransportResource(Transport::findOrFail($id));
    })->name('swapi.transport');

    Route::get('/vehicles', function () {
        $vehicles = QueryBuilder::for(Vehicle::class)
        ->allowedFilters(['vehicle_class'])
        ->get();

        return $vehicles ? $vehicles : VehicleResource::collection(Vehicle::all());
    })->name('swapi.vehicles');

    Route::get('/vehicles/{id}', function ($domain, $id) {
        return new VehicleResource(Vehicle::findOrFail($id));
    })->name('swapi.vehicle');

    Route::fallback(function () {
        return response()->json(['message' => 'Not Found'], 404);
    });
});

Route::domain(config('settings.solar_url'))->group(function () {
    Route::get('/', function () {
        return new SolarResource(null);
    })->name('solar.root');

    Route::get('/bodies', function () {
        $bodies = QueryBuilder::for(Body::class)
    ->allowedFilters(['alternativeName', 'name', 'discoveredBy'])
    ->get();

        return $bodies ? $bodies : BodyResource::collection(Body::all());
    })->name('solar.bodies');

    Route::get('/bodies/{id}', function ($domain, $id) {
        return new BodyResource(Body::findOrFail($id));
    })->name('solar.body');

    Route::fallback(function () {
        return response()->json(['message' => 'Not Found'], 404);
    });
});
