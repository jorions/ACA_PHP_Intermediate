<?php

include 'vendor/autoload.php';

// HOW DOES THIS REFERENCE WORK? DOESN'T IT NEED TO BE A FILE PATH?
use Guzzle\Http\Client;

class NetflixSearch {

    /**
     * Movie title
     * @var string
     */
    protected $title;

    /**
     * Movie year
     * @var int
     */
    protected $year;

    /**
     * Movie director
     * @var string
     */
    protected $director;

    /**
     * Movie actor
     * @var string
     */
    protected $actor;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getActor()
    {
        return $this->actor;
    }

    /**
     * @param string $actor
     */
    public function setActor($actor)
    {
        $this->actor = $actor;
    }

    public function performSearch()
    {
        $search = array();

        if(isset($this->title)) {
            $search['title'] = $this->title;
        }
        if(isset($this->director)) {
            $search['director'] = $this->director;
        }
        if(isset($this->year)) {
            $search['year'] = $this->year;
        }
        if(isset($this->actor)) {
            $search['actor'] = $this->actor;
        }

        if(count($search) > 0) {
            //$query = "http://netflixroulette.net/api/api.php?" . http_build_query($search);

            //Test return
            //return $query;
            //return http_build_query($search);
            $query = http_build_query($search);
            return $query;
            //Implement guzzle
        }
    }
}


$search = new NetflixSearch();

$search->setDirector('Steven Spielberg');

//$search->setTitle('The Boondocks');
//$search->setYear(2005);

//$search->setActor('John Mahoney');

// Create a client and provide a base URL
$client = new Client('http://netflixroulette.net/api');

$request = $client->get('api.php?' . $search->performSearch());
$request->getUrl();

// You must send a request in order for the transfer to occur
$response = $request->send();

$response->getHeader('Content-Length');


$data = $response->json();

// use this to view array of returned movies
//print_r($data);

// if the first index of the returned array is also an array there are multiple returned movies, so foreach through the result
if(is_array($data[0])) {
    foreach($data as $movie) {
        echo "<img src='" . $movie['poster'] . "'></img>";
        echo '<br />';

        echo '<h2>' . $movie['show_title'] . " <img src='images/" . str_replace('.', '_', $movie['rating']) . ".jpg'><img></h2>";
        if($movie['director'] != "") {
            echo 'Directed by ' . $movie['director'];
        }
        echo '<br />';
        echo $movie['summary'];
        echo '<br />';
    }

// otherwise do not foreach through the movies, simply output the single movie
} else {
    echo "<img src='" . $data['poster'] . "'></img>";
    echo '<br />';

    echo '<h2>' . $data['show_title'] . " <img src='images/" . str_replace('.', '_', $data['rating']) . ".jpg'><img></h2>";
    if($data['director'] != "") {
        echo 'Directed by ' . $data['director'];
    }
    echo '<br />';
    echo $data['summary'];
    echo '<br />';
}