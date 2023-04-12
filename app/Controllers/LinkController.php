<?php

namespace App\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Validator;

class LinkController extends MainController
{

    /**
     * @param $url
     * @Rest\POST
     * @return void
     */
    public function makeLink()
    {
        header('Content-type: application/json');
        $request = $this->request->post ?? [];
        $url = isset($request['url']) ? $request['url'] : '';
        $callback_url = isset($request['callback_url']) ? $request['callback_url'] : '';

        if (isset($request['url'])) {
            try {

                $uuid = $this->gen_uuid();
                $link = Link::create([
                    'argument' => $uuid,
                    'url' => $url,
                    'callback_url' => $callback_url
                ]);
                echo json_encode(['url' => env('APP_HOST') . '/go/' . $uuid, 'id' => $link->id]);
            } catch (\PDOException $e) {
                echo json_encode(['url' => env('APP_HOST') . '/error', 'id' => $link->id]);
            }
        } else {
            header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 404');
        }
    }

    public function updateLink()
    {
        $request = $this->request->post ?? [];

        $id = isset($request['id']) ? (int)$request['id'] : 0;
        $chat_id = isset($request['chat_id']) ? (int)$request['chat_id'] : 0;
        $message_id = isset($request['message_id']) ? (int)$request['message_id'] : 0;


        $link = Link::find($id);
        $link->chat_id = $chat_id;
        $link->message_id = $message_id;
        $link->save();
        echo "ОК";
    }


    /**
     * @param $lnk
     * @return void
     */
    public function goToLink($lnk)
    {
        $link = Link::whereArgument($lnk)->first();

        if ($link) {
            if (!is_null($link->callback_url) && !is_null($link->chat_id) && !is_null($link->message_id)) {
                $this->callToBot($link->callback_url, $link->chat_id, $link->message_id);
                Link::where([['chat_id', $link->chat_id], ['message_id', $link->message_id]])->delete();
            }

            $url = $link->url;
            header("Location: $url");
        } else {
            header((isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0') . ' 404');
        }
    }


    public function callToBot($callback_url, $chat_id, $message_id)
    {
        $url = "$callback_url/tgwebhook/delete-game-urls/$chat_id/$message_id";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
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