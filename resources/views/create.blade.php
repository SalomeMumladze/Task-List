@extends('layouts.app')

@section('title', 'Add Task')


  <style>
    .error-message {
      color: red;
      font-size: 0, 8rem;
    }
  </style>

@section('content')

  <form method="POST" action="{{ route('tasks.store') }}">
    {{-- its protecting our users, cross side request forgery,
    its happens when a malicious website or script will send a request to a different 
    website on  behalf of the logged in user. So this essentially means that someone 
    tries to send a request on behalf of you basically to this website,and it just happens when the user
    has an active session on the website. And to protect against such attacks, Laravel has the Csrf middleware.
    
    Remember old() only works with the method post.

    --}}
    @csrf 
    <div>
      <label for="title">
        Title
      </label>
      <input text="text" name="title" id="title"  value="{{old('title')}}"/>
     @error('title')
        <p class="error-message">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description">Description</label>
      <textarea name="description" id="description" rows="5">{{old('description')}}</textarea>
      @error('description')
        <p class="error-message">{{$message}}</p>
      @enderror
    </div>

    <div>
      <label for="long_description">Long Description</label>
      <textarea name="long_description" id="long_description" rows="10">{{old('long_description')}}</textarea>
       @error('long_description')
      <p class="error-message">{{$message}}</p>
      @enderror
    </div>

    <div>
      <button type="submit">Add Task</button>
    </div>
  </form>
@endsection