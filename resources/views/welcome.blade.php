<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GitHub Followers Search</title>

    <!-- Include jQuery library for AJAX and DOM manipulation -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <h1>GitHub Followers Search</h1>

    <!-- Search form for GitHub username -->
    <div id="searchForm">
        <input type="text" id="username" placeholder="Enter GitHub username">
        <button id="searchBtn">Search</button>
    </div>

    <!-- Area to display user information -->
    <div id="userInfo"></div>

    <!-- Area to display list of user's followers -->
    <div id="followers"></div>

    <!-- Button to load more followers -->
    <button id="loadMore" style="display:none;">Load More</button>

    <!-- Include custom JavaScript file -->
    <script src="{{ asset('script.js') }}"></script>
</body>

</html>
