<DOCTYPE html>
    <html>
    <head>
        <title></title>
    </head>
    <body>

    <ul>
    @foreach ($books as $book)
        <li>{{$book}}</li>
    @endforeach
    </ul>

    </body>
    </html>
