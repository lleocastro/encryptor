<?php namespace Encryptor\Suite;

use \InvalidArgumentException;

/**
 * Disguise for Low Encryption
 * @link https://github.com/lleocastro/encryptor/
 * @license https://github.com/lleocastro/encryptor/blob/master/LICENSE
 * @author Leonardo Carvalho <leonardo_carvalho@outlook.com>
 * @copyright 2016 MIT License
 * @package \Encryptor
 */
class Disguise
{
    /**
     * Logic from Encryption
     * The key is encrypted in Base64 then, divided in half, inverted and encrypted again
     * @param (int) $data for encryption
     * @return (string) encrypted $data
     */
    final public function obscure($data)
    {
        if(empty($data)):
            throw new InvalidArgumentException('Arguments not valid!');
        endif;

        $encryptedData = base64_encode(htmlentities((string) $data));
        return base64_encode(strrev(substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData)
            ,strlen($encryptedData)).substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData))));
    }

    /**
     * Logic from Decryption
     * Reverse process of 'obscure()' to recover the original value.
     * @param (int) $data encrypted
     * @return (int) original $data
     */
    final public function illumin($encryptedData)
    {
        if(empty($encryptedData)):
            throw new InvalidArgumentException('Arguments not valid!');
        endif;

    	$encryptedData = base64_decode(htmlentities((string) $encryptedData));
        $encryptedData = strrev(
    	    substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData),strlen($encryptedData))
    	    .substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData)));
        return base64_decode($encryptedData);
    }

}