<?php
class Jjwt {
    function __construct() {
        $this->jwtext = $_SESSION['TOKEN_ENT'];
    }
    private function separateToken($selector) {
        $arrJwt = explode('.', $this->jwtext);
        return $arrJwt[$selector];
    }
    public function getPayload($arrList = null) {
        $payload64 = $this->separateToken(1);
        $payloadJson = base64_decode($payload64);
        $payload = json_decode($payloadJson);
        if (is_null($arrList)) {
            return $payload;
        } else {
            $arrPayload = array();
            foreach ($arrList as $key => $pointer) {
                if (property_exists($payload, $pointer)) {
                    $arrPayload[$pointer] = $payload->{$pointer};
                }
            }
            return (object) $arrPayload;
        }
    }
}
