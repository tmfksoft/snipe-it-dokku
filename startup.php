<?php
// Snipe-IT Dokku Startup Script
// Customised by Thomas Burnett-Taylor

// If DB_<value> values are set, ignore parser.
if (getenv("DB_DATABASE") || getenv("DB_HOST") || getenv("DB_USERNAME")) {
  echo "Database Environment variables are manually set. Ignoring add-ins.";
} else if (getenv("DATABASE_URL")) {
  echo "Using MySQL Dokku add-in." . PHP_EOL;
  set_db(getenv("DATABASE_URL"));
}

function set_db($uri) {
  file_put_contents('./.env', 'DB_HOST='     . parse_url($uri, PHP_URL_HOST). PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'DB_USERNAME=' . parse_url($uri, PHP_URL_USER). PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'DB_PASSWORD=' . parse_url($uri, PHP_URL_PASS). PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'DB_DATABASE=' . ltrim(parse_url($uri, PHP_URL_PATH), '/'). PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'DB_PREFIX=' . 'null' . PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'DB_DUMP_PATH=' . 'null' . PHP_EOL, FILE_APPEND);

}

// If Heroku Redis is setup, let's get it working.
if (getenv("REDIS_URL")) {                    // Heroku Redis
  echo "Setting up Dokku Redis." . PHP_EOL;
  $url = getenv("REDIS_URL");
  file_put_contents('./.env', 'REDIS_HOST='     . parse_url($url, PHP_URL_HOST). PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'REDIS_PASSWORD=' . parse_url($url, PHP_URL_PASS). PHP_EOL, FILE_APPEND);
  file_put_contents('./.env', 'REDIS_PORT='     . parse_url($url, PHP_URL_PORT). PHP_EOL, FILE_APPEND);
}

?>