<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="{{ asset('css/image/index.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer/footer.css') }}">

</head>

<body>
    <header>
        <nav>
            <a href="/albums">Album</a>
            <a href="/images/create?id={{ $album }}">Add Image</a>
            <a href="">Info</a>
        </nav>
    </header>

    <!-- carousel -->
    <div class="carousel">
        <!-- list item -->
        <div class="list">
            @foreach ($images as $item)
                <div class="item">
                    <img src="{{ asset('images/albums/' . $item->path) }}" alt="images">
                    <div class="content">
                        <div class="author"> {{ $item->name }}
                        </div>
                        <div class="title">DESIGN SLIDER</div>
                        <div class="topic">Supers</div>
                        <div class="des">
                            <!-- lorem 50 -->
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut sequi, rem magnam nesciunt
                            minima
                            placeat, itaque eum neque officiis unde, eaque optio ratione aliquid assumenda facere ab et
                            quasi ducimus aut doloribus non numquam. Explicabo, laboriosam nisi reprehenderit tempora at
                            laborum natus unde. Ut, exercitationem eum aperiam illo illum laudantium?
                        </div>
                        <div class="buttons">
                            <button>SEE MORE</button>
                            <form action="{{ route('images.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button
                                    style="height: 40px;margin-top: 1px;width: 130px; margin-left: 50px;cursor: pointer;"><i
                                        class="fa fa-trash">Delete
                                    </i></button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <!-- list thumnail -->
        <div class="thumbnail">
            @foreach ($images as $item)
                <div class="item">
                    <img src="{{ asset('images/albums/' . $item->path) }}" alt="images">
                    <div class="content">
                        <div class="title">
                            {{ $item->name }}
                        </div>
                        <div class="description">
                            Description
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <!-- next prev -->

        <div class="arrows">
            <button id="prev">
                < <button id="next">>
            </button>
        </div>
        <!-- time running -->
        <div class="time"></div>
    </div>

    <script src="{{ asset('js/image/index.js') }}"></script>
</body>

</html>
