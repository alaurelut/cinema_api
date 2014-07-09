<?php

require("toro.php");
require("connexion.php");
require("user.php");
require("userlikes.php");
require("userdislikes.php");
require("movie.php");
require("moviewatchlist.php");
require("moviewatched.php");
Toro::serve(array(
    "/users" => "UserHandler",
    "/users/:number" => "UserProfileDeleteHandler",
    "/movies" => "MovieHandler",
    "/movies/:number" => "MovieProfileDeleteHandler",
    "/movies/:number/:string" => "MovieModifyHandler",
    "/users/:number/likes/:number" => "UserLikesHandler",
    "/users/:number/likes" => "UserLikesHandler",
    "/users/:number/dislikes/:number" => "UserDislikesHandler",
    "/users/:number/dislikes" => "UserDislikesHandler",
    "/users/:number/watched" => "UserWatchedHandler",
    "/users/:number/watched/:number" => "UserWatchedHandler",
    "/users/:number/watchlist" => "UserWatchlistHandler",
    "/users/:number/watchlist/:number" => "UserWatchlistHandler"
));

