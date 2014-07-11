<?php

require("toro.php");
require("connexion.php");
require("user.php");
require("userlikes.php");
require("userdislikes.php");
require("movie.php");
require("moviewatchlist.php");
require("moviewatched.php");
require("genre.php");
require("search.php");
require("following.php");

Toro::serve(array(
    "/users" => "UserHandler",
    "/users/:number" => "UserProfileDeleteHandler",
    "/movies" => "MovieHandler",
    "/movies/:number" => "MovieProfileDeleteModifyHandler",
    "/users/:number/likes/:number" => "UserLikesHandler",
    "/users/:number/likes" => "UserLikesHandler",
    "/users/:number/dislikes/:number" => "UserDislikesHandler",
    "/users/:number/dislikes" => "UserDislikesHandler",
    "/users/:number/watched" => "UserWatchedHandler",
    "/users/:number/watched/:number" => "UserWatchedHandler",
    "/users/:number/watchlist" => "UserWatchlistHandler",
    "/users/:number/watchlist/:number" => "UserWatchlistHandler",
    "/genres" => "GenreHandler",
    "/search" => "SearchHandler",
    "/users/:number/followed/:number" => "UserFollowingHandler",
    "/users/:number/followed" => "UserFollowingHandler",
    "/users/:number/followers" => "UserFollowersHandler"
));