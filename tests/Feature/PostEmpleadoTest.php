<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Empleado;

class PostEmpleadoTest extends TestCase
{
   
    use RefreshDatabase;
    /** @test */
    public function a_post_can_be_created(){

       //$this->withoutExceptionHandling();

       $response= $this->post('/empleados-store',[
            'IdEmpleado'=>'',
            'Nombres'=>'dfdfd',
            'Apellidos'=>'',
            'DNI'=>'dfdfd',
            'correo'=>'dfdfd',
            'telefono'=>'dfdfd',
       ]);

       $response->assertOk();
       $this->assertCount(1,Empleado::all());
      // $post= Post::first();
       //$this->assertEquals($)

    }
}
