<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Hashing\Hasher;
use App\Models\User;

class UserTableSeeder extends Seeder {

  public function __construct(Hasher $hasher)
  {
    $this->hasher = $hasher;
  }

  public function run()
  {
    DB::table('users')->truncate();

    User::create([
      'username' => 'franv',
      'email' => 'fran.varn@gmail.com',
      'password' => $this->hasher->make('Fran'),
      'first_name' => 'Francesca',
      'last_name' => 'Varney',
      'location' => 'Cincinnati, OH',
      'is_admin' => 1
    ]);

    User::create([
      'username' => 'jemmad',
      'email' => 'jemma.dog@gmail.com',
      'password' => $this->hasher->make('Jemma'),
      'first_name' => 'Jemma',
      'last_name' => 'Dog',
      'location' => 'Cincinnati, OH',
      'is_admin' => 0
    ]);

    User::create([
      'username' => 'johns',
      'email' => 'john.smith@gmail.com',
      'password' => $this->hasher->make('John'),
      'first_name' => 'John',
      'last_name' => 'Smith',
      'location' => 'Lexington, KY',
      'is_admin' => 0
    ]);

    User::create([
      'username' => 'georginaa',
      'email' => 'georgina.atwood@gmail.com',
      'password' => $this->hasher->make('Georgina'),
      'first_name' => 'Georgina',
      'last_name' => 'Atwood',
      'location' => 'Knoxville, TN',
      'is_admin' => 0
    ]);

    User::create([
      'username' => 'sallys',
      'email' => 'sally.sue@gmail.com',
      'password' => $this->hasher->make('Sally'),
      'first_name' => 'Sally',
      'last_name' => 'Sue',
      'location' => 'Houston, TX',
      'is_admin' => 0
    ]);
  }
}