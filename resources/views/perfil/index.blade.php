@extends('layouts.app')
@section('titulo')
Editar Perfil:{{auth()->user()->username}}

@endsection

@section('contenido')
<div class="md:flex md:justify-center">
  <div class="md:w-1/2 bg-white shadow p-6">
    <form class="mt-10 md:mt-0" action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-5">
        <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
          Username
        </label>
        <input type="text" id="username" name="username" placeholder="Tu nombre de usuario"
          class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value={{
          auth()->user()->username}}
        >
        @error('username')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
        @enderror
      </div>
      {{-- <div class="mb-5">
        <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
          Email
        </label>
        <input type="text" id="email" name="email" placeholder="Tu nombre de usuario"
          class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value={{ auth()->user()->email}}
        >
        @error('email')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-5">
        <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">
          Old password
        </label>
        <input type="password" id="oldpassword" name="oldpassword" placeholder="Ingresa tu password"
          class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500 @enderror"
        >
        @error('oldpassword')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
        @enderror
      </div>
      <div class="mb-5">
        <label for="newpassword" class="mb-2 block uppercase text-gray-500 font-bold">
          newpassword
        </label>
        <input type="password" id="newpassword" name="newpassword" placeholder="Tu nuevo password"
          class="border p-3 w-full rounded-lg @error('newpassword') border-red-500 @enderror"
        >
        @error('newpassword')
        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
        @enderror
      </div> --}}
      <div class="mb-5">
        <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
          Imagen de perfil
        </label>
        <input type="file" id="imagen" name="imagen" placeholder="Tu imagen" class="border p-3 w-full rounded-lg"
          accept=".jpg,.jpeg,.png">

      </div>

      <input type="submit" value="Guardar cambios"
        class="bg-sky-600 hover:bg-sky-700 transition-colors p-3 cursor-pointer uppercase font-bold w-full text-white rounded-lg" />
    </form>

  </div>

</div>
@endsection