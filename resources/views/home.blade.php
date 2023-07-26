<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
    }

    main {
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .container {
      border: 3px solid black;
      width: 100%;
      max-width: 600px;
      margin: 10px;
      padding: 20px;
    }

    .post {
      background-color: #f9f9f9;
      padding: 10px;
      margin: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .post h3 {
      margin: 0;
      padding: 0;
      font-size: 18px;
    }

    .post p {
      margin: 0;
      padding: 0;
    }

    .post button {
      background-color: #333;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 3px;
      cursor: pointer;
    }

    .post button:hover {
      background-color: #555;
    }

    form {
      display: inline-block;
    }

    .form-input {
      display: block;
      margin: 10px 0;
    }

    .form-input input, .form-input textarea {
      width: 100%;
      padding: 5px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-input button {
      background-color: #333;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 3px;
      cursor: pointer;
    }

    .form-input button:hover {
      background-color: #555;
    }

    .form-input button, .form-input input, .form-input textarea {
      display: block;
      margin: 5px 0;
    }
  </style>
</head>
<body>

  <header>
    @auth
    <p>Congrats you are logged in.</p>
    <form action="/logout" method="POST">
      @csrf
      <button>Log out</button>
    </form>
    @endauth
  </header>

  <main>
    @auth
    <div class="container">
      <h2>Create a New Post</h2>
      <form action="/create-post" method="POST" class="form-input">
        @csrf
        <input type="text" name="title" placeholder="Post title">
        <textarea name="body" placeholder="Body content..."></textarea>
        <button>Save Post</button>
      </form>
    </div>

    <div class="container">
      <h2>All Posts</h2>
      @foreach($posts as $post)
      <div class="post">
        <h3>{{$post['title']}} by {{$post->user->name}}</h3>
        <p>{{$post['body']}}</p>
        <form action="/edit-post/{{$post->id}}" method="POST" class="form-input">
          @csrf
          <button>Edit</button>
        </form>
        <form action="/delete-post/{{$post->id}}" method="POST" class="form-input">
          @csrf
          @method('DELETE')
          <button>Delete</button>
        </form>
      </div>
      @endforeach
    </div>
    @else
    <div class="container">
      <h2>Register</h2>
      <form action="/register" method="POST" class="form-input">
        @csrf
        <input name="name" type="text" placeholder="Name">
        <input name="email" type="text" placeholder="Email">
        <input name="password" type="password" placeholder="Password">
        <button>Register</button>
      </form>
    </div>
    <div class="container">
      <h2>Login</h2>
      <form action="/login" method="POST" class="form-input">
        @csrf
        <input name="loginname" type="text" placeholder="Name">
        <input name="loginpassword" type="password" placeholder="Password">
        <button>Log in</button>
      </form>
    </div>
    @endauth
  </main>

</body>
</html>
