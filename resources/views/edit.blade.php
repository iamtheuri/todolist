<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awsome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.o/mdb.min.js"></script>
    <style>
        .background {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(135deg, #153577, #4e085f);
            padding: 10px;
        }
        .container{
            width: 100%;
            max-width: 540px;
            background: #fff;
            margin: 100px auto 20px;
            padding: 40px 30px 70px;
            border-radius:10px;
        }
        .input {
            flex: 1;
            font-weight: 14px;
            padding: 10px 50px;
            outline: none;
            border-radius: 40px;
        }
        .buttons {
            border: none;
            outline: none;
            padding: 13px 10px;
            background-color: black;
            color: #fff;
            font-size: 16px;
            border-radius: 40px;
        }
    </style>
</head>

<body class="background">
    <div class="container"> 
        <div class="card shadow-sm">
            <div class="card-body">
                <h3>{{ $item->content }}</h3>
                
                <!-- {{-- if tasks count --}} -->
                    <ul class="list-group list-group-flush mt-3">
                       <form action="{{ route('update', $item->id) }}" method="POST">
                                @csrf
                                @method('put')

                                <!-- Content Input -->
                                <input class="input" type="text" name="content" value="{{ $item->content }}" required>

                                <!-- Submit Button -->
                                <button class="buttons" type="submit">Update</button>
                            </form>
                    </ul>
            </div>
        </div>
    </div>
    
</body>
</html>