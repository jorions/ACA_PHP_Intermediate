<?php

include 'vendor/autoload.php';

// IS THIS A NAMESPACE? HOW DOES THIS WORK?
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

    /**
     * @return string
     */
    public function performSearch()
    {
        /**
         * Array of search parameters
         * @var array
         */
        $search = array();

        // If each of the different properties are set add them to the array
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

        // If the search array has any parameters in it run the search
        if(count($search) > 0) {

            // Format the search parameters array for URL
            $query = http_build_query($search);

            // ####################################### THIS USES GUZZLE ############################################
            // ############# MORE INFO FOUND AT http://guzzle3.readthedocs.org/http-client/client.html #############
            // #####################################################################################################
            // Create a Guzzle client and provide a base URL
            $client = new Client('http://netflixroulette.net/api');

            // Add the search parameters to the URL
            $request = $client->get('api.php?' . $query);
            $request->getUrl();

            // You must send a request in order for the transfer to occur
            $response = $request->send();

            // Encode returned JSON data to array
            $data = $response->json();

            // Use this to test view array of returned movies
            //print_r($data);

            // Return value of function that outputs HTML-formatted results
            return $this->outputResults($data);
        }
    }

    /**
     * @param $data
     * @return string $output of HTML-formatted list of movies
     */
    public function outputResults($data)
    {
        /**
         * The output string to show all movies
         * @var string
         */
        $output = '';

        // If the first index of the returned array is also an array there are multiple returned movies, so foreach through the result
        if(isset($data[0]) && is_array($data[0])) {
            foreach($data as $movie) {
                $output .= "<div class='result'>";
                    // mediatype = 0 for movies, which have portrait-oriented images, while 1 is for shows, which have landscape-oriented images
                    if($movie['mediatype'] == 0) {

                        $output .= "<div class='poster-movie'>";

                        // getimagesize will return a 0 if there is no image, so this identifies if the poster URL is a valid image and outputs the appropriate jpeg
                        if (getimagesize($movie['poster'])) {

                            $output .= "<img src='" . $movie['poster'] . "' />";
                        } else {

                            $output .= "<img src='images/poster-movie.jpg' />";
                        }
                    } else {

                        $output .= "<div class='poster-show'>";
                        if (getimagesize($movie['poster'])) {

                            $output .= "<img src='" . $movie['poster'] . "' />";
                        } else {

                            $output .= "<img src='images/poster-show.jpg' />";
                        }
                    }
                    $output .= "</div>";
                    $output .= '<div class="info">';

                        $output .= '<h1>' . $movie['show_title'] . "<br /><img src='images/" . str_replace('.', '_', $movie['rating']) . ".jpg' /></h1>";

                        if($movie['director'] != "") {
                            $output .= '<span class="director">Directed by ' . $movie['director'] . '</span><br />';
                        }

                        $output .= '<br />';
                        $output .= $movie['summary'];
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<br />';
                $output .= '<div class="thin-red-spacer"></div>';
            }

            // Remove the final thin-red-spacer so that the bottom of the screen does not have one
            $output = substr($output, 0, -strlen('<div class="thin-red-spacer"></div>'));

        // Otherwise do not foreach through the movies, simply output the single movie
        } else {
            $output .= "<div class='result'>";
                // mediatype = 0 for movies, which have portrait-oriented images, while 1 is for shows, which have landscape-oriented images
                if($data['mediatype'] == 0) {

                    $output .= "<div class='poster-movie'>";

                    // getimagesize will return a 0 if there is no image, so this identifies if the poster URL is a valid image and outputs the appropriate jpeg
                    if (getimagesize($data['poster'])) {

                        $output .= "<img src='" . $data['poster'] . "' />";
                    } else {

                        $output .= "<img src='images/poster-movie.jpg' />";
                    }
                } else {

                    $output .= "<div class='poster-show'>";

                    if (getimagesize($data['poster'])) {

                        $output .= "<img src='" . $data['poster'] . "' />";
                    } else {

                        $output .= "<img src='images/poster-show.jpg' />";
                    }
                }
                $output .= "</div>";
                $output .= '<div class="info">';

                    $output .= '<h1>' . $data['show_title'] . "<br /><img src='images/" . str_replace('.', '_', $data['rating']) . ".jpg' /></h1>";

                    if($data['director'] != "") {
                        $output .= '<span class="director">Directed by ' . $data['director'] . '</span><br />';
                    }

                    $output .= '<br />';
                    $output .= $data['summary'];
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<br />';
        }

        return $output;
    }
}