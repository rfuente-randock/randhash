<?php

namespace AppBundle\Hashtest;

class Api implements ApiInterface
{
    private $url = "https://api.randock.com/name/hash.json";
    private $user = "api";
    private $pss = "p.i.sgWJUqz6Y4[nB99bUGWgzceDeDUyZyLiLck9j>X?PBZcsD";
    private $firstname;
    private $lastname;
    
    
    public function __construct($data) {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
    }
    
    public function getHash() {
        $url = $this->url;
        $content = json_encode(['firstname'=>$this->firstname, 'lastname'=>$this->lastname]);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERPWD, $this->user . ":" . $this->pss);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ["Content-type: application/json"]);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

        $json_response = curl_exec($curl);

        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ( $status != 200 ) {
            $error = "Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
            throw new \Exception($error);
        }

        curl_close($curl);

        $response = json_decode($json_response, true);

        return($response['hash']);

    }
}