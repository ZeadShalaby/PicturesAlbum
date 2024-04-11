<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/album/createAlbum.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav/nav.css') }}">

    <title>Create Album</title>
</head>

<body>

    <nav class="navbar">
        <!-- LOGO -->
        <div class="logo">MUO</div>

        <!-- NAVIGATION MENU -->
        <ul class="nav-links">

            <!-- USING CHECKBOX HACK -->
            <input type="checkbox" id="checkbox_toggle" />
            <label for="checkbox_toggle" class="hamburger">&#9776;</label>

            <!-- NAVIGATION MENUS -->
            <div class="menu">

                <li><a href="/albums">Album</a></li>
                <li><a href="/albums/create">New Album</a></li>

                <li class="services">
                    <a href="/">Services</a>

                    <!-- DROPDOWN MENU -->
                    <ul class="dropdown">
                        <li><a href="/">Dropdown 1 </a></li>
                        <li><a href="/">Dropdown 2</a></li>
                        <li><a href="/">Dropdown 2</a></li>
                        <li><a href="/">Dropdown 3</a></li>
                        <li><a href="/">Dropdown 4</a></li>
                    </ul>

                </li>

                <li><a href="/">Pricing</a></li>
                <li><a href="/">Contact</a></li>
            </div>
        </ul>
    </nav>

    <input class="c-checkbox" type="checkbox" id="start" />
    <input class="c-checkbox" type="checkbox" id="finish" />
    <div class="c-form__progress"></div>

    <div class="c-formContainer">
        <form class="c-form" id="myForm" method="POST" action="/albums">
            @csrf
            <div>
                <div class="c-form__group">

                    <label class="c-form__label" for="username">
                        <input type="text" id="username" class="c-form__input" placeholder=" " pattern="[^\s]+"
                            required name="name" />

                        <label class="c-form__next" for="finish" role="button">

                            <span class="c-form__nextIcon"></span>
                        </label>

                        <span class="c-form__groupLabel">Create Album username.</span>
                        <b class="c-form__border"></b>
                    </label>
                </div>
            </div>

            <label class="c-form__toggle" for="start">New Album<span class="c-form__toggleIcon"></span></label>

        </form>
    </div>

    <!---------------scripts --------------->
    <script src="{{ asset('js/album/createAlbum.js') }}"></script>
