<?php

declare(strict_types=1);
if (!function_exists('mb_ord')) {
    function mb_ord($s, $encoding = null)
    {
        $getEncoding = function ($encoding) {
            if (null === $encoding) {
                return 'UTF-8';
            }

            if ('UTF-8' === $encoding) {
                return 'UTF-8';
            }

            $encoding = strtoupper($encoding);

            if ('8BIT' === $encoding || 'BINARY' === $encoding) {
                return 'CP850';
            }

            if ('UTF8' === $encoding) {
                return 'UTF-8';
            }

            return $encoding;
        };

        if ('UTF-8' !== $encoding = $getEncoding($encoding)) {
            $s = mb_convert_encoding($s, 'UTF-8', $encoding);
        }

        if (1 === \strlen($s)) {
            return \ord($s);
        }

        $code = ($s = unpack('C*', substr($s, 0, 4))) ? $s[1] : 0;
        if (0xF0 <= $code) {
            return (($code - 0xF0) << 18) + (($s[2] - 0x80) << 12) + (($s[3] - 0x80) << 6) + $s[4] - 0x80;
        }
        if (0xE0 <= $code) {
            return (($code - 0xE0) << 12) + (($s[2] - 0x80) << 6) + $s[3] - 0x80;
        }
        if (0xC0 <= $code) {
            return (($code - 0xC0) << 6) + $s[2] - 0x80;
        }

        return $code;
    }
}
