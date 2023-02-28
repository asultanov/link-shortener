<?php

namespace App\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Validator;

class LinkController extends MainController
{

    /**
     * @return void
     * @param $url
     * @Rest\POST
     */
    public function makeLink()
    {
        header('Content-type: application/json');
        $request = $this->request->post ?? [];
        if (isset($request['url'])) {
            try {

                $uuid = $this->gen_uuid();
                Link::create([
                    'argument' => $uuid,
                    'url' => $request['url']
                ]);
                echo json_encode(['url' => env('APP_HOST') . '/go/' . $uuid]);
            } catch (\PDOException $e) {
                echo json_encode(['url' => env('APP_HOST') . '/error']);
            }
        } else {
            header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 404');
        }
    }

    /**
     * @param $lnk
     * @return void
     */
    public function goToLink($lnk)
    {
        $link = Link::whereArgument($lnk)->first();

        if ($link) {
            $url = $link->url;
            $link->delete();
            header("Location: $url");
        } else {
            header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 404');
        }
    }


    /**
     * @return string
     */
    private function gen_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

}