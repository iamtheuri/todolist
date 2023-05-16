<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="title">Todo List</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awsome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.o/mdb.min.js"></script>

    <style>
        .title{
            margin: 0;
            padding: 0;
            font-family: 'Pippins', sans-serif;
            box-sizing: border-box;
        }
        .background {
            width: 100%;
            min-height: 100vh;
            background: linear-gradient(135deg, #153577, #4e085f);
            padding: 10px;
        }
        .container{
            width: 100%;
            max-width: 570px;
            background: #fff;
            margin: 100px auto 20px;
            padding: 40px 40px 90px;
            border-radius:10px;
        }
        .input {
            flex: 1;
            font-weight: none;
            padding: 2px 50px;
            outline: none;
            border-radius: 40px;
            margin: 0;
            font-family: ui-monospace;
            font-size: small;
            line-height: inherit;
        }
        .buttons {
            border-radius: 40px;
            margin: 0;
            font-family: ui-monospace;
            font-size: small;
            line-height: initial;
        }       
        .list {
            cursor: pointer;
        }
    </style>
</head>

<body class="background">
        <div class="container">
            <div class="card-body">
                <h3><b>To-do List</b></h3>
                <form action="{{ route('store') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="todoListInput">
                        <input class="input" type="text" name="content" class="form-control" placeholder="Add your new todo">
                        <button class="buttons" type="submit" class="btn btn-dark btn-sm px-4"><b>Add Task</b></button>
                    </div>
                </form>
                <!-- {{-- if tasks count --}} -->
                @if (count($items))
                    <ul class="list-group list-group-flush mt-3 sortable">
                        @foreach($items as $item)
                        <li class="list-group-item list" data-id="{{$item->id}}">
                            <b>{{ $item->content }}</b>

                            <!-- Edit Items -->
                            <a href="{{ route('edit', $item->id) }}">Edit</a>

                            <!-- Delete Items -->
                            <form action="{{ route('destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="buttons" type="submit" class="btn btn-link btn-sm float-end"><i class="fas fa-trash">Delete</i></button>
                            </form>

                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-center mt-3">No Tasks!</p>
                @endif
            </div>

            

            @if (count($items))
                <div class="card-footer">
                    You have {{ count($items) }} pending tasks
                </div>
            @else
            @endif
        </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>
        <script>
            // Initialize Sortable.js to make the list items draggable and reorderable
            // Sortable.create(document.querySelector('.sortable'), {
            //     animation: 150
            // });
            var sortable = new Sortable(document.querySelector('.sortable'), {
                animation: 150,
                group: "localStorage",
                store: {

                    /**
                     * Save the order of elements. Called onEnd (when the item is dropped).
                     * @param {Sortable}  sortable
                     */
                    set: function (sortable) {
                        var order = sortable.toArray();
                        const url = "{{ route('bulkupdate')}}";
                        console.log("set", order);
                        var formData = new FormData;
                        formData.append("_token", "{{ csrf_token()}}");

                        for (var i = 0; i < order.length; i++) {
                            formData.append('position[]', order[i]);
                        }
                        fetch(url, {
                            method : "POST",
                            body: formData,
                        }).then(
                            response => response.text() // .json(), etc.
                            //console.log(response);
                            // same as function(response) {return response.text();}
                        ).then(
                            html => console.log(html)
                        );
                        localStorage.setItem(sortable.options.group.name, order.join('|'));
                    }
                }
            })
        </script>
</body>
</html>