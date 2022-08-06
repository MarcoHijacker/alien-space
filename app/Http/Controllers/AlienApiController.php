<?php

namespace App\Http\Controllers;

use Faker\Generator;
use App\Models\Alien;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlienApiController extends Controller
{
    // Random creation - Create method - OK!
    public function create(Generator $faker) 
    {
        $alien = new Alien();
        $alien->name = $faker->firstName();
        // Gli alieni possono solo avere 2 colori: green, red:
        $alien->color = $faker->boolean ? 'green' : 'red';
        $alien->save();

        return response($alien, Response::HTTP_CREATED);        
    }

    // Index method - OK!
    public function index() 
    {
        return response(Alien::all(), Response::HTTP_OK);
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $alien = Alien::findOrFail($id);
        $alien->color = $request->color;
        $alien->save();

        return response(null, Response::HTTP_OK);
    }

    // Destroy Method - OK!
    public function destroy($id)
    {
        Alien::destroy($id);

        return response(null, Response::HTTP_OK);
    }
}
