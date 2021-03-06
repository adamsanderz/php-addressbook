<?php
/***********************************************
* File      :   compat.php
* Project   :   Z-Push
* Descr     :   Help function for files
*
* Created   :   01.10.2007
*
* Copyright 2007 - 2013 Zarafa Deutschland GmbH
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU Affero General Public License, version 3,
* as published by the Free Software Foundation with the following additional
* term according to sec. 7:
*
* According to sec. 7 of the GNU Affero General Public License, version 3,
* the terms of the AGPL are supplemented with the following terms:
*
* "Zarafa" is a registered trademark of Zarafa B.V.
* "Z-Push" is a registered trademark of Zarafa Deutschland GmbH
* The licensing of the Program under the AGPL does not imply a trademark license.
* Therefore any rights, title and interest in our trademarks remain entirely with us.
*
* However, if you propagate an unmodified version of the Program you are
* allowed to use the term "Z-Push" to indicate that you distribute the Program.
* Furthermore you may use our trademarks where it is necessary to indicate
* the intended purpose of a product or service provided you use it in accordance
* with honest practices in industrial or commercial matters.
* If you want to propagate modified versions of the Program under the name "Z-Push",
* you may only do so if you have a written permission by Zarafa Deutschland GmbH
* (to acquire a permission please contact Zarafa at trademark@zarafa.com).
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU Affero General Public License for more details.
*
* You should have received a copy of the GNU Affero General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* Consult LICENSE file for details
************************************************/

if (!function_exists("quoted_printable_encode")) {
    /**
     * Process a string to fit the requirements of RFC2045 section 6.7. Note that
     * this works, but replaces more characters than the minimum set. For readability
     * the spaces and CRLF pairs aren't encoded though.
     *
     * @param string    $string     string to be encoded
     *
     * @see http://www.php.net/manual/en/function.quoted-printable-decode.php#89417
     */
    function quoted_printable_encode($string) {
        return preg_replace('/[^\r\n]{73}[^=\r\n]{2}/', "$0=\n", str_replace(array('%20', '%0D%0A', '%'), array(' ', "\r\n", '='), rawurlencode($string)));
    }
}

/*
if (!function_exists("apache_request_headers")) {
    // 
    // When using other webservers or using php as cgi in apache
    // the function apache_request_headers() is not available.
    // This function parses the environment variables to extract
    // the necessary headers for Z-Push
    // 
    function apache_request_headers() {
        $headers = array();
        foreach ($_SERVER as $key => $value)
            if (substr($key, 0, 5) == 'HTTP_')
                $headers[strtr(substr($key, 5), '_', '-')] = $value;

        return $headers;
    }
}
*/
if (!function_exists("apache_request_headers")) {
    // 
    // When using other webservers or using php as cgi in apache
    // the function apache_request_headers() is not available.
    // This function parses the environment variables to extract
    // the necessary headers for Z-Push
    // 
    function apache_request_headers() {
        $header = array();
        
        foreach ($_SERVER as $key => $value)
            if (substr($key, 0, 5) == 'HTTP_')
                $headers[strtr(substr($key, 5), '_', '-')] = $value;

        if(isset($_SERVER['HTTP_MS_ASPROTOCOLVERSION'])) {
          $header['Ms-Asprotocolversion'] = $_SERVER['HTTP_MS_ASPROTOCOLVERSION'];
        }
        if(isset($_SERVER['REDIRECT_HTTP_MS_ASPROTOCOLVERSION'])) {
          $header['Ms-Asprotocolversion'] = $_SERVER['REDIRECT_HTTP_MS_ASPROTOCOLVERSION'];
        }
        
        if(isset($_SERVER['HTTP_X_MS_POLICYKEY'])) {
          $header['X-Ms-Policykey']       = $_SERVER['HTTP_X_MS_POLICYKEY'];
        }
        if(isset($_SERVER['REDIRECT_HTTP_X_MS_POLICYKEY'])) {
          $header['X-Ms-Policykey']       = $_SERVER['REDIRECT_HTTP_X_MS_POLICYKEY'];
        }

        $header['User-Agent']           = $_SERVER['HTTP_USER_AGENT'];

        return $header;
    }
    
    /*
    $header = apache_request_headers();
    if(isset($header['Authorization'])) {
    	list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode(substr($header['Authorization'], 6)));
    }
    /*/
    if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
    	list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode(substr($_SERVER['REDIRECT_HTTP_AUTHORIZATION'], 6)));
    }
    if(isset($_SERVER['HTTP_AUTHORIZATION'])) {
      list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':' , base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
    }
    //*/
}

if (!function_exists("hex2bin")) {
    /**
     * Complementary function to bin2hex() which converts a hex entryid to a binary entryid.
     * Since PHP 5.4 an internal hex2bin() implementation is available.
     *
     * @param string    $data   the hexadecimal string
     *
     * @returns string
     */
    function hex2bin($data) {
        return pack("H*", $data);
    }
}

if (!function_exists('http_response_code')) {
    /**
     * http_response_code does not exists in PHP < 5.4
     * http://php.net/manual/en/function.http-response-code.php
     */
    function http_response_code($code = NULL) {
        if ($code !== NULL) {
            switch ($code) {
                case 100: $text = 'Continue'; break;
                case 101: $text = 'Switching Protocols'; break;
                case 200: $text = 'OK'; break;
                case 201: $text = 'Created'; break;
                case 202: $text = 'Accepted'; break;
                case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break;
                case 205: $text = 'Reset Content'; break;
                case 206: $text = 'Partial Content'; break;
                case 300: $text = 'Multiple Choices'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 302: $text = 'Moved Temporarily'; break;
                case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break;
                case 305: $text = 'Use Proxy'; break;
                case 400: $text = 'Bad Request'; break;
                case 401: $text = 'Unauthorized'; break;
                case 402: $text = 'Payment Required'; break;
                case 403: $text = 'Forbidden'; break;
                case 404: $text = 'Not Found'; break;
                case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'Not Acceptable'; break;
                case 407: $text = 'Proxy Authentication Required'; break;
                case 408: $text = 'Request Time-out'; break;
                case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break;
                case 411: $text = 'Length Required'; break;
                case 412: $text = 'Precondition Failed'; break;
                case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break;
                case 415: $text = 'Unsupported Media Type'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 501: $text = 'Not Implemented'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                case 505: $text = 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                    break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');
            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }

        return $code;
    }
}

if (!function_exists('memory_get_peak_usage')) {
    /**
     * memory_get_peak_usage is not available prior to PHP 5.2.
     * This complementary function will return the value of memory_get_usage();
     * @see http://php.net/manual/en/function.memory-get-usage.php
     * @see http://php.net/manual/en/function.memory-get-peak-usage.php
     *
     * @param boolean $real_usage
     */
    function memory_get_peak_usage($real_usage = false) {
        ZLog::Write(LOGLEVEL_DEBUG, "memory_get_peak_usage() is not available on this system. The value of memory_get_usage() will be used.");
        return memory_get_usage();
    }

}

?>