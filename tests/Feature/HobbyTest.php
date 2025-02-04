<?php
// tests/Feature/HobbyTest.php

namespace Tests\Feature;

use App\Models\Hobby;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HobbyTest extends TestCase
{
    // use RefreshDatabase;

    /**
     *
     * @return void
     */
  // tests/Feature/HobbyTest.php

  public function test_detail_hobby()
  {
      $hobbies = Hobby::all();
  
      $response = $this->get(route('detail.hobby'));
      $response->assertStatus(200);

  }
  


    public function test_store_hobby()
{
    $hobby = new Hobby();
    $hobby->hobby = 'Bermain Sepak Bola';

    $hobby->save();

    $this->assertDatabaseHas('hobbies', [
        'hobby' => 'Bermain Sepak Bola',
    ]);
}

public function test_update_hobby()
{
    $hobby = Hobby::find(1);

    if (!$hobby) {
        $hobby = Hobby::create(['hobby' => 'menendang Sepak Bola']);
    }

    $updatedData = [
        'id' => $hobby->id,
        'hobby' => 'Bermain Basket',
    ];

    $response = $this->put(route('hobby.update'), $updatedData);

    $response->assertRedirect(route('detail.hobby'));

    $this->assertDatabaseHas('hobbies', [
        'id' => $hobby->id,
        'hobby' => 'Bermain Basket',
    ]);

    $response->assertSessionHas('success', 'berhasil mengupdate hobby');
}

public function test_destroy_hobby()
{
    $hobby = Hobby::find(1);

    if (!$hobby) {
        $hobby = Hobby::create(['hobby' => 'Bermain Sepak Bola']);
    }

    $response = $this->delete(route('hobby.delete', ['id' => $hobby->id]));

    $response->assertRedirect(route('detail.hobby'));

    $this->assertDatabaseMissing('hobbies', [
        'id' => $hobby->id,
    ]);

    $response->assertSessionHas('success', 'berhasil menghapus data');
}


}

