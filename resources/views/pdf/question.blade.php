<!DOCTYPE html>
<html>

<head>
    <title>Hi</title>
    <style>
        html,
        body,
        div,
        h1,
        h2,
        h3,
        p,
        blockquote,
        ul,
        ol,
        li,
        pre {
            margin: 0;
            padding: 0
        }

        li {
            margin-left: 1.5em
        }

        @page {
            size: a4;
            margin: 20mm
        }

        @media screen {
            body {
                margin: 5em
            }
        }

    </style>
</head>

<body>
    <h1 style="color: dodgerblue; float: left;">Stuck Neverflow</h1>
    <p style="float: right; color: darkslategray;">shevaathalla@gmail.com</p>
    <br>
    <br>    
    <br>
    <h3 style="margin-top: 2rem">Question Number {{ $question->id }}</h3>    
    <br>
    <hr>
    <h2>Title : {{ $question->title }}</h2>
    <small>Created by {{ $question->user->name }} on {{ $question->created_at }}</small>
    <br>
    <p>{!! $question->text !!}</p>
    <h4>With tag : 
        @foreach ($question->tags as $tag)
            {{ $tag->name }} 
        @endforeach
    </h4>
    <hr>
    <h3>Answer</h3>
    @foreach ($question->answers as $answer)
    <p style="color: darkslategrey">
        Answer created by : {{ $answer->user->name }}
        @if ($answer->approve == 1)
            <b>(This answer is approved by question maker)</b>
        @endif
    </p>
    <p style="font-size: 12px">{!! $answer->text !!}</p>
        
    @endforeach    
</body>

</html>
